<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameStoreRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Services\GameplayService;
use App\Services\GameService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

//use App\Models\Game;

class GameController extends Controller
{
    protected GameService $gameService;

    protected GameplayService $gameplayService;

    public function __construct(GameService $gameService, GameplayService $gameplayService)
    {
        $this->gameService = $gameService;
        $this->gameplayService = $gameplayService;
    }

    /**
     * @return Response
     */
    public function init()
    {
        return Inertia::render('Game/Init', [
            'csrf' => csrf_token(),
        ]);
    }

    /**
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function store(GameStoreRequest $request)
    {
        /** @var array<string, string> $data */
        $data = $request->validated();

        /** @var string[] $players */
        $players = $data['players'];
        $gameType = strval($data['gameType']);
        $outType = strval($data['outType']);

        $game = $this->gameService->createGame(
            gameType: $gameType,
            outType: $outType,
            players: $players
        );

        return redirect()->route('game.show', ['gameHash' => $game->hash]);
    }

    /**
     * @throws \Exception
     */
    public function show(string $hash): Response|RedirectResponse
    {
        /** @var ?Game $game */
        $game = Game::query()
            ->withCurrentSetAndLeg()
            ->with('currentSet')
            ->with('currentLeg')
            ->where('hash', 'like', $hash)
            ->first();

        if (!$game) {
            return redirect()->route('game.init');
        }

        $this->gameplayService->addScoreDataToPlayer($game);
        $this->gameplayService->determineCurrentTurn($game);

        $gameResource = new GameResource($game);

        return Inertia::render('Game/Show', ['game' => $gameResource]);
    }

    public function overview(string $hash)
    {
        /** @var ?Game $game */
        $game = Game::query()
            ->withCurrentSetAndLeg()
            ->with('currentSet')
            ->with('currentLeg.winner')
            ->where('hash', 'like', $hash)
            ->first();

        if (!$game) {
            return redirect()->route('game.init');
        }

        $winner = $game->currentLeg->winner;

        return Inertia::render('Game/Overview', ['winner' => $winner]);
    }
}
