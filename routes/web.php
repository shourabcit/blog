<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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

Auth::routes();


Route::POST('/register/user', [RegisterController::class, 'register'])->name('register.auth.user');
Route::GET('/register/verify/user/{email}/{password}', [RegisterController::class, 'verify'])->name('register.auth.verify');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
