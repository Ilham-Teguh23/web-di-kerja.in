<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Master\LandingPageController;
use App\Http\Controllers\Master\UsersController;

Route::get("/", [LandingPageController::class,  "index"]);
Route::post('/sending-message', [LandingPageController::class, 'store'])->name('contact-message-store');

Route::prefix("auth")->group(function() {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get("/logout", [DashboardController::class, "authLogout"])->name("auth.logout");
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix("master")->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('contact-message/datatable', [ContactMessageController::class, 'datatable'])->name('contact-message.datatable');
        Route::resource('contact-message', ContactMessageController::class);

        // Users
        Route::get("/users/datatable", [UsersController::class, "datatable"])->name("users.datatable");
        Route::resource("users", UsersController::class);
    });
});
