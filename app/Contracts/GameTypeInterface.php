<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;
use Illuminate\Support\Collection;

interface GameTypeInterface {

    /**
     * @param Collection<int, Player> $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param Player $player
     * @return int
     */
    public function calculateCurrentScore(Player $player, Game $game): int;

    public function getInitialScore():int;

    /**
     * @param Player $player
     * @return int
     */
    public function calculateAvgScore(Player $player, Game $game): ?int;

    /**
     * @param Player $player
     * @return string
     */
    public function getStatus(Player $player): string;

    public function validateScore(Game $game, Player $player, int $score, Set $currentSet, Leg $currentLeg): bool;
}
