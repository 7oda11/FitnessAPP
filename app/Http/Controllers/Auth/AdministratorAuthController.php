<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdministratorAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.administrator-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:administrators',
            'username' => 'required|string|max:255|unique:administrators',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Administrator::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrator.login');
    }

    public function showLoginForm()
    {
        return view('auth.administrator-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('administrator')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/administrator/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout()
    {
        Auth::guard('administrator')->logout();
        return redirect('/administrator/login');
    }
    public function loginLoading(){
        return view('auth.Login-loading');
    }
}
