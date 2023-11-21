<?php

namespace App\Http\Controllers;

use App\Factories\GameTypeFactory;
use App\Http\Requests\Game\ScoreStoreRequest;
use App\Models\Game;
use App\Services\GameplayService;
use Illuminate\Http\Request;
use App\Services\ScoreService;

class ScoreController extends Controller
{
    /**
     * @var ScoreService
     */
    protected $scoreService;
    /**
     * @var GameplayService
     */
    protected $gameplayService;

    /**
     * @param ScoreService $scoreService
     */
    public function __construct(ScoreService $scoreService, GameplayService $gameplayService)
    {
        $this->scoreService = $scoreService;
        $this->gameplayService = $gameplayService;
    }

    /**
     * @param ScoreStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ScoreStoreRequest $request, string $hash)
    {
        $game = Game::where('hash', $hash)->firstOrFail();
        $playerId = $request->input('player_id');
        $score = $request->input('score');

        // Check if it's the current player's turn
        $currentPlayer = $this->gameplayService->determineCurrentTurn($game);
        if(!$currentPlayer){
            return response()->json(['message' => 'No current player.'], 404);
        }

        if ($currentPlayer->id != $playerId) {
            return response()->json(['message' => 'Not this player\'s turn.'], 422);
        }

        // Check if the score for this player's turn is already submitted
        $latestScore = $currentPlayer->scores()->latest()->first();
        if ($latestScore && $latestScore->turn == $game->currentTurn) {
            return response()->json(['message' => 'Score for this turn already submitted.'], 409);
        }

        // Process the score
        $gameTypeObject = GameTypeFactory::create($game);
        $gameTypeObject->processScore($playerId, $score);

        // Check for a winner
        if ($gameTypeObject->checkWinner()) {
            return response()->json(['message' => 'We have a winner!'], 200);
        }

        return response()->json(['message' => 'Score accepted'], 201);
    }
}
