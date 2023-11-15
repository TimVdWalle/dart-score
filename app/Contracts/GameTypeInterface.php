<?php

namespace App\Contracts;

use App\Models\Game\Game;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

interface GameTypeInterface {

    /**
     * @param Collection<int, Player> $players
     * @param Game $game
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players, Game $game): Collection;
    public function getTitle(): string;
}
