<?php
namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Score;
use App\Models\Set;
use Exception;

abstract class AbstractGameType implements GameTypeInterface {
    /**
     * @var OutTypeStrategyInterface|null
     */
    protected ?OutTypeStrategyInterface $outTypeStrategy;

    /**
     * @param OutTypeStrategyInterface|null $outTypeStrategy
     */
    public function __construct(?OutTypeStrategyInterface $outTypeStrategy) {
        $this->outTypeStrategy = $outTypeStrategy;
    }

    /**
     * @param Player $player
     * @param Game $game
     * @return int|null
     */
    public function calculateAvgScore(Player $player, Game $game): ?int
    {
        return null;
    }

    /**
     * @throws Exception
     */
    public function validateScore(Game $game, Player $player, int $score, Set $currentSet, Leg $currentLeg): true
    {
        // TODO
        return true;
    }

    public function checkWinner(): void
    {
//        // Determine the winner for GameType501
//        // This is an example and needs to be adjusted based on your game logic
//        foreach ($this->game->players as $player) {
//            if ($player->currentScore === 0) {
//                return $player; // Winner found
//            }
//        }
//
//        return null; // No winner yet
    }

//    public function initializeScoresForPlayers(Collection $players, ?int $initialScore): Collection {
//        return GameTypeFactory::mapPlayers($players, $initialScore);
//    }

    // Additional common methods can be defined here
}

