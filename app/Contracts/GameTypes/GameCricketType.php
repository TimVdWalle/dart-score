<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Models\Game\Player;
use App\Models\Game\Game;
use Illuminate\Support\Collection;

class GameCricketType implements GameTypeInterface {

    public function __construct() {
        // Constructor logic specific to GameCricketType (if any)
    }

    /**
     * @param Collection<int, Player> $players
     * @param Game $game
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players, Game $game): Collection
    {
        return $players;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return 'Cricket';
    }

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 15;
    }

    public function getStatus(Player $player): string
    {
        return 'winning barely';
    }
}
