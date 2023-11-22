<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Score;
use App\Models\Set;
use Exception;
use Illuminate\Support\Collection;

abstract class AbstractGameType implements GameTypeInterface
{
    protected ?OutTypeStrategyInterface $outTypeStrategy;

    public function __construct(?OutTypeStrategyInterface $outTypeStrategy)
    {
        $this->outTypeStrategy = $outTypeStrategy;
    }

    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection
    {
        $initialScore = $this->getInitialScore();

        return GameTypeFactory::mapPlayers($players, $initialScore);
    }

    public function getTitle(): string
    {
        if (!$this->outTypeStrategy) {
            return '501';
        }

        $outTypeTitle = $this->outTypeStrategy->getTitle();

        return '501, '.$outTypeTitle;
    }

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        $initialScore = $this->getInitialScore();

        //        $score = Score::query()
        //            ->where('gameId', '=', )
    }

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
