<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    /**
     * Naviguer à la page de création de l'agent
     * @return Renderable
    */
    public function navigateToCreatePage() : Renderable
    {
        return view('agent_creation', [
            "title"=>"Création agents"
        ]);
    }

    /**
     * Affichage de la liste des agents
     * @return Renderable
    */
    public function showList() : Renderable
    {
        return view('agent_liste', [
            "title"=>"Liste des agents"
        ]);
    }
}
