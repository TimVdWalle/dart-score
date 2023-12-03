<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Http\Exceptions\GameException;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;
use Illuminate\Support\Collection;

class GameplayService
{
    /**
     * @return Collection<int, Player>
     *
     * @throws \Exception
     */
    public function addScoreDataToPlayer(Game $game): Collection
    {
        $gameTypeObject = GameTypeFactory::create($game);

        return $game->players->map(function ($player) use ($game, $gameTypeObject) {
            /** @var Player $player */
            $player->currentScore = $gameTypeObject->calculateCurrentScore($player, $game);
            $player->avgScore = $gameTypeObject->calculateAvgScore($player, $game);

            return $player;
        });
    }

    /**
     * @return ?Player
     */
    public function determineCurrentTurn(Game $game)
    {
        // Assuming each game has players associated with it
        $players = $game->players;
        $currentSet = $game->currentSet;

        if (!$currentSet) {
            // Handle the case where no current set is found
            // Option 1: Return null or a default value
            // return null; // or any default value you deem appropriate

            // Option 2: Throw an exception
            throw new \Exception('Current set not found for the game.');
        }

        $currentLeg = $game->currentLeg;

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

    public function checkForLegWinner(Game $game, int $playerId): ?Player
    {
        $player = Player::findOrFail($playerId);
        $gameTypeObject = GameTypeFactory::create($game);
        return $gameTypeObject->checkForLegWinner($game, $player);
    }

    /**
     * @throws GameException
     */
    public function endLeg(Game $game, Player $winner): void
    {
        // Update the leg with the winner's information
        $currentLeg = $game->currentLeg;

        if(!$currentLeg){
            throw new GameException("Not currently in leg");
        }

        $currentLeg->winner_id = $winner->id;
        $currentLeg->save();
    }
}
