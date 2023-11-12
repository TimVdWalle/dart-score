<?php

namespace App\Contracts;

interface OutTypeStrategyInterface {
    /**
     * Determines if the current hit is a valid out based on the out type's rules.
     *
     * @param int $currentScore The current score of the player.
     * @param int $hitScore The score of the current hit.
     * @return bool
     */
    public function isValidOut(int $currentScore, int $hitScore): bool;
}
