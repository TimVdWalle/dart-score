<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

class PlayerService
{
    /**
     * @param  string[]  $players
     * @return Collection<int, Player>
     */
    public function storePlayers(array $players)
    {
        $results = collect();

        foreach ($players as $player) {
            $record = new Player();
            $record->name = ucfirst($player);
            $record->save();
            $results->push($record);
        }

        return $results;
    }

    /**
     * @throws \Exception
     */
    public function calculateCurrentScore(Player $player, Game $game): int
    {
        $gameTypeObject = GameTypeFactory::create($game);

        return $gameTypeObject->calculateCurrentScore($player, $game);
    }
}
