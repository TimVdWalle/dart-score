<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;

//use App\Models\Game;

class GameController extends Controller
{
    public function init(){
        $gameHash = '12345';
        return Inertia::render('Game/Init', ['gameHash' => $gameHash]);
    }

    public function play($hash)
    {
//        $game = Game::where('hash', $hash)->first();

//        if ($game) {
//        if ($hash) {
//            return view('game.show', ['game' => $game]);
//        } else {
//            return redirect()->route('game.init');
//        }

//        if ($game) {
        if ($hash) {
            return Inertia::render('Game/Play', ['gameHash' => $hash]);
        } else {
            return redirect()->route('game.init');
        }
    }
}
