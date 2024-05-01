<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Bureau;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Province;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{

    /**
     * Naviguer à la page de création de l'agent
     * @return Renderable
    */
    public function navigateToCreatePage() : Renderable
    {
        $provinces = Province::where('status', 'actif')->get();
        $bureaux = Bureau::where('status', 'actif')->get();
        $grades = Grade::where('status', 'actif')->get();
        $fonctions = Fonction::where('status', 'actif')->get();
        return view('agent_creation', [
            "title"=>"Création agents",
            "config"=>[
                "provinces"=>$provinces,
                "bureaux"=>$bureaux,
                "fonctions"=>$fonctions,
                "grades"=>$grades
            ]
        ]);
    }


    /**
     * Creation d'un nouveau agent dans le system
     * @param Request $request
    */
    public function creerAgent(Request $request)
    {
        $result = Agent::create([
            "agent_matricule"=>$request->input("matricule"),
            "agent_nom"=>$request->input("nom"),
            "agent_postnom"=>$request->input("postnom"),
            "agent_prenom"=>$request->input("prenom"),
            "agent_genre"=>$request->input("genre"),
            "agent_telephone"=>$request->input("telephone"),
            "agent_email"=>$request->input("email"),
            "agent_adresse"=>$request->input("adresse"),
            "province_id"=>$request->input("province_id"),
            "bureau_id"=>$request->input("bureau_id"),
            "fonction_id"=>$request->input("fonction_id"),
            "grade_id"=>$request->input("grade_id"),
            "user_id"=>Auth::user()->id,
        ]);
        return redirect()->route('agents.create')->with([
            "title"=>"Creation&agent",
            "message"=>"Agent créé avec succès !",
            "agent"=>$result,
        ]);
    }

    /**
     * Affichage de la liste des agents
     * @return Renderable
    */
    public function showList() : Renderable
    {
        $agents = Agent::with('province')
                ->with('bureau')
                ->with('fonction')
                ->with('grade')
                ->with('user')
                ->where('status', 'actif')
                ->get();
        return view('agent_liste', [
            "title"=>"Liste des agents",
            "agents"=>$agents
        ]);
    }

    /**
     * Supprimer un agent
     * @param int $id
    */
    public function supprimerAgent($id): RedirectResponse
    {
        $agent = Agent::find($id);
        $agent->status = "deleted";
        $agent->save();
        return redirect()->back()->with(['message'=> 'agent supprimé avec succès !']);
    }
}
