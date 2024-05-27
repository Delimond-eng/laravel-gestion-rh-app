<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\CongeType;
use App\Models\Fonction;
use App\Services\HolidaysService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{
    protected HolidaysService $service;

    public function __construct(HolidaysService $holidaysService)
    {
        $this->service = $holidaysService;
    }

    /**
     * Afficher la page de configuration des types conges
     * @return Renderable
     */
    public function configTypeConge():Renderable{
        $types = CongeType::where('status', 'actif')->get();
        return view('config/typeConge', [
            "title"=>"Paramètre&TypeConge",
            "types"=>$types
        ]);
    }


    /**
     * Creation d'un type de congé
     * @param Request $request
     * @return RedirectResponse
    */
    public function creerTypeConge(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = CongeType::updateOrCreate(
            ["id" => $id],
            [
                'conge_type_libelle' => $request->input('libelle'),
                'conge_type_description' => $request->input('description'),
                'user_id' => Auth::user()->id,
            ]
        );


        $message = isset($id) ? 'Mise à jour effectuée !' : "Type de congé créé avec succès !";

        return redirect()->route('config.type_conge.view')->with([
            "message" => $message,
            "title" => "Paramètre&Type de congé"
        ]);
    }


    /**
     * Afficher la page de l'attribution du congé
     * @return Renderable
     */
    public function attributionConge():Renderable{
        $types = CongeType::where('status', 'actif')->get();
        $agents = Agent::where('status', 'actif')->get();
        return view('pages/conge/conge_attribution', [
            "title"=>"Attribution congé",
            "types"=>$types,
            "agents"=>$agents
        ]);
    }

    /**
     * Creation de l'attribution
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerAttribution(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Conge::updateOrCreate(
            ["id" => $id],
            [
                'conge_date_debut' => $request->input('date_debut'),
                'nb_jours' => $request->input('nb_jours'),
                'conge_motif' => $request->input('motif'),
                'agent_id' => $request->input('agent_id'),
                'type_id' => $request->input('type_id'),
                'user_id' => Auth::user()->id,
            ]
        );
        $endDate = $this->service->calculateEndDate($result->conge_date_debut, $result->nb_jours);
        $result->conge_date_fin = $endDate->format('Y-m-d');
        $result->save();
        $message = isset($id) ? 'Mise à jour effectuée !' : "Congé attribué avec succès !";

        return redirect()->route('conge.attribution')->with([
            "message" => $message,
            "title" => "Attribution congé !"
        ]);
    }

    /**
     * Renvoi la liste des rapport congé
     * @return Renderable
    */
    public function rapportConges(): Renderable
    {
        $user = Auth::user();
        $conges = Conge::with('type')
            ->with('user')
            ->with(['agent' => function ($query) use ($user) {
                if ($user->role !== 'superadmin') {
                    $query->where($user->role_key, $user->role_key_id);
                }
            }])
            ->whereNot('status', 'deleted')->get();
        $today = \Carbon\Carbon::now();

        $conges->each(function ($conge) use ($today) {
            $dateDebut = \Carbon\Carbon::parse($conge->conge_date_debut);
            $dateFin = \Carbon\Carbon::parse($conge->conge_date_fin);

            $daysConsumed = $this->service->calculateWorkingDays($dateDebut, $today);

            $daysTotal = $this->service->calculateWorkingDays($dateDebut, $dateFin);
            $daysRemaining = $daysTotal - $daysConsumed;

            if($daysRemaining <= 0){
                $daysRemaining = 0;
            }

            $conge->jours_consommes = $daysConsumed;
            $conge->jours_restants = $daysRemaining;
        });
        return view('pages/conge/conge_report',[
            "title"=>"Rapport des congés",
            "conges"=>$conges
        ]);
    }
}
