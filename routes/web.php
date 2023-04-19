<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", function () {
    return view('index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/users/create', 'create');
    Route::post('/users/store', 'store');
    Route::get('/users/login', 'login');
    Route::post('/users/login', 'post_login');
    Route::post('/users/logout', 'logout');
    Route::get('/users/profile', 'show');
    Route::get('/users/{user:username}/edit', 'edit');
    Route::patch('/users/{user:email}/update', 'update');
    Route::delete('/users/{user:email}/delete', 'destroy');
});
