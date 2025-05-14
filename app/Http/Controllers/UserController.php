<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::where('is_admin', '0')->orderBy('name', 'asc')->get()
                ->groupBy(function($user) {
                    return strtoupper(substr($user->name, 0, 1));
                });

        $statistics = [
            'total' => User::where('is_admin', 0)->get()->count(), 
            'new' =>  User::where('is_admin', 0)->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()
            ])->get()->count()
        ];

        return view('admin.users.index', ['users' => $users, 'statistics' => $statistics]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => [
                'required', 
                'max:14', 
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'password' => ['required', 'min:6']
        ]);

        User::create([
            'name' => $validation['name'],
            'phone' => $validation['phone'],
            'email' => $validation['email'],
            'password' => $validation['password'],
            'is_admin' => $request->has('is_admin')
        ]);

        return redirect('/admin/users')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update (User $user, Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => [
                'required', 
                'max:14', 
                Rule::unique('users')->whereNull('deleted_at')->ignore($user->id)
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->whereNull('deleted_at')->ignore($user->id)
            ]
        ]);

        $user->update([
            'name' => $validation['name'],
            'phone' => $validation['phone'],
            'email' => $validation['email'],
            'is_admin' => $request->has('is_admin')
        ]);
    
        return redirect('/admin/users/'. $user->id)->with('success', 'User Record updated successfully!');
    }    

    public function destroy (User $user)
    {
        $user->delete();

        return redirect('/admin/users')->with('success', 'User record has been deleted.');
    }
}
