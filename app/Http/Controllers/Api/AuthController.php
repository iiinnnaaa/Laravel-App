<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'role_id' => ['required'],
            'password' => 'required',
        ]);

        try {
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);


        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email or Password does not match with our record.',
            ], 401);
        }

        $user = User::query()->where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Logged in successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken], 200
        );
    }
}
