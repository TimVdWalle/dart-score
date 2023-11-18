<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameStoreRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\RedirectResponse;
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
        // Assuming $request->players is a JSON string or null
        $playersJson = $request->players;

        if (is_string($playersJson)) {
            // Decode if it's a valid string
            /** @var ?array<int, array{id: int, name: string}> $players */
            $players = json_decode($playersJson, true);
        } else {
            // Set to null if it's not a string
            /** @var ?array<int, array{id: int, name: string}> $players */
            $players = null;
        }

        if (!is_array($players) || empty($players)) {
            return redirect()->route('game.init');
        }

        /** @var array<string, string> $data */
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
     * @throws \Exception
     */
    public function show(string $hash): Response|RedirectResponse
    {
        /** @var ?Game $game */
        $game = Game::query()
            ->with('players.scores')
            ->where('hash', 'like', $hash)
            ->first();

        if(!$game){
            return redirect()->route('game.init');
        }

        (new GameService())->addCurrentScoreToPlayers($game);
        $gameResource = new GameResource($game);
        return Inertia::render('Game/Show', ['game' => $gameResource]);

    }
}
