<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\ScoreException;
use App\Http\Requests\Game\ScoreStoreRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Services\GameplayService;
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

    public function __construct(ScoreService $scoreService, GameplayService $gameplayService)
    {
        $this->scoreService = $scoreService;
        $this->gameplayService = $gameplayService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function store(ScoreStoreRequest $request, string $hash)
    {
        /** @var string[] $data */
        $data = $request->validated();
        $playerId = intval($data['player_id']);
        $score = intval($data['score']);

        $game = Game::query()
            ->withCurrentSetAndLeg()
            ->with('currentSet', 'currentLeg')
            ->where('hash', $hash)
            ->firstOrFail();

//        if(!$game){
//            return response()->json(['error' => true, 'message' => 'Not in a game'], 400);
//        }

        try {
            $isValid = $this->scoreService->handleScoreSubmission($game, $playerId, $score);
        } catch (ScoreException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 400);
        }

        if($isValid){
            $this->gameplayService->addScoreDataToPlayer($game);
            $this->gameplayService->determineCurrentTurn($game);
        }

        return response()->json([
            'message' => 'Score saved!',
            'game' => new GameResource($game),
        ],
            200);

        //        // Check for a winner
        //        if ($gameTypeObject->checkWinner()) {
        //            return response()->json(['message' => 'We have a winner!'], 200);
        //        }

    }
}
