<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Bureau;
use App\Models\Direction;
use App\Models\Division;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Ministere;
use App\Models\Province;
use App\Models\Secretariat;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
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
        $grades = Grade::where('status', 'actif')->get();
        $fonctions = Fonction::where('status', 'actif')->get();
        $ministeres = Ministere::where('status', 'actif')->get();
        return view('pages/agent/agent_creation', [
            "title"=>"Création agents",
            "config"=>[
                "provinces"=>$provinces,
                "ministeres"=>$ministeres,
                "fonctions"=>$fonctions,
                "grades"=>$grades
            ]
        ]);
    }

    public function chargerSecretariats($ministereId): JsonResponse
    {
        $secretariats = Secretariat::where('ministere_id', $ministereId)->where('status', 'actif')->get();
        return response()->json($secretariats);
    }

    public function chargerDirections($secretariatId): JsonResponse
    {
        $directions = Direction::where('secretariat_id', $secretariatId)->where('status', 'actif')->get();
        return response()->json($directions);
    }

    public function chargerDivisions($directionId): JsonResponse
    {
        $divisions = Division::where('direction_id', $directionId)->where('status', 'actif')->get();
        return response()->json($divisions);
    }

    public function chargerBureaux($divisionId): JsonResponse
    {
        $bureaux = Bureau::where('division_id', $divisionId)->where('status', 'actif')->get();
        return response()->json($bureaux);
    }


    /**
     * Creation d'un nouveau agent dans le system
     * @param Request $request
     * @return RedirectResponse
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
            "ministere_id"=>$request->input("ministere_id"),
            "secretariat_id"=>$request->input("secretariat_id"),
            "direction_id"=>$request->input("direction_id"),
            "division_id"=>$request->input("division_id"),
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
        return view('pages/agent/agent_liste', [
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
