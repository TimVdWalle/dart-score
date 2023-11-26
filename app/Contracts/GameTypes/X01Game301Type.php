<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Models\Player;

class X01Game301Type extends AbstractX01GameType
{
    public function getStatus(Player $player): string
    {
        return 'losing';
    }

    public function getInitialScore(): int
    {
        return GameType::Game301->getStartingScore();
    }

    public function getMaxThrow(): int
    {
        return 180;
    }
    public function getMinThrow(): int
    {
        return 0;
    }
}
