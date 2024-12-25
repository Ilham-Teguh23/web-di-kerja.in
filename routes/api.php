<?php

use App\Http\Controllers\Master\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/get-location", [LandingPageController::class, "getLocation"]);
