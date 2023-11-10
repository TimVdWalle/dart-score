<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameStoreRequest;
use App\Models\Game\Game;
use App\Services\GameService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

//use App\Models\Game;

class GameController extends Controller
{
    /**
     * @return Response
     */
    public function init()
    {
        $gameHash = (new GameService())->getNextHash();
        return Inertia::render('Game/Init', [
            'gameHash' => strval($gameHash),
            'csrf' => csrf_token(),
        ]);
    }

    /**
     * @param GameStoreRequest $request
     * @return RedirectResponse
     */
    public function store(GameStoreRequest $request)
    {
        //dd($request);
        // TODO : update GameStoreRequest with correct validation for array
        $players = $request->players ? json_decode(strval($request->players), true) : null;

        if (!is_array($players) || empty($players)) {
            return redirect()->route('game.init');
        }

        $data = $request->validated();

        $hash = strval($data['hash']);
        $gameType = strval($data['gameType']);
        $outType = strval($data['outType']);

        $gameService = new GameService();
        $game = $gameService->createGame(
            hash: $hash,
            gameType: $gameType,
            outType: $outType,
            players: $players
        );

        return redirect()->route('game.show', ['gameHash' => $game->hash]);
    }

    /**
     * @param $hash
     * @return RedirectResponse|Response
     */
    public function show(string $hash)
    {
        $game = Game::query()
            ->with('players')
            ->where('hash', 'like', $hash)
            ->first();

        if ($game) {
            return Inertia::render('Game/Show', ['game' => $game]);
        } else {
            return redirect()->route('game.init');
        }
    }
}
