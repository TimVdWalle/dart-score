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

        if (!$currentSet) {
            // Handle the case where no current set is found
            // Option 1: Return null or a default value
            // return null; // or any default value you deem appropriate

            // Option 2: Throw an exception
             throw new \Exception('Current set not found for the game.');
        }

        $currentLeg = $currentSet->legs()->latest()->first();

        if (!$currentLeg) {
            // Handle the case where no current leg is found
            // Option 1: Return null or a default value
            // return null; // or any default value you deem appropriate

            // Option 2: Throw an exception
             throw new \Exception('Current leg not found for the set.');
        }

        // Determine the current turn based on the number of turns already taken
        // This assumes that each player plays in turn and once all players have played, the cycle repeats
        $turnsTaken = $currentLeg->turn;
        $totalPlayers = count($players);
        $currentPlayerIndex = $turnsTaken % $totalPlayers;

        // Use map to update each player's isCurrentTurn status
        $game->players->map(function ($player, $index) use ($currentPlayerIndex) {
            $player->isCurrentTurn = ($index === $currentPlayerIndex);
            return $player;
        });

        $game->currentPlayer = $players[$currentPlayerIndex];

        return $game->currentPlayer;
    }
}
