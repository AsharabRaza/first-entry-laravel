<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;

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
        Route::view('/home','dashboard.user.home')->name('home');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });

});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');

    });
    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
        Route::get('/all-users',[UsersController::class,'all_users'])->name('all-users');
        Route::any('/add-user',[UsersController::class,'add_user'])->name('addUser');
        Route::any('/edit-user',[UsersController::class,'edit_user'])->name('editUser');
        Route::get('/edit-user-profile',[UsersController::class,'edit_user_profile'])->name('editUserProfile');
        Route::post('/edit-user-profile',[UsersController::class,'edit_user_profile'])->name('editUserProfile');
        Route::post('/delete-user',[UsersController::class,'delete_user'])->name('deleteUser');
    });

});




























