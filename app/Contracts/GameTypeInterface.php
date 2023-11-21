<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

interface GameTypeInterface {

    /**
     * @param Collection<int, Player> $players
     * @param Game $game
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
}
