<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Http\Exceptions\ScoreException;
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
    public function handleScoreSubmission(Game $game, int $playerId, int $score, bool $withDouble = false): bool
    {
        $currentPlayer = $this->gameplayService->determineCurrentTurn($game);
        $currentSet = $game->currentSet;
        $currentLeg = $game->currentLeg;

        if (!$currentPlayer || $currentPlayer->id != $playerId) {
            throw new ScoreException('Invalid player turn');
        }

        if (!$currentSet) {
            throw new ScoreException('Invalid current set');
        }

        if (!$currentLeg) {
            throw new ScoreException('Invalid current leg');
        }

        $gameTypeObject = GameTypeFactory::create($game);
        $isValid = $gameTypeObject->validateScore($game, $currentSet, $currentLeg, $currentPlayer, $score, $withDouble);

        if (!$isValid) {
            return false;
        }

        $this->save($game, $currentPlayer, $score, $currentSet->id, $currentLeg->id);
        $currentLeg->turn = $currentLeg->turn + 1;
        $currentLeg->save();

        return true;
    }

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
