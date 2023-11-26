<?php

namespace App\Contracts\GameTypes;

use App\Enums\GameType;
use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

class X01Game301Type extends AbstractX01GameType
{
    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection
    {
        $initialScore = GameType::Game301->getStartingScore();

        return GameTypeFactory::mapPlayers($players, $initialScore);
    }

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 300;
    }

    public function getStatus(Player $player): string
    {
        return 'losing';
    }

    public function getInitialScore(): int
    {
        return GameType::Game301->getStartingScore();
    }
}
