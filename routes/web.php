<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('Home', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/********************************************************************************
 * the game routes
 ********************************************************************************/
Route::get(
    '/game/init',
    [GameController::class, 'init']
)
    ->name('game.init');

Route::post(
    '/game/store',
    [GameController::class, 'store']
)
    ->name('game.store');

Route::get('/game/{gameHash}', [GameController::class, 'show'])
    ->name('game.show');

Route::get('/game/{gameHash}/overview', [GameController::class, 'overview'])
    ->name('game.overview');

require __DIR__.'/auth.php';
