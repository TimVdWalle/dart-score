<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game\Game;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class Game101Type extends AbstractGameType {
    public function initializeScores(Collection $players, Game $game): Collection {
        $initialScore = GameType::Game101->getStartingScore();
        return GameTypeFactory::mapPlayers($players, $game, $initialScore);
    }

    // Implement other unique methods for Game101Type
}
