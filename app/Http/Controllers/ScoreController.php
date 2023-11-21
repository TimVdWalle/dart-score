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
     * @throws \Exception
     */
    public function store(ScoreStoreRequest $request, string $hash)
    {
        /** @var string[] $data */
        $data = $request->validated();
        $game = Game::where('hash', $hash)->firstOrFail();
        $playerId = intval($data['player_id']);
        $score = intval($data['score']);

        $response = $this->scoreService->handleScoreSubmission($game, $playerId, $score);



//        // Check for a winner
//        if ($gameTypeObject->checkWinner()) {
//            return response()->json(['message' => 'We have a winner!'], 200);
//        }

        return $response;
    }
}
