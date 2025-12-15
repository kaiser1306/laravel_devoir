<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher le formulaire d'ajout de produit
Route::get('/products/create', function () {
    return view('products.create');
})->name('products.create');

// Route pour traiter la soumission du formulaire (gérée par l'API)
// La route API est déjà définie dans api.php
