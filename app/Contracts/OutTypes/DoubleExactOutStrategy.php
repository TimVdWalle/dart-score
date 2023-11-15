<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class DoubleExactOutStrategy implements OutTypeStrategyInterface {
    /**
     * @param int $currentScore
     * @param int $hitScore
     * @return bool
     */
    public function isValidOut(int $currentScore, int $hitScore): bool {
        // In DoubleExactOutStrategy, the last hit must make the score exactly zero
        // and it must be a double.
        // Assuming a method `isDoubleHit` determines if the hit was a double.
        return ($currentScore - $hitScore === 0) && $this->isDoubleHit($hitScore);
    }

    /**
     * @param int $hitScore
     * @return bool
     */
    private function isDoubleHit(int $hitScore): bool {
        // Implement logic to check if the hit was a double
        // For example, if hitScore is exactly twice of some segment score.

        return true;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return "Double Out";
    }
}
