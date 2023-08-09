<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\SeasonTeamController;
use App\Http\Controllers\Admin\TeamController;
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

    Route::get('team/list-json', [TeamController::class, 'listJson'])->name('team.list_json');
    Route::resource('team', TeamController::class)
        ->whereNumber('team');
    Route::resource('player', PlayerController::class)
        ->whereNumber('player');

    Route::prefix('season/{season}')->name('season.')->whereNumber('season')->group(function () {
        Route::prefix('team')->name('team.')->group(function () {
            Route::post('', [SeasonTeamController::class, 'store'])->name('store');
        });
        Route::prefix('game')->name('game.')->group(function () {
            Route::post('', [GameController::class, 'store'])->name('store');
        });
    });

    Route::resource('season', SeasonController::class)
        ->whereNumber('season');

//    Route::prefix('profile')->name('profile.')->group(function () {
//        Route::get('', [ProfileController::class, 'edit'])->name('edit');
//        Route::patch('', [ProfileController::class, 'update'])->name('update');
//        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
//    });
});

require __DIR__ . '/auth.php';
