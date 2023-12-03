<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Events\GameUpdated;
use App\Events\LegEnded;
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
            return jsonResponse(
                false,
                'Invalid score entered!',
                ResponseStatus::invalid_score,
                null,
                400);
        }

        $this->gameplayService->addScoreDataToPlayer($game);
        $this->gameplayService->determineCurrentTurn($game);
        $winner = $this->gameplayService->checkForLegWinner($game, $playerId);

        if ($winner) {
            $this->gameplayService->endLeg($game, $winner);

            $data = [
                'winner' => $winner->name,
                'next_step' => 'overview',
                'next_step_url' => "/game/{$game->hash}/overview",
                'game' => new GameResource($game)
            ];
            event(new LegEnded($game, $clientId, $data));

            return jsonResponse(
                true,
                'Leg ended',
                ResponseStatus::leg_ended, $data);
        }

        event(new GameUpdated($game, $clientId));

        return jsonResponse(
            true,
            'Score saved!',
            ResponseStatus::valid_score,
            [
                'gameResource' => new GameResource($game)
            ]
        );
    }
}
