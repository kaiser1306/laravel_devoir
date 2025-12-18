<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Afficher le formulaire de création d'utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Stocker un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        try {
            $userData = new UserData($request->only(['name', 'email', 'password', 'password_confirmation']));

            $this->createUser($userData);

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Utilisateur créé avec succès.'
                ], 201);
            }

            return redirect()->route('home')->with('success', 'Utilisateur créé avec succès.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    /**
     * Créer un nouvel utilisateur.
     */
    private function createUser(UserData $userData)
    {
        return User::create($userData->toArray());
    }
}