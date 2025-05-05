<?php

namespace App\Http\Controllers\LoginFaille;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StandardLoginController extends Controller
{
    public function showForm()
    {
        return view('login-faille.standard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants invalides']);
    }
}
