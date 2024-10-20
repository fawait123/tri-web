<?php

use App\Http\Controllers\BrushingTeethController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
});

Route::group(['prefix' => 'welcome'], function () {
    Route::get('education', [DashboardController::class, 'education']);
    Route::get('education/{uid}', [DashboardController::class, 'educationDetail']);
    Route::get('video', [DashboardController::class, 'video']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile', [DashboardController::class, 'profile']);
        Route::get('brushing-teeth', [DashboardController::class, 'brushingTeeth']);
        // pre test
        Route::get('pre-test', [DashboardController::class, 'preTest']);
        Route::post('pre-test', [DashboardController::class, 'postPreTest']);
        Route::post('observable/pre-test', [DashboardController::class, 'postObservable']);
        // post test
        Route::get('post-test', [DashboardController::class, 'postTest']);
        Route::post('post-test', [DashboardController::class, 'postPostTest']);
        Route::post('observable/post-test', [DashboardController::class, 'postObservablePostTest']);
    });
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/profile', [DashboardController::class, 'adminProfile']);
    // user router
    Route::resource('user', UserController::class);
    // end user router

    // brusing teeth
    Route::resource('brushing-teeth', BrushingTeethController::class);
    // end brushing teeht

    // education
    Route::resource('education', EducationController::class);
});

require_once __DIR__ . '/actions/auth.php';
