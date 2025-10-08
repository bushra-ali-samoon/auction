<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate input
        $this->validator($request->all())->validate();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login successful
            $request->session()->regenerate();
            return redirect($this->redirectTo)->with('success', 'Login successful!');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
    }
}
