<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Player;

interface OutTypeStrategyInterface
{
    /**
     * Determines if the current hit is a valid out based on the out type's rules.
     *
     * @param  int  $currentScore The current score of the player.
     * @param  bool  $withDouble Whether the last throw was with a double.
     */
    public function isValidOut(int $currentScore, bool $withDouble = null): bool;

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool;

    public function getTitle(): string;
}
