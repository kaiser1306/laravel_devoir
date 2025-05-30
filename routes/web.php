<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes d'authentification
Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);
Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

// Routes pour les étudiants
Route::resource('students', StudentController::class);

// Routes pour les évaluations
Route::resource('evaluations', EvaluationController::class);
Route::post('evaluations/{evaluation}/grades', [EvaluationController::class, 'storeGrade'])->name('grades.store');
Route::get('evaluations/statistics', [EvaluationController::class, 'statistics'])->name('evaluations.statistics');
Route::get('/', function () {
    return view('welcome');
});