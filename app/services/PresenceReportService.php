<?php
namespace App\Services;

use App\Models\Agent;
use App\Models\Presence;
use App\Models\Conge;
use App\Models\Rotation;
use App\Models\Horaire;
use App\Models\Absence;
use Carbon\Carbon;
use \App\Services\HolidaysService;

class PresenceReportService {
    private $holidaysService;

    public function __construct(HolidaysService $holidaysService)
    {
        $this->holidaysService = $holidaysService;
    }

    public function generatePresenceReport($startDate = null, $endDate = null, $filters = [])
    {
        $start = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfDay();
        $end = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfDay();
        $report = [];

        while ($start->lte($end)) {
            if (!$this->holidaysService->isHoliday($start) && !$this->holidaysService->isWeekend($start)) {
                $report[] = [
                    'date' => $start->format('Y-m-d'),
                    'agents' => $this->generateDailyReport($start, $filters)
                ];
            }
            $start->addDay();
        }

        return $report;
    }

    /**
     * Generation des rapport journaliers et la possibilité de filtrer par ordre institutionel
     * @param $date
     * @param $filters
     * @return array
    */
    private function generateDailyReport($date, $filters): array
    {
        $report = [];
        $agentsQuery = Agent::query();

        if (isset($filters['ministere_id'])) {
            $agentsQuery->where('ministere_id', $filters['ministere_id']);
        }
        if (isset($filters['secretariat_id'])) {
            $agentsQuery->where('secretariat_id', $filters['secretariat_id']);
        }
        if (isset($filters['direction_id'])) {
            $agentsQuery->where('direction_id', $filters['direction_id']);
        }
        if (isset($filters['division_id'])) {
            $agentsQuery->where('division_id', $filters['division_id']);
        }
        if (isset($filters['bureau_id'])) {
            $agentsQuery->where('bureau_id', $filters['bureau_id']);
        }

        $agents = $agentsQuery->get();
        $rotations = Rotation::where('status','actif')->get();

        foreach ($agents as $agent) {
            $agentReport = [
                'agent_id' => $agent->id,
                'agent_matricule' => $agent->agent_matricule,
                'agent_nom' => $agent->agent_nom,
                'agent_postnom' => $agent->agent_postnom,
                'agent_prenom' => $agent->agent_prenom,
                'agent_genre' => $agent->agent_genre,
                'agent_telephone' => $agent->agent_telephone,
                'agent_email' => $agent->agent_email,
                'agent_adresse' => $agent->agent_adresse,
                'status' => 'absent'
            ];

            // Vérifier si l'agent est en congé
            $conge = Conge::where('agent_id', $agent->id)
                ->whereDate('conge_date_debut', '<=', $date)
                ->whereDate('conge_date_fin', '>=', $date)
                ->where('status','actif')
                ->first();
            if ($conge) {
                $agentReport['status'] = 'en congé';
            } else {
                // Vérifier la présence de l'agent
                $presence = Presence::where('agent_id', $agent->id)
                    ->whereDate('presence_date', $date)
                    ->where('status','actif')
                    ->first();

                // Vérifier les jours de rotation
                $agentRotation = $rotations->where('agent_id', $agent->id)->first();
                if ($agentRotation) {
                    $joursRotation = explode(',', $agentRotation->jours);
                    $jourActuel = $this->translateDayToFrench($date->format('l'));

                    if (!in_array($jourActuel, $joursRotation)) {
                        $agentReport['status'] = 'rotation';
                    } else {
                        if ($presence) {
                            if (is_null($presence->presence_heure_depart)) {
                                $agentReport['status'] = 'absent';
                            } else {
                                // Vérifier si l'agent est en retard
                                $horaires = Horaire::where('direction_id', $agent->direction_id)
                                    ->where('secretariat_id', $agent->secretariat_id)
                                    ->where('ministere_id', $agent->ministere_id)
                                    ->where('status','actif')
                                    ->first();
                                if ($horaires && Carbon::parse($presence->presence_heure_arrive)->gt(Carbon::parse($horaires->heure_retard))) {
                                    $agentReport['status'] = 'retard';
                                } else {
                                    $agentReport['status'] = 'présent';
                                }
                            }
                        } else {
                            // Vérifier si l'absence est justifiée
                            $absence = Absence::where('agent_id', $agent->id)
                                ->whereDate('created_at', $date)
                                ->where('status','actif')
                                ->first();
                            if ($absence) {
                                $agentReport['status'] = 'absence justifiée';
                            }
                        }
                    }
                } else {
                    if ($presence) {
                        if (is_null($presence->presence_heure_depart)) {
                            $agentReport['status'] = 'absent';
                        } else {
                            // Vérifier si l'agent est en retard
                            $horaires = Horaire::where('direction_id', $agent->direction_id)
                                ->where('secretariat_id', $agent->secretariat_id)
                                ->where('ministere_id', $agent->ministere_id)
                                ->where('status','actif')
                                ->first();
                            if ($horaires && Carbon::parse($presence->presence_heure_arrive)->gt(Carbon::parse($horaires->heure_retard))) {
                                $agentReport['status'] = 'retard';
                            } else {
                                $agentReport['status'] = 'présent';
                            }
                        }
                    } else {
                        // Vérifier si l'absence est justifiée
                        $absence = Absence::where('agent_id', $agent->id)
                            ->whereDate('created_at', $date)
                            ->where('status','actif')
                            ->first();
                        if ($absence) {
                            $agentReport['status'] = 'absence justifiée';
                        }
                    }
                }
            }

            $report[] = $agentReport;
        }

        return $report;
    }

    /**
     * Traduire les jours de francais en Englais
     * @return mixed
    */
    private function translateDayToFrench($day): mixed
    {
        $days = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
        ];

        return $days[$day] ?? $day;
    }
}