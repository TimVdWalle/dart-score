<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use Exception;

class ScoreService
{
    /**
     * @var GameplayService
     */
    protected $gameplayService;

    public function __construct(GameplayService $gameplayService)
    {
        $this->gameplayService = $gameplayService;
    }

    /**
     * @throws Exception
     */
    public function handleScoreSubmission(Game $game, int $playerId, int $score): \Illuminate\Http\JsonResponse
    {
        $currentPlayer = $this->gameplayService->determineCurrentTurn($game);
        $currentSet = $this->gameplayService->getCurrentSet($game);
        $currentLeg = $this->gameplayService->getCurrentLeg($game);

        if (!$currentPlayer || $currentPlayer->id != $playerId) {
            throw new Exception('Invalid player turn');
        }

        if (!$currentSet) {
            throw new Exception('Invalid current set');
        }

        if (!$currentLeg) {
            throw new Exception('Invalid current leg');
        }

        $gameTypeObject = GameTypeFactory::create($game);
        $isValid = $gameTypeObject->validateScore($game, $currentPlayer, $score, $currentSet, $currentLeg);

        if($isValid){
            $this->save($game, $currentPlayer, $score, $currentSet->id, $currentLeg->id);
        }


        // Check for a winner
//        if ($gameTypeObject->checkWinner()) {
//            return 'We have a winner!';
//        }
        return response()->json(['message' => 'Score accepted'], 201);
    }

    /**
     * @param Game $game
     * @param Player $player
     * @param int $score
     * @param int $setId
     * @param int $legId
     * @return Score
     */
    public function save(Game $game, Player $player, int $score, int $setId, int $legId): Score
    {
        return Score::create([
            'game_id' => $game->id,
            'player_id' => $player->id,
            'set_id' => $setId,
            'leg_id' => $legId,
            'score' => $score,
        ]);
    }

}
