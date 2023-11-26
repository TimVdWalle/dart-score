<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Models\Game;
use App\Models\Player;

class X01Game501Type extends AbstractX01GameType
{
    /**
     * @return int
     */
    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 0;

    }

    public function getStatus(Player $player): string
    {
        return 'winning';
    }

    public function getInitialScore(): int
    {
        return GameType::Game501->getStartingScore();
    }
}
