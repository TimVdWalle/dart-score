<?php
namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Factories\GameTypeFactory;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

abstract class AbstractGameType implements GameTypeInterface {
    protected $outTypeStrategy;

    public function __construct(OutTypeStrategyInterface $outTypeStrategy) {
        $this->outTypeStrategy = $outTypeStrategy;
    }

//    public function initializeScoresForPlayers(Collection $players, ?int $initialScore): Collection {
//        return GameTypeFactory::mapPlayers($players, $initialScore);
//    }

    // Additional common methods can be defined here
}

