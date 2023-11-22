<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

class Game501Type extends AbstractGameType {
    /**
     * @param Collection<int, Player> $players
     * @return Collection<int, Player>
     */

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 500;
    }

    public function getStatus(Player $player): string
    {
        return 'winning';
    }

    public function getInitialScore():int
    {
        return GameType::Game501->getStartingScore();
    }
}
