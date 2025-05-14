<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminSessionController extends Controller
{
    public function home ()
    {
        $recent_bookings = Booking::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()
        ])->orderBy('booking_status', 'desc')->get();

        $bookings = $recent_bookings->map(function ($booking) {
            $booking->issue_at = Carbon::parse($booking->created_at)->format('l, F j Y');
            $booking->booking_date = Carbon::parse($booking->booking_date)->format('l, F j Y');
            
            return $booking;
        });

        $statistics = [
            'new_user' => User::where('is_admin', 0)->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->get()->count(),
            'today_appointment' => Booking::whereDate('booking_date', today()->toDateString())->count(),
            'new_appointment' => Booking::where('booking_status', 'pending')->whereBetween('booking_date', [
                Carbon::now()->startOfMonth()->format('H:i:s'),
                Carbon::now()->endOfMonth()->format('H:i:s')
            ])->count(),
        ];

        return view('admin.dashboard', ['bookings' => $bookings, 'statistics' => $statistics]);
    }

    public function create ()
    {
        return view('auth.admin-login');
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

        $user = Auth::user();

        if (! $user->is_admin) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'You are not authorized to access this page.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/admin/dashboard');
    }

    public function show ()
    {  
        $user = Auth::user();
        $admin_user_count = User::where('is_admin', '1')->count();

        return view('admin.profile', ['user' => $user, 'admin_user' => $admin_user_count]);
    }

    public function update (Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => [
                'required', 
                'max:14', 
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
            'is_admin' => true
        ]);
    
        return redirect('/admin/profile')->with('success', 'Profile updated successfully!');
    }

    public function delete ()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/admin');
    }

    public function destroy ()
    {
        Auth::logout();

        return redirect('/admin');
    }
}
