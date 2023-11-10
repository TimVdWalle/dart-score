<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game\Game;
use Illuminate\Support\Collection;

class Game501Type extends AbstractGameType {
    /**
     * @param Collection $players
     * @param Game $game
     * @return Collection
     */
    public function initializeScores(Collection $players, Game $game): Collection
    {
        $initialScore = GameType::Game501->getStartingScore();
        return GameTypeFactory::mapPlayers($players, $game, $initialScore);
    }

    // Implement other unique methods for Game501Type
}
