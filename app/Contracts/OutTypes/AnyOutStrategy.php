<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class AnyOutStrategy implements OutTypeStrategyInterface {
    /**
     * @param int $currentScore
     * @param int $hitScore
     * @return bool
     */
    public function isValidOut(int $currentScore, int $hitScore): bool {
        // In AnyOutStrategy, the player can finish with any score that reduces
        // the remaining points to zero or below.
        return $currentScore - $hitScore <= 0;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return "Simple out";
    }
}
