<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameStoreRequest;
use App\Services\GameService;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

//use App\Models\Game;

class GameController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function init()
    {
        $gameHash = (new GameService())->getNextHash();
        return Inertia::render('Game/Init', ['gameHash' => $gameHash]);
    }

    public function store(GameStoreRequest $request)
    {
//        $players =

    }

    /**
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function play(string $hash)
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
