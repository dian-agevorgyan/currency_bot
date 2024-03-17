<?php

use App\Http\Controllers\BotTextsController;
use App\Http\Controllers\User\UserHistoriesController;
use App\Http\Controllers\User\UserListController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('user-list', UserListController::class);
    Route::get('user-histories/{userId}', UserHistoriesController::class)->name('admin.userHistories');
    Route::resource('bot_texts', BotTextsController::class);
});
