<?php

namespace App\Factories;

use App\Contracts\GameTypeInterface;
use App\Enums\GameType;
use App\GameTypes\Game101Type;
use App\GameTypes\Game301Type;
use App\GameTypes\Game501Type;
use App\GameTypes\GameCricketType;
use App\Models\Game\Player;
use Exception;
use Illuminate\Support\Collection;

class GameTypeFactory {
    /**
     * @throws Exception
     */
    public static function create(string $gameType): GameTypeInterface
    {
        return match ($gameType) {
            GameType::Game501->value => new Game501Type(),
            GameType::Game301->value => new Game301Type(),
            GameType::Game101->value => new Game101Type(),
            GameType::Cricket->value => new GameCricketType(),

            default => throw new Exception("Unsupported game type: {$gameType}"),
        };
    }

    /**
     * Initializes the scores for each player.
     *
     * @param Collection<int|string, mixed> $players
     * @return Collection<int|string, Player>
     */
    public static function mapPlayers(Collection $players, int $initialScore)
    {
        $players = $players->map(function($player) use ($initialScore) {
            /** @var Player $player */
           $player->currentScore =  $initialScore;
           return $player;
        });

        return $players;
    }
}
