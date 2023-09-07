<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\SeasonTeamController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TournamentController;
use App\Http\Controllers\Admin\UserController;
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

    Route::resource('team', TeamController::class)->whereNumber('team');
    Route::resource('player', PlayerController::class)->whereNumber('player');
    Route::resource('tournament', TournamentController::class)->whereNumber('tournament');

    Route::prefix('season/{season}')
        ->name('season.')
        ->whereNumber('season')
        ->group(function () {
            Route::get('json', [SeasonController::class, 'showJson'])->name('show_json');

            Route::prefix('team')->name('team.')->group(function () {
                Route::get('', [SeasonTeamController::class, 'index'])->name('index');
                Route::post('', [SeasonTeamController::class, 'store'])->name('store');
            });

            Route::prefix('game')->name('game.')->group(function () {
                Route::get('{game}', [GameController::class, 'show'])
                    ->whereNumber('game')
                    ->scopeBindings()
                    ->name('show');

                Route::get('{game}/json', [GameController::class, 'showJson'])
                    ->whereNumber('game')
                    ->scopeBindings()
                    ->name('show_json');

                Route::post('', [GameController::class, 'store'])->name('store');

                Route::patch('{game}/start', [GameController::class, 'start'])
                    ->whereNumber('game')
                    ->scopeBindings()
                    ->name('start');
                Route::patch('{game}/finish', [GameController::class, 'finish'])
                    ->whereNumber('game')
                    ->scopeBindings()
                    ->name('finish');
                Route::patch('{game}/save-score', [GameController::class, 'saveScore'])
                    ->whereNumber('game')
                    ->scopeBindings()
                    ->name('save_score');
            });
        });

    Route::resource('season', SeasonController::class)->whereNumber('season');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::patch('password', [ProfileController::class, 'updatePassword'])->name('update_password');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');
        Route::get('{user}/edit', [UserController::class, 'edit'])
            ->whereNumber('user')
            ->name('edit');
        Route::patch('{user}', [UserController::class, 'update'])
            ->whereNumber('user')
            ->name('update');
        Route::patch('{user}/password', [UserController::class, 'updatePassword'])
            ->whereNumber('user')
            ->name('update_password');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])
            ->whereNumber('user')
            ->name('destroy');
    });
});

require __DIR__ . '/auth.php';
