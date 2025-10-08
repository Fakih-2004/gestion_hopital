<?php

use App\Http\Controllers\Api\AdminPermissionController;
use App\Http\Controllers\Api\AdminRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\MedecinController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PlanningController;
use App\Http\Controllers\Api\RendezVousController;
use App\Http\Controllers\Api\ServiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admin')->group(function () {
    Route::apiResource('permissions',AdminPermissionController::class);
    Route::apiResource('roles',AdminRoleController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('medecins',MedecinController::class);
    Route::apiResource('patients',PatientController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('plannings', PlanningController::class);

});

Route::post('rendez-vous', [RendezVousController::class, 'store']);