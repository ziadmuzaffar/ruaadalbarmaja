<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($user)) {
            return redirect()->route('admins.dashboard');
        } else {
            return back()->withErrors([
                'email' => 'الحساب غير موجود'
            ]);
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
