<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;

class GameplayService
{

    public function getCurrentSet(Game $game)
    {
        $currentSet = $game->sets()->latest()->first();

        if (!$currentSet) {
            // Create the first set if it doesn't exist
            $currentSet = new Set();
            $currentSet->game_id = $game->id;
            $currentSet->set_number = 1; // Assuming set number starts at 1
            $currentSet->save();
        }

        return $currentSet;
    }

    /**
     * Get the current leg for a given game.
     *
     * This assumes that the current leg is within the current set.
     *
     * @param Game $game
     * @return Leg|null
     */
    public function getCurrentLeg(Game $game): ?Leg
    {
        $currentSet = $this->getCurrentSet($game);
        $currentLeg = $currentSet->legs()->latest()->first();

        if (!$currentLeg) {
            // Create the first leg if it doesn't exist
            $currentLeg = new Leg();
            $currentLeg->set_id = $currentSet->id;
            $currentLeg->leg_number = 1; // Assuming leg number starts at 1
            $currentLeg->save();
        }

        return $currentLeg;
    }

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
