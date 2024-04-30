<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    /**
     *  configurer les provinces
     * @return Renderable
    */
    public function configProvince():Renderable
    {
        $provinces = Province::all();
        return view('config/provinces', [
            "title"=>"Paramètre&provinces",
            "provinces"=>$provinces
        ]);
    }

    /**
     *  configurer les ministères
     * @return Renderable
    */
    public function configMinistere():Renderable
    {
        return view('config/ministeres', [
            "title"=>"Paramètre&ministères"
        ]);
    }

    /**
     *  configurer les secrétariats
     * @return Renderable
     */
    public function configSecretariat():Renderable
    {
        return view('config/secretariats', [
            "title"=>"Paramètre&secretariats"
        ]);
    }


    /**
     * Afficher la page de configuration Direction
     * @return Renderable
    */
    public function configDirection():Renderable{
        return view('config/directions', [
            "title"=>"Paramètre&Directions"
        ]);
    }


    /**
     * Afficher la page de configuration de la divisions
     * @return Renderable
     */
    public function configDivision():Renderable{
        return view('config/divisions', [
            "title"=>"Paramètre&Divisions"
        ]);
    }


    /**
     * Afficher la page de configuration du bureau
     * @return Renderable
     */
    public function configBureau():Renderable{
        return view('config/bureau', [
            "title"=>"Paramètre&Bureaux"
        ]);
    }

    /**
     * Afficher la page de configuration du grade
     * @return Renderable
     */
    public function configGrade():Renderable{
        return view('config/grades', [
            "title"=>"Paramètre&Grades"
        ]);
    }

    /**
     * Afficher la page de configuration de la fonction
     * @return Renderable
     */
    public function configFonction():Renderable{
        return view('config/fonctions', [
            "title"=>"Paramètre&Fonctions"
        ]);
    }


    /**
     * Afficher la page de configuration de la rotations
     * @return Renderable
     */
    public function configRotation():Renderable{
        return view('config/rotations', [
            "title"=>"Paramètre&Rotations"
        ]);
    }
}
