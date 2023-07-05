<?php

use App\Http\Controllers\ShorturlController;
use App\Models\Shorturl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/shorturl",[ShorturlController::class,'store']);

Route::get("/shorturl",[ShorturlController::class,'index']);

