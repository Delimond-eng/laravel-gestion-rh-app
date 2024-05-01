<?php

namespace App\Http\Controllers;

use App\Models\Bureau;
use App\Models\Direction;
use App\Models\Division;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Ministere;
use App\Models\Province;
use App\Models\Secretariat;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    /**
     *  configurer les provinces
     * @param int|null $id
     * @return Renderable
     */
    public function configProvince(int $id=null): Renderable
    {
        $provinces = Province::with('user')
            ->where('status', 'actif')
            ->get();
        if(isset($id)){
            $province = Province::findOrFail($id);
            return view('config/provinces',[
                "province"=>$province,
                "provinces"=>$provinces,
                "title"=>"Paramètre&provinces",
            ]);
        }
        return view('config/provinces', [
            "title"=>"Paramètre&provinces",
            "provinces"=>$provinces
        ]);
    }

    /**
     * Creation d'une province
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerProvince(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Province::updateOrCreate(
            ["id"=>$id],
            [
                "province_libelle"=>$request->input("libelle"),
                "user_id"=>Auth::user()->id
            ]
        );
        return redirect()->route('config.provinces')->with([
            "title"=>"Paramètre&provinces",
            "message"=>isset($id) ? "Mise à jour effectuée avec succès !":"Nouvelle province créée avec succès !",
            "province"=>$result,
        ]);
    }


    /**
     *  configurer les ministères
     * @param int|null $id
     * @return Renderable
     */
    public function configMinistere(int $id=null):Renderable
    {
        $ministeres = Ministere::with('user')
            ->where('status', 'actif')
            ->get();
        if(isset($id)){
            $min = Ministere::findOrFail($id);
            return view('config/ministeres',[
                "min"=>$min,
                "ministeres"=>$ministeres,
                "title"=>"Paramètre&ministères",
            ]);
        }
        return view('config/ministeres', [
            "title"=>"Paramètre&ministères",
            "ministeres"=>$ministeres
        ]);
    }

    /**
     * Creation d'un province
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerMinistere(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Ministere::updateOrCreate(
            ["id"=>$id],
            [
                "ministere_libelle"=>$request->input("libelle"),
                "ministere_description"=>$request->input("description"),
                "user_id"=>Auth::user()->id
            ]
        );

        $ministeres = Ministere::with('user')->get();

        return redirect()->route('config.ministeres')->with([
            "title"=>"Paramètre&ministeres",
            "message"=>isset($id) ? "Mise à jour effectuée avec succès !" :"Nouveau ministere créé avec succès !",
            "ministere"=>$result,
        ]);
    }

    /**
     *  configurer les secrétariats
     * @param int|null $id
     * @return Renderable
     */
    public function configSecretariat(int $id=null):Renderable
    {
        $secretariats = Secretariat::with('ministere')->with('user')
            ->where('status', 'actif')
            ->get();
        $ministeres = Ministere::with('user')->get();

        if(isset($id)){
            $sec = Secretariat::findOrFail($id);
            return view('config/secretariats', [
                "title"=>"Paramètre&secretariats",
                "secretariats"=>$secretariats,
                "ministeres"=>$ministeres,
                "secretariat"=>$sec
            ]);
        }
        return view('config/secretariats', [
            "title"=>"Paramètre&secretariats",
            "secretariats"=>$secretariats,
            "ministeres"=>$ministeres
        ]);
    }

    /**
     *  configurer les secrétariats
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerSecretariat(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Secretariat::updateOrCreate(
            ["id"=>$id],
            [
                "secretariat_libelle"=>$request->input("libelle"),
                "secretariat_description"=>$request->input("description"),
                "ministere_id"=>$request->input("ministere_id"),
                "user_id"=>Auth::user()->id
            ]
        );

        return redirect()->route('config.secretariats')->with([
            "title"=>"Paramètre&secretariats",
            "message"=>isset($id) ? "Mise à jour effectuée avec succès !" :"Secrétariat créé avec succès !",
            "secretariat"=>$result
        ]);


    }


    /**
     * Afficher la page de configuration Direction
     * @param int|null $id
     * @return Renderable
     */
    public function configDirection(int $id=null):Renderable{
        $directions = Direction::with('secretariat')
            ->where('status', 'actif')
            ->with('user')->get();
        $secretariats = Secretariat::with('ministere')
            ->where('status', 'actif')
            ->with('user')->get();

        if(isset($id)){
            $item = Direction::findOrFail($id);
            return view('config/directions', [
                "title"=>"Paramètre&Directions",
                "directions"=>$directions,
                "secretariats"=>$secretariats,
                "direction"=>$item
            ]);
        }

        return view('config/directions', [
            "title"=>"Paramètre&Directions",
            "directions"=>$directions,
            "secretariats"=>$secretariats
        ]);
    }

    /**
     * Creation direction
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerDirection(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Direction::updateOrCreate(
            ["id"=>$id],
            [
                "direction_libelle"=>$request->input('libelle'),
                "direction_description"=>$request->input('description'),
                "secretariat_id"=>$request->input('secretariat_id'),
                "user_id"=>Auth::user()->id,
            ]
        );

        return redirect()->route('config.secretariats')->with([
            "title"=>"Paramètre&Directions",
            "message"=>isset($id) ? "Mise à jour effectuée avec succès !" : "Direction créée avec succès !",
            "direction"=>$result
        ]);

    }

    /**
     * Afficher la page de configuration de la divisions
     * @param int|null $id
     * @return Renderable
     */
    public function configDivision(int $id=null):Renderable{
        $divisions = Division::with('direction')
            ->with('user')
            ->where('status', 'actif')
            ->get();
        $directions = Direction::with('secretariat')
            ->where('status', 'actif')
            ->with('user')->get();

        if(isset($id)){
            $item = Division::findOrFail($id);
            return view('config/divisions', [
                "title"=>"Paramètre&Divisions",
                "divisions"=>$divisions,
                "directions"=>$directions,
                "division"=>$item
            ]);
        }
        return view('config/divisions', [
            "title"=>"Paramètre&Divisions",
            "divisions"=>$divisions,
            "directions"=>$directions
        ]);
    }

    /**
     * Creation division
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerDivision(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Division::updateOrCreate(
            ["id"=>$id],
            [
                "division_libelle"=>$request->input('libelle'),
                "division_description"=>$request->input('description'),
                "direction_id"=>$request->input('direction_id'),
                "user_id"=>Auth::user()->id,
            ]
        );

        return redirect()->route('config.directions')->with([
            "title"=>"Paramètre&Divisions",
            "message"=>isset($id) ?"Mise à jour effectuée avec succès !" :"Division créée avec succès !",
            "division"=>$result
        ]);
    }


    /**
     * Afficher la page de configuration du bureau
     * @param int|null $id
     * @return Renderable
     */
    public function configBureau(int $id=null):Renderable{
        $bureaux = Bureau::with('division')
            ->with('user')
            ->where('status', 'actif')
            ->get();
        $divisions = Division::with('direction')
            ->with('user')
            ->where('status', 'actif')
            ->get();

        if(isset($id)){
            $item = Bureau::findOrFail($id);
            return view('config/bureau', [
                "title"=>"Paramètre&Bureaux",
                "bureaux"=>$bureaux,
                "divisions"=>$divisions,
                "bureau"=>$item
            ]);
        }
        return view('config/bureau', [
            "title"=>"Paramètre&Bureaux",
            "bureaux"=>$bureaux,
            "divisions"=>$divisions
        ]);
    }

    /**
     * Creation bureau
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerBureau(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Bureau::updateOrCreate(
            ["id"=>$id],
            [
                'bureau_libelle'=>$request->input('libelle'),
                'bureau_description' => $request->input('description'),
                'division_id'=> $request->input('division_id'),
                'user_id'=>Auth::user()->id,
            ]
        );
        return redirect()->route('config.bureaux')->with([
            "message"=>isset($id) ? "Mise à jour effectuée avec succès !" :"Nouveau bureau créé avec succès !",
            "bureau"=>$result,
            "title"=>"Paramètre&Bureaux"
        ]);
    }


    /**
     * Afficher la page de configuration du grade
     * @param int|null
     * @return Renderable
     */
    public function configGrade(int $id=null):Renderable{
        $grades = Grade::where('status', 'actif')->get();
        if(isset($id)){
            $item = Grade::findOrFail($id);
            return view('config/grades', [
                "title"=>"Paramètre&Grades",
                "grades"=>$grades,
                "grade"=>$item,
            ]);
        }
        return view('config/grades', [
            "title"=>"Paramètre&Grades",
            "grades"=>$grades
        ]);
    }

    /**
     * Creation grades
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerGrade(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Grade::updateOrCreate(
            ["id"=>$id],
            [
                'grade_code'=>$request->input('code'),
                'grade_libelle' => $request->input('libelle'),
                'user_id'=>Auth::user()->id,
            ]
        );

        return redirect()->route('config.grades')->with([
            "message"=>isset($id) ?"Mise à jour effectuée avec succès !" :"Nouvelle grade créé avec succès !",
            "grade"=>$result,
            "title"=>"Paramètre&Grades"
        ]);

    }

    /**
     * Afficher la page de configuration de la fonction
     * @return Renderable
     */
    public function configFonction(int $id=null):Renderable{
        $fonctions = Fonction::where('status', 'actif')->get();
        if(isset($id)){
            $item = Fonction::findOrFail($id);
            return view('config/fonctions', [
                "title"=>"Paramètre&Fonctions",
                "fonctions"=>$fonctions,
                "fonction"=>$item
            ]);
        }
        return view('config/fonctions', [
            "title"=>"Paramètre&Fonctions",
            "fonctions"=>$fonctions
        ]);
    }

    /**
     * Creation fonction
     * @param Request $request
     * @return RedirectResponse
     */
    public function creerFonction(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $result = Fonction::updateOrCreate(
            ["id" => $id],
            [
                'fonction_libelle' => $request->input('libelle'),
                'user_id' => Auth::user()->id,
            ]
        );

        return redirect()->route('config.fonctions')->with([
            "message" => isset($id) ? 'Mise à jour effectuée !' : "Nouvelle grade créé avec succès !",
            "fonction" => $result,
            "title" => "Paramètre&Fonctions"
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

    /**
     * Afficher la page de configuration des horaires
     * @return Renderable
     */
    public function configHoraireTravail():Renderable{
        return view('config/horaireTravail', [
            "title"=>"Paramètre&horaireTravail"
        ]);
    }

    /**
     * Afficher la page de configuration des equipes
     * @return Renderable
     */
    public function configEquipe():Renderable{
        return view('config/equipe', [
            "title"=>"Paramètre&equipe"
        ]);
    }

    /**
     * Afficher la page de configuration des types conges
     * @return Renderable
     */
    public function configTypeConge():Renderable{
        return view('config/typeConge', [
            "title"=>"Paramètre&TypeConge"
        ]);
    }
}
