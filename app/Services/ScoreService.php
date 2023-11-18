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
     * @return void
     */
    public function setScore(Game $game, Player $player, int $score)
    {
        Score::create([
            'game_id' => $game->id,
            'player_id' => $player->id,
            'score' => $score,
        ]);
    }

    // Add other methods as needed, like updating scores, getting current score, etc.
}
