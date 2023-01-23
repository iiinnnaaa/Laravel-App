<?php

namespace App\Http\Controllers;

use App\Mail\Auth\EmailConfirmationMail;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
{
    // API Auth (sanctum)
    // API resources
    // Create Products Table (id name count price)
    // API CRUD for Products

    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('account');
        }
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(RegisterRequest $request)
    {
        $code = rand(100000, 999999);

        try {
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'code' => $code,
                'password' => Hash::make($request->password),
                'is_verified' => FALSE,
            ]);

            $data = [
                'name' => $request->name,
                'code' => $code,
            ];

            Mail::to('isoyan.inna@gmail.com')->send(new EmailConfirmationMail($data));

            auth()->guard()->login($user);

            return redirect()->route('verification');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function verification()
    {
        if(auth()->user()->is_verified){
            return redirect()->route('home');
        } else{
            return view('emails.verification');
        }
    }

    public function verify(Request $request)
    {
        if ($request->verification_code == auth()->user()->code && auth()->user()->is_verified == FALSE) {
           auth()->user()->update([
               'is_verified' => TRUE,
           ]);
            return view('emails.verified');
        }
    }

}
