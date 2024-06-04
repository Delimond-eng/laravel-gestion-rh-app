<?php

use App\Http\Controllers\TestController;
use App\Models\Agent;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/presence.pointage/{agentId}',[\App\Http\Controllers\PresenceController::class, 'pointagePresence']);
Route::get('/presences.reports',[\App\Http\Controllers\PresenceController::class, 'generateReports']);

Route::get('/agents/{directionId}', function(int $directionId){
    $agents=Agent::with('direction')->where('direction_id', $directionId)
    ->where('status', 'actif')
    ->get();
    return response()->json([
        "status"=>"success",
        "agents"=>$agents
    ]);
});

Route::get('/directions', function(){
    $directions = Direction::with('secretariat.ministere')
    ->where('status', 'actif')
    ->get();
    return response()->json([
        "status"=>"success",
        "directions"=>$directions
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});