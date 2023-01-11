<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'customLogin'])->name('auth');

Route::get('/register', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('/register', [CustomAuthController::class, 'customRegistration'])->name('registered');

Route::middleware('authenticated')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/account', [CustomAuthController::class, 'account'])->name('account');
    Route::get('/signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('/update', [CustomAuthController::class, 'update'])->name('update');
    Route::post('/update', [CustomAuthController::class, 'edit'])->name('updated');
});
