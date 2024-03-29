<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('{guard}/login',[App\Http\Controllers\Auth\LoginController::class,'showLoginForm']);
Route::get('{guard}/register',[App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm']);
Route::post('{guard}/login',[App\Http\Controllers\Auth\LoginController::class,'login']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/', 'poll_participation');
