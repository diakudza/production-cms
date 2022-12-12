<?php

use App\Http\Controllers\Admin\MachineController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;


Route::post('/login', LoginController::class)->name('login');
Route::get('/', MainController::class)->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/searchParts', [SearchController::class, 'search'])->name('search.part');

Route::get('/getprogram/{program}/{n}', [ProgramController::class, 'getProgram'])->name('program.getProgram');
Route::resource('program', ProgramController::class)->except(['index']);

Route::resource('task', TaskController::class);

//auth routes
Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', LogoutController::class)->name('logout');
    Route::resource('user', UserProfileController::class);
});

//admin routes
Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::resource('user', UserController::class);
    Route::resource('shift', ShiftController::class);
    Route::resource('position', PositionController::class);
    Route::resource('machine', MachineController::class);
    Route::resource('news', NewsController::class);
    Route::resource('material', MaterialController::class);

    Route::get('/', AdminMainController::class)->name('index');
});

