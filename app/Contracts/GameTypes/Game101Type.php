<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game\Game;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class Game101Type extends AbstractGameType {
    /**
     * @param Collection<int, Player> $players
     * @param Game $game
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players, Game $game): Collection {
        $initialScore = GameType::Game101->getStartingScore();
        return GameTypeFactory::mapPlayers($players, $game, $initialScore);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        if(!$this->outTypeStrategy)
        {
            return "101";
        }

        $outTypeTitle = $this->outTypeStrategy->getTitle();
        return "101, " . $outTypeTitle;
    }

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 100;
    }

    public function getStatus(Player $player): string
    {
        return 'losing hard';
    }
}
