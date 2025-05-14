<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterUserController extends Controller
{
    public function create ()
    {        
        return view('auth.register');
    }

    public function store (Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => [
                'required', 
                'max:13', 
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validation['name'],
            'phone' => $validation['phone'],
            'email' => $validation['email'],
            'password' => $validation['password'],
            'is_admin' => false
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
