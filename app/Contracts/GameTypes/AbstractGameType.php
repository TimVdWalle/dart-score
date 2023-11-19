<?php
namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Models\Game;
use App\Models\Player;

abstract class AbstractGameType implements GameTypeInterface {
    protected ?OutTypeStrategyInterface $outTypeStrategy;

    public function __construct(?OutTypeStrategyInterface $outTypeStrategy) {
        $this->outTypeStrategy = $outTypeStrategy;
    }

    public function calculateAvgScore(Player $player, Game $game): ?int
    {
        return null;
    }

//    public function initializeScoresForPlayers(Collection $players, ?int $initialScore): Collection {
//        return GameTypeFactory::mapPlayers($players, $initialScore);
//    }

    // Additional common methods can be defined here
}

