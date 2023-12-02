<?php

namespace App\Http\Controllers;

use App\Events\GameUpdated;
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
        $clientId = strval($data['client_id']);
        $score = intval($data['score']);
        $withDouble = boolval($data['with_double']);

        $game = Game::query()
            ->withCurrentSetAndLeg()
            ->with('currentSet', 'currentLeg')
            ->where('hash', $hash)
            ->firstOrFail();

        try {
            $isValid = $this->scoreService->handleScoreSubmission($game, $playerId, $score, $withDouble);
        } catch (ScoreException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 400);
        }

        if (!$isValid) {
            return jsonResponse(false, 'Invalid score entered!', null, 400);
        }

        $this->gameplayService->addScoreDataToPlayer($game);
        $this->gameplayService->determineCurrentTurn($game);
        $winner = $this->gameplayService->checkForLegWinner($game, $playerId);

        if ($winner) {
            $this->gameplayService->endLeg($game, $winner);

            event(new GameUpdated($game, $clientId));

            return jsonResponse(true, 'Leg ended', [
                'status' => 'leg_ended',
                'winner' => $winner->name,
                'next_step' => 'overview',
                'game' => new GameResource($game)
            ]);
        }

        event(new GameUpdated($game, $clientId));

        return jsonResponse(true, 'Score saved!', new GameResource($game));
    }
}
