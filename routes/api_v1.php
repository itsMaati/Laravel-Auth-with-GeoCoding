<?php

use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function() {
    Route::post('register',[RegisterController::class,'store']);

    Route::middleware("auth:sanctum")->post('test', function() {
        return "If you are seeing this, it means that your token is working";
    });

    Route::post('login',[LoginController::class,'login']);

});


