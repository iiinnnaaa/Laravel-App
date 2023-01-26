<?php

namespace App\Http\Controllers;

use App\Mail\Auth\EmailConfirmationMail;
use App\Models\Token;
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

            // Create a token with 1 hour expiration time
            $token = Token::query()->create([
                'token' => $code,
                'user_id' => $user->id,
                'expiry_date' => now()->add('1hour'),
            ]);

            $data = [
                'name' => $request->name,
                'code' => $token->token,
            ];

//            Mail::to($request->email)->send(new EmailConfirmationMail($data));
//            Mail::to('arshakyan.artyom@gmail.com')->send(new EmailConfirmationMail($data));
            Mail::to('isoyan.inna@gmail.com')->send(new EmailConfirmationMail($data));

            auth()->guard()->login($user);

            return redirect()->route('verification');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function verification()
    {
        if (auth()->user()->is_verified) {
            return redirect()->route('home');
        } else {
            return view('emails.verification');
        }
    }

    // Create a separate table for tokens (code) // token user_id expiry date
    // Related to the user
    // Add expiration time (e.g 1hour)
    // Delete token after it's expired
    // Add message after token is expired to resend the code /token

    public function verify(Request $request)
    {
        $token = Token::query()->where('user_id', auth()->id())->get();

        if ($token->first()->expiry_date > now() && $request->verification_code == $token->first()->token) {
            auth()->user()->update([
                'is_verified' => TRUE,
            ]);

            Token::query()->where('user_id', auth()->id())->delete();

            return view('emails.verified');

        } elseif ($token->first()->expiry_date < now()) {

            Token::query()->where('user_id', auth()->id())->delete();

            return view('emails.resend-code');

        } else {
            return redirect()->route('verification')->with('error', 'try again');
        }
    }

    public function resend()
    {
        if (!auth()->user()->is_verified) {

            $code = rand(100000, 999999);

            $token = Token::query()->create([
                'token' => $code,
                'user_id' => auth()->id(),
                'expiry_date' => now()->add('1hour'),
            ]);

            $data = [
                'name' => auth()->user()->name,
                'code' => $token->token,
            ];

//            Mail::to(auth()->user()->email)->send(new EmailConfirmationMail($data));
//            Mail::to('arshakyan.artyom@gmail.com')->send(new EmailConfirmationMail($data));
            Mail::to('isoyan.inna@gmail.com')->send(new EmailConfirmationMail($data));

            return redirect()->route('verification');

        } else {
            return redirect()->route('home');
        }
    }

}
