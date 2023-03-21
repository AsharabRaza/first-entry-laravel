<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\User\LotteryController;
use App\Http\Controllers\Admin\LotteryController as AdminLotteryController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\Agent;
use App\Http\Controllers\FrontEnd\LotteryFormController;
use App\Http\Controllers\User\EntryController;
use App\Http\Controllers\User\SendEmailController;
use App\Http\Controllers\User\EntryVerificationController;


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

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    echo '<p>Cache cleared</p><br>';
    //Clear View cache:
    $exitCode = Artisan::call('view:clear');
    echo '<p>View cache cleared</p><br>';
    //Clear Config cache:
    $exitCode = Artisan::call('config:cache');
    echo '<p>Config cache cleared</p><br>';
});

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();



//User routes
Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
    Route::view('/login','dashboard.user.login')->name('user.login');
});
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');
    });
    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
        Route::get('/home',[UserDashboardController::class,'dashboard'])->name('home');
        Route::any('/logout',[UserController::class,'logout'])->name('logout');
        Route::any('/all-lotteries',[LotteryController::class,'all_lotteries'])->name('all-lotteries');
        Route::any('/add-lottery',[LotteryController::class,'add_lottery'])->name('add-lottery');
        Route::any('/edit-lottery',[LotteryController::class,'edit_lottery'])->name('edit-lottery');
        Route::any('/check-lottery-url',[LotteryController::class,'check_lottery_url'])->name('check-lottery-url');
        Route::any('/customization-form',[LotteryController::class,'customization_form'])->name('customization-form');
        Route::any('/edit-lottery-details',[LotteryController::class,'edit_lottery_details'])->name('edit-lottery-details');
        Route::any('/modify-emails',[LotteryController::class,'modify_emails'])->name('modify-emails');
        Route::any('/update-lottery-agents-details',[LotteryController::class,'update_lottery_agents_details'])->name('update-lottery-agents-details');
        Route::any('/delete-lottery',[LotteryController::class,'delete_lottery'])->name('delete-lottery');
        Route::any('/get-country-timezone',[LotteryController::class,'get_country_timezone'])->name('get-country-timezone');
        Route::any('/events',[EventController::class,'events'])->name('events');
        Route::any('/event-landing',[EventController::class,'event_landing'])->name('event-landing');
        Route::any('/add-event',[EventController::class,'add_event'])->name('add-event');
        Route::any('/all-agents',[Agent::class,'all_agents'])->name('all-agents');
        Route::any('/add-agent',[Agent::class,'add_agent'])->name('add-agent');
        Route::any('/edit-agent',[Agent::class,'edit_agent'])->name('edit-agent');
        Route::any('/delete-agent',[Agent::class,'delete_agent'])->name('delete-agent');
        Route::any('/agents-history',[Agent::class,'agents_history'])->name('agents-history');
        Route::get('/view-profile',[UserController::class,'view_profile'])->name('view-profile');
        Route::post('/upload-profile-image',[UserController::class,'upload_profile_image'])->name('upload-profile-image');
        Route::any('/edit-profile',[UserController::class,'edit_profile'])->name('edit-profile');
        Route::any('/change-password',[UserController::class,'change_password'])->name('change-password');
        Route::any('/all-entries',[EntryController::class,'all_entries'])->name('all-entries');
        Route::any('/remove-winners',[EntryController::class,'remove_winners'])->name('remove-winners');
        Route::any('/remove-entries',[EntryController::class,'remove_entries'])->name('remove-entries');
        Route::any('/all-winners',[EntryController::class,'all_winners'])->name('all-winners');
        Route::any('/all-losers',[EntryController::class,'all_losers'])->name('all-losers');
        Route::any('/send-emails',[SendEmailController::class,'send_emails'])->name('send-emails');
        Route::any('/send-winners-emails',[SendEmailController::class,'send_winners_emails'])->name('send-winners-emails');
        Route::any('/send-losers-emails',[SendEmailController::class,'send_losers_emails'])->name('send-losers-emails');
        Route::any('/email-history',[SendEmailController::class,'email_history'])->name('email-history');
        Route::any('/see-analytics',[SendEmailController::class,'see_analytics'])->name('see-analytics');
        Route::any('/entry-verification',[EntryVerificationController::class,'entry_verification'])->name('entry-verification');
        Route::any('/entry-confirmation',[EntryVerificationController::class,'entry_confirmation'])->name('entry-confirmation');
        Route::any('/get-uid-entries',[EntryVerificationController::class,'get_uid_entries'])->name('get-uid-entries');

    });

});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');

    });
    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::get('/home',[DashboardController::class,'dashboard'])->name('home');
        Route::any('/logout',[AdminController::class,'logout'])->name('logout');
        Route::get('/all-users',[UsersController::class,'all_users'])->name('all-users');
        Route::any('/add-user',[UsersController::class,'add_user'])->name('addUser');
        Route::any('/edit-user',[UsersController::class,'edit_user'])->name('editUser');
        Route::any('/view-user',[UsersController::class,'view_user'])->name('view-user');
        Route::get('/edit-user-profile',[UsersController::class,'edit_user_profile'])->name('editUserProfile');
        Route::post('/edit-user-profile',[UsersController::class,'edit_user_profile'])->name('editUserProfile');
        Route::get('/delete-user',[UsersController::class,'delete_user'])->name('deleteUser');
        Route::get('/in-review-users',[UsersController::class,'in_review_users'])->name('in-review-users');
        Route::get('/paid-users',[UsersController::class,'paid_users'])->name('paid-users');
        Route::get('/assign-membership',[MembershipController::class,'assign_membership'])->name('assign-membership');
        Route::post('/assign-membership',[MembershipController::class,'assign_membership'])->name('assign-membership');
        Route::get('/view-profile',[AdminController::class,'view_profile'])->name('view-profile');
        Route::any('/upload-profile-image',[AdminController::class,'upload_profile_image'])->name('upload-profile-image');
        Route::any('/edit-profile',[AdminController::class,'edit_profile'])->name('edit-profile');
        Route::any('/change-password',[AdminController::class,'change_password'])->name('change-password');
        Route::any('/all-lotteries',[AdminLotteryController::class,'all_lotteries'])->name('all-lotteries');
    });

});


//Front End routes

Route::any('/lottery/{url}',[LotteryFormController::class,'lottery_form'])->name('lottery-form');
Route::any('/captcha',[LotteryFormController::class,'captcha'])->name('captcha');
Route::any('/save_lottery_form',[LotteryFormController::class,'save_lottery_form'])->name('save-lottery-form');
Route::any('/save-s_qrcode',[LotteryFormController::class,'save_s_qrcode'])->name('save-s_qrcode');
Route::any('/uid-status/{uid?}',[LotteryFormController::class,'uid_status'])->name('uid-status');





























