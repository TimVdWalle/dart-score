<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;

class GameplayService
{
    /**
     * @param Game $game
     * @return ?Player
     */
    public function determineCurrentTurn(Game $game)
    {
        // Assuming each game has players associated with it
        $players = $game->players;
        $currentSet = $game->sets()->latest()->first();
        $currentLeg = $currentSet->legs()->latest()->first();

        // Determine the current turn based on the number of turns already taken
        // This assumes that each player plays in turn and once all players have played, the cycle repeats
        $turnsTaken = $currentLeg->turn;
        $totalPlayers = count($players);
        $currentPlayerIndex = $turnsTaken % $totalPlayers;

        return $players[$currentPlayerIndex];
    }

    // Other methods related to gameplay
}
