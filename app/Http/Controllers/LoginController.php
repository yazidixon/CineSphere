<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login.show')
                             ->withErrors($validator)
                             ->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return redirect()->route('login.show')->withErrors([
            'email' => "Les informations d'identification sont incorrectes."
        ])->withInput();
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Déconnexion réussie.');
    }
} 