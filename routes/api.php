<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BlogsController;
use App\Http\Controllers\api\UploadImageController;
use App\Http\Controllers\api\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login_submit');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('blogs', [BlogsController::class, 'index'])->name('get_blogs');
    Route::get('blogs/{id}', [BlogsController::class, 'getOne']);
    Route::post('create_blogs', [BlogsController::class, 'create']);
    Route::post('update_blogs/{id}', [BlogsController::class, 'update']);
    Route::post('delete_blogs/{id}', [BlogsController::class, 'destroy']);
    Route::post('update_user/{id}', [UserController::class, 'update']);
    Route::post('upload', [UploadImageController::class, 'upload'])->name('upload');
    Route::get('all_file', [UploadImageController::class, 'getAllImage'])->name('all_file');
});
Route::get('images/{filename}', [UploadImageController::class, 'getFile']);



