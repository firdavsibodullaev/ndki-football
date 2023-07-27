<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\ProfileController;
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

Route::redirect('', 'admin');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('', MainController::class)->name('index');

    Route::resource('team', TeamController::class)
        ->whereNumber('team');

//    Route::prefix('profile')->name('profile.')->group(function () {
//        Route::get('', [ProfileController::class, 'edit'])->name('edit');
//        Route::patch('', [ProfileController::class, 'update'])->name('update');
//        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
//    });
});

require __DIR__ . '/auth.php';
