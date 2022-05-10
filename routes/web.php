<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', [AuthController::class, 'index']);
// Route::post('/post-login', [AuthController::class, 'postLogin']); 
// Route::get('/registration', [AuthController::class, 'registration']);
// Route::post('/post-registration', [AuthController::class, 'postRegistration']); 
// Route::get('/dashboard', [AuthController::class, 'dashboard']); 
// Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/user-registration', [UserController::class, 'index'])->name('user.registration');

Route::post('/user-store', [UserController::class, 'userPostRegistration']);

Route::get('/user-login', [UserController::class, 'userLoginIndex']);

Route::post('/login', [UserController::class, 'userPostLogin']);

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::get('/logout', [UserController::class, 'logout']);