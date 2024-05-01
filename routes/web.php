<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

//Route:: Pour naviguer à la page Tableau de bord
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//Route::Pour naviguer à la page de creation agent
Route::get('/agents.create/{id?}', [App\Http\Controllers\AgentController::class, 'navigateToCreatePage']);
Route::post('/agents.create', [App\Http\Controllers\AgentController::class, 'creerAgent'])->name('agents.create');
Route::get('/agent.delete/{id}', [App\Http\Controllers\AgentController::class, 'supprimerAgent'])->name('agent.delete');

//Route::Pour afficher la liste des agents
Route::get('/agents', [App\Http\Controllers\AgentController::class, 'showList'])->name('config.agents');

//Route:: de configuration provinces.create
Route::get('/provinces/{id?}', [ConfigController::class, 'configProvince'])->name('config.provinces');
Route::post('/provinces', [ConfigController::class, 'creerProvince'])->name('config.create.provinces');

//Route:: de configuration ministères
Route::get('/ministeres/{id?}', [ConfigController::class, 'configMinistere'])->name('config.ministeres');
Route::post('/ministeres', [ConfigController::class, 'creerMinistere'])->name('config.create.ministeres');

//Route:: de configuration secretariats
Route::get('/secretariats/{id?}', [ConfigController::class, 'configSecretariat'])->name('config.secretariats');
Route::post('/secretariats', [ConfigController::class, 'creerSecretariat'])->name('config.create.secretariats');

//Route:: de configuration directions
Route::get('/directions/{id?}', [ConfigController::class, 'configDirection'])->name('config.directions');
Route::post('/directions', [ConfigController::class, 'creerDirection'])->name('config.create.directions');

//Route:: de configuration divisions
Route::get('/divisions/{id?}', [ConfigController::class, 'configDivision'])->name('config.divisions');
Route::post('/divisions', [ConfigController::class, 'creerDivision'])->name('config.create.divisions');

//Route:: de configuration bureau
Route::get('/bureaux/{id?}', [ConfigController::class, 'configBureau'])->name('config.bureaux');
Route::post('/bureaux', [ConfigController::class, 'creerBureau'])->name('config.create.bureaux');


//Route:: de configuration grade
Route::get('/grades/{id?}', [ConfigController::class, 'configGrade'])->name('config.grades');
Route::post('/grades', [ConfigController::class, 'creerGrade'])->name('config.create.grades');

//Route:: de configuration rotations
Route::get('/rotations', [ConfigController::class, 'configRotation'])->name('config.rotations');

//Route:: de configuration Horaire travail
Route::get('/HoraireTravail', [ConfigController::class, 'configHoraireTravail'])->name('config.HoraireTravail');

//Route:: de configuration equipe
Route::get('/equipe', [ConfigController::class, 'configEquipe'])->name('config.equipe');

//Route:: de configuration type congé
Route::get('/TypeConge', [ConfigController::class, 'configTypeConge'])->name('config.TypeConge');
//Route:: de configuration fonction
Route::get('/fonctions/{id?}', [ConfigController::class, 'configFonction'])->name('config.fonctions');
Route::post('/fonctions', [ConfigController::class, 'creerFonction'])->name('config.create.fonctions');

//Route:: pour supprimer de la base de données via la table
Route::get('/delete/{table}/{id}', function (string $table, int $id){
    DB::table($table)
        ->where('id', $id)
        ->update(["status"=>"deleted"]);
    return redirect()->back()->with(['message'=> 'Suppression effectuée !']);
});
