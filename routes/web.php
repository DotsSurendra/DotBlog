<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('login')->middleware('guest');
    Route::get('register', [UserController::class, 'register'])->name('register')->middleware('guest');

    Route::post('login', [UserController::class, 'loginSave'])->name('login.save');
    Route::post('register', [UserController::class, 'registerSave'])->name('register.save');

    //Route::get('google',[UserController::class,'redirectGoogle'])->name('redirectgoogle')->middleware('guest');
    //Route::get('google',[UserController::class,'responceGoogle'])->name('callbackgoogle')->middleware('guest');

    Route::get('google/redirect', [UserController::class, 'redirectGoogle'])->name('redirectgoogle')->middleware('guest');
    Route::get('google/response', [UserController::class, 'responseGoogle'])->name('callbackgoogle')->middleware('guest');


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin');
        Route::get('/logout',[UserController::class,'logout'])->name('logout');

        Route::get('/email/verify', [UserController::class, 'emialVerify'])->name('verification.verify');

        //Route::get('/email/verify',[UserController::class,'emialVerify'])->name('verification.notice');
    });
});

//Route::get('/email/verify', [UserController::class, 'emailVerify'])->name('verification.notice');

//Route::get('/email/verify', [UserController::class, 'emialVerify'])->middleware(['auth'])->name('verification.verify');


