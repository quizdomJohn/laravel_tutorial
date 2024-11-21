<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UserController;  //import it

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

// User related routes
Route::get('/',[UserController::class,"showCorrectHomepage"]); //modified so it will show a template depending if the user is logged in
Route::get('/about',[ExampleController::class,"aboutpage"]);
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);

// Posts related routes
Route::get('/create-post',[PostController::class,'showCreateForm']);