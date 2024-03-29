<?php

use App\Http\Controllers\UserController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SendEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [UserController::class, 'welcome']);

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'customLogin'])->name('login');
//Route::match(['get', 'post'], 'login', [CustomAuthController::class, 'customLogin']);

Route::get('fetch-roles', [RoleController::class, 'fetchRoles']);

//Route::get('/roles', [RoleController::class, 'index'])->name('registration');
Route::get('register', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('register', [CustomAuthController::class, 'customRegistration'])->name('registration');

Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});

Route::get('/users', function () {
    return UserResource::collection(User::all());
});

Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::get('/users', function () {
    return UserResource::collection(User::all()->keyBy->id);
});

Route::middleware(['authenticated','is_verified'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('account', [UserController::class, 'account'])->name('account');
    Route::get('signout', [UserController::class, 'signOut'])->name('signout');

    Route::get('update', [UserController::class, 'update'])->name('update');
    Route::post('update', [UserController::class, 'edit'])->name('update');

    Route::get('remove', [UserController::class, 'remove'])->name('remove');

//    Route::controller(CustomAuthController::class)->as('auth.')->group(function () {
//        Route::get('account',  'account')->name('account');
//        Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
//        Route::get('/update', [CustomAuthController::class, 'update'])->name('update');
//        Route::post('/update', [CustomAuthController::class, 'edit'])->name('updated');
//    });

});

//Route::get('/email/send', [SendEmailController::class, 'store'])->name('verification.notice');

Route::get('verification', [CustomAuthController::class, 'verification'])->name('verification');
Route::post('verification', [CustomAuthController::class, 'verify'])->name('verification');

Route::get('verification/resend', [CustomAuthController::class, 'resend'])->name('resend');
