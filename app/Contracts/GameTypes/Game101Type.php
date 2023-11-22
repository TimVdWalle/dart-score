<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Models\Game;
use App\Models\Player;

class Game101Type extends AbstractGameType
{
    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 100;
    }

    public function getStatus(Player $player): string
    {
        return 'losing hard';
    }

    public function getInitialScore(): int
    {
        return GameType::Game101->getStartingScore();
    }
}
