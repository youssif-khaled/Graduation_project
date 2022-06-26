<?php

use Illuminate\Http\Request;
use App\Http\Controllers\userController;
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
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/refresh', [userController::class,'refreshToken']);
    Route::post('/employee',[userController::class,'request']);
    Route::post('/logout', [userController::class,'logout']);
    Route::post('/manualRequest',[userController::class,'manualRequest']);
    Route::post('/rating',[userController::class,'rating']);
    Route::post('/deleteRequest',[userController::class,'deleteRequest']);
    Route::get('/getMessage/{token}',[userController::class,'getMessage']);
    Route::get('/getReviews',[userController::class,'getReviews']);
});

Route::post('/login',[userController::class,'login']);
Route::get('/show',[userController::class,'show']);
Route::get('/showRequest',[userController::class,'showRequest']);
Route::get('export',[userController::class,'export']);

