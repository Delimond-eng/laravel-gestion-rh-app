<?php

use App\Http\Controllers\TestController;
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

Route::get('/hello', function (){
    $users = \App\Models\User::all();
    return response()->json([
        "status" => "success",
        "utilisateurs" => $users
    ]);
});


Route::post('/checkpoint', function (Request $request){
   $result = \App\Models\User::where('id', $request->user_id)->first();
    return response()->json([
        "status" => "success",
        "message" => [
            "user"=>$result,
            "title"=>"utilisateur pointé avec succes"
        ]
    ]);
});


Route::post('/province.create', function (Request $request){
    $province= \App\Models\Province::create([
        "province_libelle"=>$request->libelle,
        "user_id"=>1
    ]);

    return response()->json([
        "status" => "success",
        "province" => $province
    ]);
});


Route::get('/province.all', function (){
    $provinces = \App\Models\Province::all();
    return response()->json([
        "status" => "success",
        "message"=>"is successfully !",
        "provinces" => $provinces
    ]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
