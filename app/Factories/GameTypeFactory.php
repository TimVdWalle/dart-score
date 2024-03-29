<?php

namespace App\Factories;

use App\Contracts\GameTypeInterface;
use App\Contracts\GameTypes\X01Game101Type;
use App\Contracts\GameTypes\X01Game301Type;
use App\Contracts\GameTypes\X01Game501Type;
use App\Contracts\GameTypes\GameCricketType;
use App\Contracts\OutTypes\AnyOutStrategy;
use App\Contracts\OutTypes\DoubleExactOutStrategy;
use App\Contracts\OutTypes\ExactOutStrategy;
use App\Enums\GameType;
use App\Enums\OutType;
use App\Models\Game;
use App\Models\Player;
use Exception;
use Illuminate\Support\Collection;

class GameTypeFactory
{
    /**
     * @throws Exception
     */
    public static function create(Game $game): GameTypeInterface
    {
        return match ($game->game_type) {
            GameType::Game501->value => new X01Game501Type(self::createOutTypeStrategy($game->out_type)),
            GameType::Game301->value => new X01Game301Type(self::createOutTypeStrategy($game->out_type)),
            GameType::Game101->value => new X01Game101Type(self::createOutTypeStrategy($game->out_type)),
            GameType::Cricket->value => new GameCricketType(),

            default => throw new Exception("Unsupported game type: {$game->game_type}"),
        };
    }

    /**
     * Initializes the scores for each player.
     *
     * @param  Collection<int|string, mixed>  $players
     * @return Collection<int|string, Player>
     */
    public static function mapPlayers_old(Collection $players, int $initialScore)
    {
        $players = $players->map(function ($player) use ($initialScore) {
            /** @var Player $player */
            $player->currentScore = $initialScore;

            return $player;
        });

        return $players;
    }

    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public static function mapPlayers(Collection $players, int $initialScore): Collection
    {
        $players = $players->map(function ($player) use ($initialScore) {
            /** @var Player $player */
            $player->currentScore = $initialScore;

            return $player;
        });

        return $players;
    }

    /**
     * @return AnyOutStrategy|DoubleExactOutStrategy|ExactOutStrategy
     *
     * @throws Exception
     */
    private static function createOutTypeStrategy(?string $outType)
    {
        return match ($outType) {
            OutType::DoubleExact->value => new DoubleExactOutStrategy(),
            OutType::Exact->value => new ExactOutStrategy(),
            OutType::Any->value => new AnyOutStrategy(),
            default => throw new Exception("Unsupported out type: {$outType}"),
        };
    }
}
