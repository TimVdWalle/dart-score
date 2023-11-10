<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class Game301Type extends AbstractGameType {
    public function initializeScores(Collection $players): Collection {
        $initialScore = GameType::Game301->getStartingScore();
        return GameTypeFactory::mapPlayers($players, $initialScore);
    }

    // Implement other unique methods for Game301Type
}