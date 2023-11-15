<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class ExactOutStrategy implements OutTypeStrategyInterface {
    /**
     * @param int $currentScore
     * @param int $hitScore
     * @return bool
     */
    public function isValidOut(int $currentScore, int $hitScore): bool {
        // In ExactOutStrategy, the last hit must make the score exactly zero
        // but does not need to be a double.
        return $currentScore - $hitScore === 0;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return "Out without double";
    }
}
