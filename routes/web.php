<?php

use App\Http\Controllers\Master\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get("/", [LandingPageController::class,  "index"]);
