<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;
use Illuminate\Support\Collection;

interface GameTypeInterface
{
    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection;

    public function getTitle(): string;

    public function calculateCurrentScore(Player $player, Game $game): int;

    public function getInitialScore(): int;

    public function getMaxThrow(): int;

    public function getMinThrow(): int;

    public function calculateAvgScore(Player $player, Game $game): ?int;

    public function checkForLegWinner(Game $game, Player $player): ?Player;

    public function getStatus(Player $player): string;

    public function validateScore(Game $game, Set $currentSet, Leg $currentLeg, Player $player, int $score, bool $withDouble): bool;
}
