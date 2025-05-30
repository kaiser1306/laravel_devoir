<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes pour les étudiants
Route::apiResource('students', \App\Http\Controllers\Api\StudentController::class);

// Routes pour les évaluations
Route::apiResource('evaluations', \App\Http\Controllers\Api\EvaluationController::class);
Route::post('evaluations/{evaluation}/grades', [\App\Http\Controllers\Api\EvaluationController::class, 'storeGrade'])->name('grades.store');
