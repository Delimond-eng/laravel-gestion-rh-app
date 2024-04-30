<?php

use App\Http\Controllers\ConfigController;
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
Route::get('/agents-create', [App\Http\Controllers\AgentController::class, 'navigateToCreatePage'])->name('agents-create');

//Route::Pour afficher la liste des agents
Route::get('/agents', [App\Http\Controllers\AgentController::class, 'showList'])->name('config.agents');

//Route:: de configuration provinces
Route::get('/provinces', [ConfigController::class, 'configProvince'])->name('config.provinces');

//Route:: de configuration ministères
Route::get('/ministeres', [ConfigController::class, 'configMinistere'])->name('config.ministeres');

//Route:: de configuration secretariats
Route::get('/secretariats', [ConfigController::class, 'configSecretariat'])->name('config.secretariats');

//Route:: de configuration directions
Route::get('/directions', [ConfigController::class, 'configDirection'])->name('config.directions');

//Route:: de configuration divisions
Route::get('/divisions', [ConfigController::class, 'configDivision'])->name('config.divisions');

//Route:: de configuration bureau
Route::get('/bureaux', [ConfigController::class, 'configBureau'])->name('config.bureaux');


//Route:: de configuration grade
Route::get('/grades', [ConfigController::class, 'configGrade'])->name('config.grades');


//Route:: de configuration fonction
Route::get('/fonctions', [ConfigController::class, 'configFonction'])->name('config.fonctions');


//Route:: de configuration rotations
Route::get('/rotations', [ConfigController::class, 'configRotation'])->name('config.rotations');
