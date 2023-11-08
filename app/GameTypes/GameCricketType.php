<?php

namespace App\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class GameCricketType implements GameTypeInterface {
    /**
     * Initializes the scores for each player.
     *
     * @param Collection<int|string, mixed> $players
     * @return Collection<int|string, Player>
     */
    public function initializeScores(Collection $players): Collection
    {
        $initialScore = GameType::Cricket->getStartingScore();
        return GameTypeFactory::mapPlayers($players,$initialScore);
    }
}
