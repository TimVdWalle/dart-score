<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class GameCricketType implements GameTypeInterface {
    public function __construct() {
        // Constructor logic specific to GameCricketType (if any)
    }

    public function initializeScores(Collection $players, ?int $initialScore): Collection {
        return $players;
    }

    // Implement other unique methods for GameCricketType
}
