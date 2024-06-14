<?php

use App\Http\Controllers\web\HomeScreenController;
use App\Http\Controllers\web\ImageController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login_form');
Route::get('/register', [RegisterController::class, 'index'])->name('register_form');



Route::middleware(['api'])->group(function () {
    Route::get('/image', [ImageController::class, 'index'])->name('get_images');
    Route::get('/home', [HomeScreenController::class, 'index'])->name('home_screen');
});
