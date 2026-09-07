<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|in:admin,aprendiz',
        ]);

        $user = User::firstOrCreate(
            ['email' => $credentials['email']],
            [
                'name' => $credentials['email'],
                'password' => $credentials['password'],
                'role' => $credentials['role'],
            ]
        );

        $user->update(['role' => $credentials['role']]);

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
