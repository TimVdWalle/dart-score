<?php

use App\Http\Controllers\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->group(function () {
// User route
Route::get('/user', function (Request $request) {
    return $request->user();
});

// Game-related routes
Route::post('/game/{hash}/score', [ScoreController::class, 'store'])
    ->name('game.store.score');
//});
