<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('account');
        }
        else{
            return redirect()->back()->with(['error' => 'Login Failed. Please try again.']);
        }
    }

    public function registration()
    {
//        $roles = RoleController::all();
//        $selectedRole = User::first()->role_id;
//
//        return view('auth.register', ['roles'=>$selectedRole]);
        return view('auth.register');
    }

    public function customRegistration(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'unique:users,email'],
            'name' => ['required', 'string'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
        ]);

        try {
            User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);

            return redirect()->route('login');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function account()
    {
        $user = [];
        if (Auth::check()) {
            $user = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ];
        }

        return view('auth.account', ['user' => $user]);
    }

    public function update(){
        $user = [];
        if (Auth::check()) {
            $user = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ];
        }

        return view('auth.update', ['user' => $user]);
    }

    public function edit(Request $request){
        if(Auth::check()){
            $data = $request->validate([
                'email' => ['email'],
                'name' => ['string'],
                'role' => ['required', 'string'],
            ]);

            try {
                Auth::user()->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role_id' => $data['role'],
                ]);

                return redirect()->route('account');

            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }

            // create migration for add column to users table "role id" foreign key with roles table, on registration select roles. Add change role in update
            // Laravel relation -  show role in account page (User model/Role model|hasone-belongs)
            //
        }
    }

    public function signOut()
    {
        Auth::logout();

        return Redirect('login');
    }

}
