<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// ALL
Route::get('/', [ListingController::class, 'index']);
//Create
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
//store
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
//Edit
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
//Edit submit
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');
//Delete listing
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');
// single
Route::get('/listings/{listing}', [ListingController::class, 'show']);
//regester users
Route::get('/register',[UserController::class, 'create'])->middleware('guest');
//create new user
Route::post('/users',[UserController::class, 'store']);
//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
//logins
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//login sumbit
Route::post('/users/login-auth',[UserController::class, 'authenticate']);
