<?php

use App\Http\Controllers\LangController;
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
Route::post('/poll/image/upload', [App\Http\Controllers\PollController::class,'imgUpload'])->name('upload');
Route::resource('/poll', App\Http\Controllers\PollController::class);
Route::put('/poll', [App\Http\Controllers\PollController::class,'update']);
Route::get('/poll/delete/{id}', [App\Http\Controllers\PollController::class,'delete'])->middleware( ['can:Delete Poll']);
Route::post('/', [App\Http\Controllers\PollVotingController::class,'pollParticipate']);
Route::post('/pollParticipate', [App\Http\Controllers\PollVotingController::class,'pollParticipate']);
//Route::post('/', [App\Http\Controllers\PollVotingController::class,'pollParticipate'])->middleware('auth:user,customer,admin');
Route::get('/', [App\Http\Controllers\PollVotingController::class,'showParticipationForm']);
Route::resource('/voting', App\Http\Controllers\PollVotingController::class);
Route::post('/contact_us/send', [App\Http\Controllers\ContactUsController::class,'store']);
Route::post('/subscribe/submit', [App\Http\Controllers\SubscribeController::class,'store']);
Route::get('/voting/{id}/{pol}', [App\Http\Controllers\PollVotingController::class,'show']);
Route::get('/vote/participate/{id}', [App\Http\Controllers\PollVotingController::class,'showPollIdentifyForm']);
Route::post('/poll_participate/', [App\Http\Controllers\PollVotingController::class,'storePollIdentifyForm']);
Route::get('/dashboard', [App\Http\Controllers\CustomerProfileController::class,'index']);

Route::put('/user/update', [App\Http\Controllers\CustomerProfileController::class,'update']);
Route::put('/user/update/password', [App\Http\Controllers\CustomerProfileController::class,'updatePassword']);
Route::get('/poll/action/{id}', [App\Http\Controllers\CustomerProfileController::class,'pollStatus']);
Route::get('/poll/visibility/{id}', [App\Http\Controllers\CustomerProfileController::class,'pollVisibility']);
Route::get('/poll/view/{id}', [App\Http\Controllers\CustomerProfileController::class,'pollView']);
Route::get('/poll/votes/{pollId}/{id}', [App\Http\Controllers\CustomerProfileController::class,'pollVotes']);
Route::get('/payment/{id}', [App\Http\Controllers\PaymentController::class,'show']);
Route::post('/payment', [App\Http\Controllers\PaymentController::class,'store']);
Route::get('/payment_list', [App\Http\Controllers\PaymentController::class,'index']);

Route::get('lang/change', [LangController::class,'change'])->name('changeLang');
Route::get('customer/{id}', [App\Http\Controllers\CustomerProfileController::class,'showCustomer']);


Route::get('/select_plan', [App\Http\Controllers\HomeController::class, 'subscriptionPlan'])->name('Select Plan');
Route::prefix('admin')->group(function(){
    Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class,'index']);
    Route::get('customer',[\App\Http\Controllers\Admin\CustomerController::class,'index'])->middleware( ['can:Delete Poll']);
    Route::get('customer/delete/{id}',[\App\Http\Controllers\Admin\CustomerController::class,'destroy'])->middleware( ['can:Delete Customer']);
    Route::get('customer/status/{id}',[\App\Http\Controllers\Admin\CustomerController::class,'status'])->middleware( ['can:View Customer']);
    Route::get('/contact_us', [App\Http\Controllers\ContactUsController::class,'index'])->middleware( ['can:View Contact Us']);
    Route::get('contact_us/delete/{id}',[\App\Http\Controllers\ContactUsController::class,'destroy'])->middleware( ['can:Delete Contact Us']);
    Route::get('/subscribe', [\App\Http\Controllers\SubscribeController::class,'index'])->middleware( ['can:View Subscriber']);
    Route::get('subscribe/delete/{id}',[\App\Http\Controllers\SubscribeController::class,'destroy'])->middleware( ['can:Delete Subscriber']);
    Route::get('role_list',[\App\Http\Controllers\Admin\RoleController::class,'index'])->middleware( ['can:View Role & Permission']);
    Route::get('assign_permission/{id}',[\App\Http\Controllers\Admin\RoleController::class,'assignPermissionsForm'])->middleware( ['can:View Role & Permission']);
    Route::post('assign_permission',[\App\Http\Controllers\Admin\RoleController::class,'assignPermissions'])->middleware( ['can:Update Role & Permission']);
    Route::resource('/subscription_plan', App\Http\Controllers\SubscriptionPlanController::class);
    Route::get('/subscription_plan/delete/{id}', [App\Http\Controllers\SubscriptionPlanController::class,'delete']);
    Route::get('/subscription_plan/status/{id}', [App\Http\Controllers\SubscriptionPlanController::class,'updateStatus']);

});
