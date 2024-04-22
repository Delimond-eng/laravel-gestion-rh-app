<?php

namespace App\Http\Controllers;

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
        return view('config/provinces', [
            "title"=>"Paramètre&provinces"
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
}
