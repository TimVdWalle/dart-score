<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Models\Game;
use App\Models\Player;

class X01Game101Type extends AbstractX01GameType
{
    public function getStatus(Player $player): string
    {
        return 'losing hard';
    }

    public function getInitialScore(): int
    {
        return GameType::Game101->getStartingScore();
    }
}
