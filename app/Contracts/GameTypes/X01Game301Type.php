<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

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
}