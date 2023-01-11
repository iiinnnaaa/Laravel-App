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
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'unique:users,email'],
            'name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
        ]);

        try {
            User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
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
        return view('auth.update');
    }

    public function edit(){
        if(Auth::check()){
            $user = User::query()->get()->where( 'name', Auth::user()->name);

        }
    }

    public function signOut()
    {
        Auth::logout();

        return Redirect('login');
    }

}
