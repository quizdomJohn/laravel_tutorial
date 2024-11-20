<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;  //import it
use App\Http\Controllers\ExampleController;

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

Route::get('/',[UserController::class,"showCorrectHomepage"]); //modified so it will show a template depending if the user is logged in
Route::get('/about',[ExampleController::class,"aboutpage"]);
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);