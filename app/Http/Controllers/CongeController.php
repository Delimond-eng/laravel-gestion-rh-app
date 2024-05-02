<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\CongeType;
use App\Models\Fonction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{
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
                'conge_date_fin' => $request->input('date_fin'),
                'conge_motif' => $request->input('motif'),
                'agent_id' => $request->input('agent_id'),
                'type_id' => $request->input('type_id'),
                'user_id' => Auth::user()->id,
            ]
        );
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
        $conges = Conge::with('type')
            ->with('user')
            ->with('agent')
            ->whereNot('status', 'deleted')
            ->get();
        return view('pages/conge/conge_report',[
            "title"=>"Rapport des congés",
            "conges"=>$conges
        ]);
    }
}
