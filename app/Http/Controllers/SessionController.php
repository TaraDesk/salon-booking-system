<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create ()
    {        
        return view('auth.login');
    }

    public function store (Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        if (! Auth::attempt($validation)) {
            throw ValidationException::withMessages([
                'email' => 'Your email or password is incorrect.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');
    }

    public function destroy ()
    {
        Auth::logout();

        return redirect('/');
    }

    public function show ()
    {
        $user = Auth::user();
        $booking_history = Booking::where('user_id', $user->id)->get();

        return view('users.profile', ['user' => $user, 'bookings' => $booking_history]);
    }

    public function update (Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => [
                'required', 
                'max:13', 
                Rule::unique('users')->whereNull('deleted_at')->ignore(Auth::user()->id)
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->whereNull('deleted_at')->ignore(Auth::user()->id)
            ],
        ]);
        
        $user = Auth::user();

        $user->update([
            'name' => $validation['name'],
            'phone' => $validation['phone'],
            'email' => $validation['email'],
            'is_admin' => false
        ]);
    
        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }    

    public function delete ()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/');
    }

    
}
