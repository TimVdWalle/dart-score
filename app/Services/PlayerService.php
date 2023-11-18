<?php

namespace App\Services;

use App\Contracts\GameTypeInterface;
use App\Factories\GameTypeFactory;
use App\Models\Game\Game;
use App\Models\Game\Player;
use Illuminate\Support\Collection;

class PlayerService
{
    /**
     * @param array<int, array{id: int, name: string}> $players $players
     * @return Collection<int, Player>
     */
    public function storePlayers(array $players)
    {
        $results = collect();

        foreach ($players as $player) {
            $record = new Player();
            $record->name = $player['name'];
            $record->save();
            $results->push($record);
        }

        return $results;
    }

    /**
     * @param Player $player
     * @param Game $game
     * @return int
     * @throws \Exception
     */
    public function calculateCurrentScore(Player $player, Game $game): int
    {
        $gameTypeObject = GameTypeFactory::create($game);
        return $gameTypeObject->calculateCurrentScore($player, $game);
    }
}

