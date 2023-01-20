<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function account() {
        $user = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'role' => auth()->user()->role()->first()->name,
            'image' => auth()->user()->image,
        ];

        return view('auth.account', ['user' => $user]);
    }

    public function update() {
        $user = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'image' => auth()->user()->image,
        ];

        return view('auth.update', ['user' => $user]);
    }

    public function edit(Request $request) {
        $data = $request->validate([
            'email' => ['email'],
            'name' => ['string'],
            'role' => ['string'],
            'image' => ['file', 'mimes:png,jpg,jpeg'],
        ]);

        $filePath = null;
        if ($request->hasFile('image')) {
            $uid = auth()->id();
            $fileName = date("Y-m-d-H-i-s") . '_' . $data['image']->getClientOriginalName();
            $filePath = $data['image']->storeAs("/files/{$uid}/images", $fileName, 'public');
        }

//        dd(auth()->user()->image);
//        if(Storage::exists(auth()->user()->image)){
//            Storage::delete(auth()->user()->image);
//        }

//            Mail::to('ssss#')->send()
        try {
            auth()->user()->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role'],
                'image' => $filePath,
            ]);

            return redirect()->route('account');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function remove()
    {
        if (Storage::disk('public')->exists(auth()->user()->image)) {
            Storage::disk('public')->delete(auth()->user()->image);
            auth()->user()->update(['image' => null]);
        }

        return redirect()->route('update');
    }

    public function signOut() {
        auth()->logout();

        return Redirect('login');
    }
}
