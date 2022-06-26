<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ResponseController;
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


Route::get('/',[AdminController::class,'loginForm']);
// Route::get('refresh-csrf', function(){
//     return csrf_token();
// });

Route::post('/employee',[userController::class,'request']);
// Route::post('/employee',[userController::class,'show']);
Route::get('/show',[userController::class,'show']);



Route::get('/register',[AdminController::class,'registerForm']);
Route::post('/register',[AdminController::class,'register']);
Route::post('/login',[AdminController::class,'login']);
Route::get('/showUsers',[AdminController::class,'showUsers']);
Route::get('/showRequest',[AdminController::class,'showRequest']);
Route::get('/showRatings',[AdminController::class,'showRatings']);
// Route::post('/rating',[userController::class,'rating']);
Route::get('/addEmployee',[AdminController::class,'addEmployee']);
Route::post('/addEmployee',[AdminController::class,'Employee_ADD']);
Route::get('/editEmployee/{id}',[AdminController::class,'editEmployee']);
Route::put('/update/{id}',[AdminController::class,'update']);
Route::get('export',[AdminController::class,'export']);
Route::get('logout',[AdminController::class,'logout']);
Route::delete('deleteEmployee/{id}',[AdminController::class,'deleteEmployee']);
Route::post('search',[AdminController::class,'search']);
