<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Agent;
use App\Models\Conge;
use App\Models\Horaire;
use App\Models\Presence;
use App\Models\Rotation;
use App\Services\HolidaysService;
use App\Services\PresenceReportService;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    protected HolidaysService $holyDaysServices;

    public function __construct(HolidaysService $holidaysService)
    {
        $this->holyDaysServices = $holidaysService;
    }

    /**
     * Pointer une presence d'un agent
     * @param int $agentId
     * @return JsonResponse
     */
    public function pointagePresence(int $agentId): JsonResponse
    {
        $today = Carbon::now();
        $dayOfWeek = $today->isoFormat('dddd'); // 'dddd' donne le nom complet du jour en français

        // Vérifier si aujourd'hui est un jour férié ou un weekend
        if ($this->holyDaysServices->isWeekend($today) || $this->holyDaysServices->isHoliday($today)) {
            return response()->json(['errors' => 'Aujourd\'hui est un jour férié ou un weekend.'.$today]);
        }

        // Vérifier si l'agent est en congé
        $conge = Conge::where('agent_id', $agentId)
            ->where('conge_date_debut', '<=', $today)
            ->where('conge_date_fin', '>=', $today)
            ->first();

        if ($conge) {
            return response()->json(['errors' => 'L\'agent est en congé.']);
        }
        $rotation = Rotation::where('agent_id', $agentId)
            ->whereRaw("FIND_IN_SET('$dayOfWeek', jours)") // Recherche du jour dans la liste des jours de rotation
            ->exists();

        // Vérifier si aujourd'hui est un jour ouvrable (lundi à vendredi)
        $jourOuvrable = in_array($dayOfWeek, ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi']);

        // Si l'agent est en rotation aujourd'hui ou si c'est un jour ouvrable
        if ($rotation || $jourOuvrable) {
            $agent = Agent::find($agentId);
            if (isset($agent)) {
                // Récupérer l'horaire de l'agent
                $horaire = Horaire::where('direction_id', $agent->direction_id)->first();
                if (!$horaire) {
                    return response()->json(['errors' => 'Aucun horaire trouvé pour cet agent.']);
                }
                $heureArrivee = $today->format('H:i:s');
                $status = 'actif';
                $retard = false;
                // Vérifier si l'agent a déjà pointé aujourd'hui
                $presence = Presence::where('agent_id', $agentId)
                    ->whereDate('presence_date', $today->toDateString())
                    ->first();

                if ($presence) {
                    // Si l'agent a déjà pointé, vérifier l'heure de fin pour permettre le pointage du départ
                    if ($today->gte(Carbon::parse($horaire->heure_fin))) {
                        $presence->presence_heure_depart = $heureArrivee;
                        $presence->save();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Départ pointé avec succès.',
                            'agent' => $presence
                        ]);
                    } else {
                        return response()->json(['errors' => 'L\'agent a déjà pointé l\'arrivée et ne peut pointer le départ qu\'à l\'heure de fin.']);
                    }
                }

                // Vérifier si l'agent est en retard
                if (Carbon::parse($heureArrivee)->gt(Carbon::parse($horaire->heure_retard))) {
                    $status = 'retard';
                    $retard = true;
                }

                // Créer un enregistrement de présence
                $pointage = Presence::create([
                    'agent_id' => $agentId,
                    'presence_date' => $today,
                    'presence_heure_arrive' => $heureArrivee,
                    'status' => $status
                ]);

                if ($retard) {
                    // Calculer le nombre de retards cumulés sur une période donnée (ex. mois en cours)
                    $retardsCumules = Presence::where('agent_id', $agentId)
                        ->where('status', 'retard')
                        ->whereMonth('presence_date', $today->month)
                        ->count();

                    if ($retardsCumules >= $horaire->nbre_retard_notification) {
                        // Envoi de l'avertissement à un agent ayant dépassé les cumules des retards déterminés
                        return response()->json([
                            'status' => 'warning',
                            'message' => "L'agent a dépassé le nombre de retards autorisés et doit recevoir un avertissement.",
                            'agent' => $pointage,
                            'retards_cumules' => $retardsCumules
                        ]);
                    }
                }

                if ($pointage) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Arrivée pointée avec succès.',
                        'agent' => $pointage
                    ]);
                } else {
                    return response()->json(['errors' => "Echec du pointage de l'agent $agentId"]);
                }
            } else {
                return response()->json(['errors' => "Agent non reconnu !"]);
            }
        } else {
            return response()->json(['errors' => 'Vous ne pouvez pas pointer aujourd\'hui.']);
        }

    }
    /**
     * Générer un rapport des absences
     * @param null $date
     * @return JsonResponse
     */
    public function viewAbsencesReport($date = null): JsonResponse
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();

        // Récupérer tous les agents
        $agents = Agent::with(['province','ministere', 'secretariat', 'direction','division','bureau','fonction','grade'])->get();
        $reportData = [];

        // Parcourir chaque agent
        foreach ($agents as $agent) {
            // Initialiser le statut de présence par défaut à "Absent"
            $presenceStatus = 'Absent';
            $rapport = [];

            // Vérifier si l'agent est en congé pour cette journée
            $conge = Conge::where('agent_id', $agent->id)
                ->whereDate('conge_date_debut', '<=', $date)
                ->whereDate('conge_date_fin', '>=', $date)
                ->first();

            if ($conge) {
                continue;
            }
            // Vérifier si l'agent est en rotation pour cette journée
            $rotation = Rotation::where('agent_id', $agent->id)
                ->whereRaw("FIND_IN_SET('$date->isoFormat('dddd')', jours)")
                ->first();

            if ($rotation && $rotation->jours !== $date->isoFormat('dddd')) {
                // Si l'agent est en rotation mais ne doit pas travailler ce jour-là, passer à l'agent suivant
                continue;
            }

            // Vérifier si l'agent est absent pour cette journée
            $presence = Presence::where('agent_id', $agent->id)
                ->whereDate('presence_date', $date)
                ->first();

            if ($presence) {
                // Si l'agent est présent, passer à l'agent suivant
                continue;
            }

            // Ajouter les données de l'agent au rapport
            $reportData[] = [
                'agent' => $agent,
                'rapport' => $rapport,
            ];
        }

        // Retourner les données du rapport
        return response()->json([
            "status" => "success",
            "datas" => $reportData
        ]);
    }


    /**
     * Show Absence justifié page
     * @return Renderable
    */
    public function viewAbsences():Renderable
    {
        $user = Auth::user();
        $agents = Agent::with('province')
            ->where('status', 'actif');
        if($user->role  !== 'superadmin'){
            $agents->where(''.$user->role_key.'', $user->role_key_id);
        }
        $absences = Absence::with(['agent' => function ($query) use ($user) {
            if ($user->role !== 'superadmin') {
                $query->where($user->role_key, $user->role_key_id);
            }
        }])->where('status', 'actif')->get();

        return view('pages/absence/absence',[
            "title"=>"Gestion des absences",
            "absences"=>$absences,
            "agents"=>$agents->get(),
        ]);
    }

    /**
     * Créer une absences justifiées
     * @param Request $request
     * @return RedirectResponse
     */
    public function createAbsence(Request $request): RedirectResponse
    {
        $userId = Auth::id();
        $motif = $request->input('motif');
        $agentId = $request->input('agent_id');
        $absence = Absence::create([
            'absence_motif'=>$motif,
            'agent_id'=>$agentId,
            'user_id'=>$userId,
        ]);
        return redirect()->route('absences.manager')->with([
            "title"=>"Gestion des absences",
            "message"=>"Absence créée avec succès !",
        ]);
    }


    /**
     * generer la liste des presences
     * @return JsonResponse
     */
    public function generateReports(Request $request): JsonResponse
    {
        $filters = $request->query();

        $dateDebut = $filters['date_debut'] ?? null;
        $dateFin = $filters['date_fin'] ?? null;
        $holidaysService = new HolidaysService();
        $presenceReportService = new PresenceReportService($holidaysService);

        $ministereId = $filters['ministere_id'] ?? null;
        $secretariatId = $filters['secretariat_id'] ?? null;
        $directionId = $filters['direction_id'] ?? null;
        $divisionId = $filters['division_id'] ?? null;
        $bureauId = $filters['bureau_id'] ?? null;

        $filterArray = [];
        if ($ministereId) {
            $filterArray['ministere_id'] = $ministereId;
        }
        if ($secretariatId) {
            $filterArray['secretariat_id'] = $secretariatId;
        }
        if ($directionId) {
            $filterArray['direction_id'] = $directionId;
        }
        if ($divisionId) {
            $filterArray['division_id'] = $divisionId;
        }
        if ($bureauId) {
            $filterArray['bureau_id'] = $bureauId;
        }

        $report = [];

        if ($dateDebut && $dateFin) {
            // Generate report for an interval with filters
            $report = $presenceReportService->generatePresenceReport($dateDebut, $dateFin, $filterArray);
        } elseif ($dateDebut) {
            // Generate report for a specific date with filters
            $report = $presenceReportService->generatePresenceReport($dateDebut, $dateDebut, $filterArray);
        } else {
            // Generate report for today with filters
            $today = Carbon::now()->format('Y-m-d');
            $report = $presenceReportService->generatePresenceReport($today, $today, $filterArray);
        }
        return response()->json([
            "status" => "success",
            "reports" => $report
        ]);
    }

    public function viewReports(Request $request){
        $filters = $request->query();
        $dateDebut = $filters['date_debut'] ?? null;
        $dateFin = $filters['date_fin'] ?? null;
        $holidaysService = new HolidaysService();
        $presenceReportService = new PresenceReportService($holidaysService);

        $ministereId = $filters['ministere_id'] ?? null;
        $secretariatId = $filters['secretariat_id'] ?? null;
        $directionId = $filters['direction_id'] ?? null;
        $divisionId = $filters['division_id'] ?? null;
        $bureauId = $filters['bureau_id'] ?? null;

        $filterArray = [];
        if ($ministereId) {
            $filterArray['ministere_id'] = $ministereId;
        }
        if ($secretariatId) {
            $filterArray['secretariat_id'] = $secretariatId;
        }
        if ($directionId) {
            $filterArray['direction_id'] = $directionId;
        }
        if ($divisionId) {
            $filterArray['division_id'] = $divisionId;
        }
        if ($bureauId) {
            $filterArray['bureau_id'] = $bureauId;
        }

        $report = [];
        if ($dateDebut && $dateFin) {
            // Generate report for an interval with filters
            $report = $presenceReportService->generatePresenceReport($dateDebut, $dateFin, $filterArray);
        } elseif ($dateDebut) {
            // Generate report for a specific date with filters
            $report = $presenceReportService->generatePresenceReport($dateDebut, $dateDebut, $filterArray);
        } else {
            // Generate report for today with filters
            $today = Carbon::now()->format('Y-m-d');
            $report = $presenceReportService->generatePresenceReport($today, $today, $filterArray);
        }
        return view('pages/reports/presences_report',[
            "title"=>"Rapports des présences",
            "reports" => $report
        ]);
    }
}