<?php

namespace App\Http\Controllers\LoginFaille;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VulnerableLoginController extends Controller
{
    public function showForm()
    {
        return view('login-faille.vulnerable');
    }

    public function login(Request $request)
    {
        // Pas de validation des entrées
        // Pas de limitation de tentatives
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard');
        }

        return back()->with('error', 'Identifiants invalides');
    }
}