<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:8|max:20',
            'role' => 'required|in:user,admin',
            'admin_code' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.show')
                             ->withErrors($validator)
                             ->withInput();
        }

        $role = $request->role;
        if ($role === 'admin') {
            if ($request->admin_code !== '0000') {
                return redirect()->route('register.show')
                    ->withErrors(['admin_code' => 'Le code admin est incorrect.'])
                    ->withInput();
            }
        } else {
            $role = 'user';
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role' => $role,
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
