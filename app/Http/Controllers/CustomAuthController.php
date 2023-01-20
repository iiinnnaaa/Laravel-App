<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller {
    // API Auth (sanctum)
    // API resources
    // Create Products Table (id name count price)
    // API CRUD for Products

    public function index() {
        return view('auth.login');
    }

    public function customLogin(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('account');
        }
    }

    public function registration() {
        return view('auth.register');
    }

    public function customRegistration(RegisterRequest $request) {
        try {
            User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

//    public function account()
//    {
//        $user = [];
//        if (Auth::check()) {
//            $role = Role::query()->where('id', Auth::user()->role_id)->get()->value('name');
////            auth()->user()->role()->name
//            $user = [
//                'name' => Auth::user()->name,
//                'email' => Auth::user()->email,
//                'role' => $role,
//                'image' => Auth::user()->image,
//            ];
//
//        }
//
//        return view('auth.account', ['user' => $user]);
//    }
//
//    public function update()
//    {
//        $user = [];
//        if (Auth::check()) {
//            $user = [
//                'name' => Auth::user()->name,
//                'email' => Auth::user()->email,
//                'image' => Auth::user()->image,
//            ];
//        }
//
//        return view('auth.update', ['user' => $user]);
//    }
//
//    public function edit(Request $request)
//    {
//        if (Auth::check()) {
//            $data = $request->validate([
//                'email' => ['email'],
//                'name' => ['string'],
//                'role' => ['string'],
//                'image' => ['file', 'mimes:png,jpg,jpeg'],
//            ]);
//
//            // heto update profile um, photo avelacnelu hnaravorutyun sarqi,
//            // u vor upload aneluc heto profilum cuyc tas et photon
//
//            //Store the image
////            Storage::put($data['image'], $request);
//            if ($request->hasFile('file')) {
//            }
//            $uid = Auth::id();
//            $fileName = time().'_'.$data['image']->getClientOriginalName();
//            $filePath = $data['image']->storeAs("/files/{$uid}/images", $fileName, 'public');
//
////            Mail::to('ssss#')->send()
//            try {
//                Auth::user()->update([
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'role_id' => $data['role'],
//                    'image' => $filePath,
//                ]);
//
//                return redirect()->route('account');
//
//            } catch (\Exception $e) {
//                return redirect()->back()->with(['error' => $e->getMessage()]);
//            }
//
//            // create migration for add column to users table "role id" foreign key with roles table, on registration select roles. Add change role in update
//            // Laravel relation -  show role in account page (User model/Role model|hasone-belongs)
//            //
//        }
//    }
//
//    public function signOut()
//    {
//        Auth::logout();
//
////        return redirect()->route('login')
//        return Redirect('login');
//    }

}
