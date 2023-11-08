<?php

namespace App\Contracts;

use App\Models\Game\Player;
use Illuminate\Support\Collection;

interface GameTypeInterface {
    /**
     * Initializes the scores for each player.
     *
     * @param Collection<int|string, mixed> $players
     * @return Collection<int|string, Player>
     */
    public function initializeScores(Collection $players): Collection;
}
