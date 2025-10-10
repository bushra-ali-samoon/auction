<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $redirectTo = '/home';

    // Show register form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle register request
    public function register(Request $request)
    {
        // Validate input
        $this->validator($request->all())->validate();

        // Create user
        $user = $this->create($request->all());

        // Login user automatically
        auth()->login($user);

        return redirect($this->redirectTo)->with('success', 'Registration successful!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
         ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
             'role' => $data['role'],

         ]);
    }
}
