<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('profile.show')
                             ->withErrors($validator)
                             ->withInput();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profil mis à jour.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        auth()->logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Mot de passe modifié avec succès.');
    }

    public function verifyAdminCode(Request $request)
    {
        $request->validate([
            'admin_code' => 'required|string',
        ]);
        if ($request->admin_code === '0000') {
            $user = Auth::user();
            $user->role = 'admin';
            $user->save();
            return redirect()->route('profile.show')->with('success', 'Vous êtes maintenant administrateur !');
        } else {
            return back()->withErrors(['admin_code' => 'Code incorrect.']);
        }
    }
} 