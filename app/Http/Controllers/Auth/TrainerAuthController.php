<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TrainerAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.trainer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:trainers,email',
            'username' => 'required|unique:trainers,username',
            'password' => 'required|confirmed|min:6',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18',
            'location' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        Trainer::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'location' => $request->location,
            'phone' => $request->phone,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect()->route('trainer.login');
    }

    public function showLoginForm()
    {
        return view('auth.trainer-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('trainer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/trainer/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect('/trainer/login');
    }
    public function regiserLoading()
    {
        return view('auth.register-loading');
    }
}
