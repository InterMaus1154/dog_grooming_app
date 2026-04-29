<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'string|required'
        ]);

        $user = User::where('username', $request->input('identifier'))->orWhere('email', $request->input('identifier'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('auth.login.show')->with('error', 'Invalid credentials!')->withInput($request->only('identifier'));
        }

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        session()->regenerateToken();
        return redirect()->route('auth.login.show');
    }
}
