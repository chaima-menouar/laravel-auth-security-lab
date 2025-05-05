<?php

namespace App\Http\Controllers\LoginFaille;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Validation\ValidationException;

class SecureLoginController extends Controller
{
    protected $maxAttempts = 3;
    protected $decayMinutes = 5;

    public function __construct()
    {
        $this->middleware('throttle:'.$this->maxAttempts.','.$this->decayMinutes)->only('login');
    }

    public function showForm()
    {
        return view('login-faille.secure');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}