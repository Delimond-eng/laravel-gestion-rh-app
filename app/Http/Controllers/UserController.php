<?php

namespace App\Http\Controllers;

use App\Models\Ministere;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * User access manage render page
     * @return Renderable
    */
    public function index(): Renderable
    {
        $allUsers = User::where('status', 'actif')->get();
        $ministeres = Ministere::where('status', 'actif')->get();
        return view('pages/profil/manager', [
            "title"=>"Gestion accès utilisateur",
            "ministeres"=>$ministeres,
            "users"=>$allUsers
        ]);
    }

    /**
     * Permet d'enregistrer un utilisateur
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $pass = $request->input('password');
        $role = $request->input('role');
        $roleKey=null;
        $roleKeyID=null;
        //$allUsers = User::all();
        switch ($role){
            case "ministre":
                $roleKey = "ministere_id";
                $roleKeyID = $request->input('ministere_id');
            break;
            case "drh":
            case "secretaire":
                $roleKey = "secretariat_id";
                $roleKeyID = $request->input('secretariat_id');
                break;
            case "directeur":
                $roleKey = "direction_id";
                $roleKeyID = $request->input('direction_id');
                break;
            default:
                $roleKey = null;
                $roleKeyID = null;

        }
        $lastUser = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($pass),
            'role' => $role,
            'role_key' => $roleKey,
            'role_key_id' => $roleKeyID,
        ]);

        return redirect()->route('users.manager')->with([
            "title"=>"Gestion accès utilisateur",
            "message"=>"Agent créé avec succès !",
        ]);
    }
}
