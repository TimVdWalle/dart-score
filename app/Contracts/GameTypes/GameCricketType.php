<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;
use Exception;
use Illuminate\Support\Collection;

class GameCricketType implements GameTypeInterface
{
    public function __construct()
    {
        // Constructor logic specific to GameCricketType (if any)
    }

    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection
    {
        return $players;
    }

    public function getTitle(): string
    {
        return 'Cricket';
    }

    public function calculateCurrentScore(Player $player, Game $game): int
    {
        return 15;
    }

    public function calculateAvgScore(Player $player, Game $game): ?int
    {
        return null;
    }

    /**
     * @throws Exception
     */
    public function validateScore(Game $game, Set $currentSet, Leg $currentLeg,  Player $player, int $score, bool $withDouble = false): true
    {
        // TODO
        return true;
    }

    public function getStatus(Player $player): string
    {
        return 'winning barely';
    }

    public function getInitialScore(): int
    {
        return 0;
    }
}
