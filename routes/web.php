<?php

use App\Http\Controllers\Admin\LoginController;
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
Route::prefix('/admin')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin_login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin_login');
    });
});
