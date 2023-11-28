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
     * @param  int  $hitScore The score of the current hit.
     */
    public function isValidOut(int $currentScore, int $hitScore): bool;

    public function validateScore(int $currentScore, int $hitScore, bool $withDouble): bool;

    public function getTitle(): string;
}
