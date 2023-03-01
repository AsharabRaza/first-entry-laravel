<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\User\LotteryController;


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
        Route::any('/edit-profile',[AdminController::class,'edit_profile'])->name('edit-profile');
        Route::any('/change-password',[AdminController::class,'change_password'])->name('change-password');
    });

});




























