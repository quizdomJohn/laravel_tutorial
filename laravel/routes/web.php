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
Route::get('/',[UserController::class,"showCorrectHomepage"])->name('login'); //modified so it will show a template depending if the user is logged in
//with 'name('login') we label this as a login route.Send the user there when the user needs to login to see the specific page (for middlewares)
Route::get('/about',[ExampleController::class,"aboutpage"]);
Route::post('/register',[UserController::class,'register'])->middleware('guest');
Route::post('/login',[UserController::class,'login'])->middleware('guest');
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

// Posts related routes
Route::get('/create-post',[PostController::class,'showCreateForm'])->middleware('isLoggedIn');
Route::post('/create-post',[PostController::class,'storeNewPost'])->middleware('auth');
Route::get('/post/{post}',[PostController::class,'viewSinglePost']);
Route::delete('/post/{postToDelete}',[PostController::class,'deletePost'])->middleware('can:delete,postToDelete'); // do the route only if he can delete the post
Route::get('/post/{postToEdit}/edit',[PostController::class,'showEditForm']); // for open the form to edit the post
Route::put('/post/{postToSaveEdit}',[PostController::class,'actuallyUpdate'])->middleware('can:update,postToSaveEdit'); // for saving the edited post

// Profile related routes
Route::get('/profile/{userProfile:username}',[UserController::class,'profile']); // ':username' -> we declare how to look it up