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
Route::resource('/poll', App\Http\Controllers\PollController::class);
Route::post('/', [App\Http\Controllers\PollVotingController::class,'pollParticipate']);
Route::get('/', [App\Http\Controllers\PollVotingController::class,'showParticipationForm']);
Route::resource('/voting', App\Http\Controllers\PollVotingController::class);
Route::get('/voting/{id}/{pol}', [App\Http\Controllers\PollVotingController::class,'show']);
Route::get('/vote/participate/{id}', [App\Http\Controllers\PollVotingController::class,'showPollIdentifyForm']);
Route::post('/poll_participate/', [App\Http\Controllers\PollVotingController::class,'storePollIdentifyForm']);
Route::resource('/dashboard', App\Http\Controllers\CustomerProfileController::class);
Route::get('/poll/active/{id}', [App\Http\Controllers\CustomerProfileController::class,'activePoll']);
Route::get('/poll/deactive/{id}', [App\Http\Controllers\CustomerProfileController::class,'deactivePoll']);
Route::get('/poll/view/{id}', [App\Http\Controllers\CustomerProfileController::class,'pollView']);

Route::view('/register_billing', 'signUpBilling');
//Route::view('/create_poll', 'createPoll');

Route::view('/select_plan', 'selectPlan');

Route::prefix('admin')->group(function(){

    Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class,'index']);
    Route::get('customer',[\App\Http\Controllers\Admin\CustomerController::class,'index']);
    Route::get('customer/delete/{id}',[\App\Http\Controllers\Admin\CustomerController::class,'destroy']);
});
