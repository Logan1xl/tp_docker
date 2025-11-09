<?php

use App\Http\Controllers\etudiants\EtudiantController;
use App\Http\Controllers\etudiants\EtudiantControllerAPI;
use App\Http\Controllers\services\ServiceControllerAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('index');
})->name("home");

Route::get("/register", [EtudiantController::class , "create"])->name("inscription");

Route::post('/register', [EtudiantController::class, "store"])->name("enregistrer");

//Route::delete("/delete/{matricule}", [EtudiantController::class, "destroy"])->name("delete_etudiant");


Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::apiResource('etudiant', EtudiantControllerAPI::class)->only(["store", "index"]);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("etudiant", EtudiantControllerAPI::class)->except(['store', "index"]);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::apiResource('service', ServiceControllerAPI::class)->only(["store", "index"]);



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("service", ServiceControllerAPI::class)->except(['store', "index"]);

});













