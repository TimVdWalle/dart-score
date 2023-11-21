<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Player;
use App\Models\Score;

class ScoreService
{

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
