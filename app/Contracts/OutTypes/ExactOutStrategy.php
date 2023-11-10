<?php

namespace App\Contracts\OutTypes;

use App\Contracts\OutTypeStrategyInterface;

class ExactOutStrategy implements OutTypeStrategyInterface {
    public function isValidOut(int $currentScore, int $hitScore): bool {
        // In ExactOutStrategy, the last hit must make the score exactly zero
        // but does not need to be a double.
        return $currentScore - $hitScore === 0;
    }
}
