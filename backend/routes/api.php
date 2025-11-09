<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\ServiceControllerApi;
use App\Http\Controllers\etudiants\EtudiantControllerAPI;
use App\Http\Controllers\AuthController;

// Service API Routes
Route::apiResource('services', ServiceControllerApi::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('etudiants', EtudiantControllerAPI::class);
});




// Requete Routes
Route::resource('requetes', \App\Http\Controllers\RequeteController::class);
Route::prefix('api')->group(function () {
    Route::resource('requetes', \App\Http\Controllers\RequeteControllerApi::class);
});

// Traitement Routes
Route::resource('traitements', \App\Http\Controllers\TraitementController::class);
Route::prefix('api')->group(function () {
    Route::resource('traitements', \App\Http\Controllers\TraitementControllerApi::class);
});

// Personnel Routes
Route::resource('personnel', \App\Http\Controllers\PersonnelController::class);
Route::prefix('api')->group(function () {
    Route::resource('personnel', \App\Http\Controllers\PersonnelControllerApi::class);
});




