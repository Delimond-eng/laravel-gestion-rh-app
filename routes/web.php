<?php

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
