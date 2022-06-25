<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\PageController;
use App\Models\AdminNav;
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
Route::get('/', [PageController::class, 'index']);
Route::post('/email', [PageController::class, 'email'])->name('email');


Route::prefix('/admin')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name(AdminNav::ADMIN_LOGIN);
        Route::post('/login', [LoginController::class, 'login'])->name(AdminNav::ADMIN_LOGIN);
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name(AdminNav::ADMIN_DASHBOARD);

        Route::resource('site_config', 'Admin\SiteConfigurationController')->except('show');
        Route::resource('files', 'Admin\FileController')->except('show', 'update');
        Route::resource('projects', 'Admin\ProjectController')->except('show');
    });
});
