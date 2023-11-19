<?php

namespace App\Factories;

use App\Contracts\GameTypeInterface;
use App\Contracts\GameTypes\Game101Type;
use App\Contracts\GameTypes\Game301Type;
use App\Contracts\GameTypes\Game501Type;
use App\Contracts\GameTypes\GameCricketType;
use App\Contracts\OutTypes\AnyOutStrategy;
use App\Contracts\OutTypes\DoubleExactOutStrategy;
use App\Contracts\OutTypes\ExactOutStrategy;
use App\Enums\GameType;
use App\Enums\OutType;
use App\Models\Game;
use App\Models\Player;
use App\Services\ScoreService;
use Exception;
use Illuminate\Support\Collection;

class GameTypeFactory {
    /**
     * @throws Exception
     */
    public static function create(Game $game): GameTypeInterface
    {
        $outTypeStrategy = self::createOutTypeStrategy($game->out_type);

        return match ($game->game_type) {
            GameType::Game501->value => new Game501Type($outTypeStrategy),
            GameType::Game301->value => new Game301Type($outTypeStrategy),
            GameType::Game101->value => new Game101Type($outTypeStrategy),
            GameType::Cricket->value => new GameCricketType(),

            default => throw new Exception("Unsupported game type: {$game->game_type}"),
        };
    }

    /**
     * Initializes the scores for each player.
     *
     * @param Collection<int|string, mixed> $players
     * @return Collection<int|string, Player>
     */
    public static function mapPlayers_old(Collection $players, int $initialScore)
    {
        $players = $players->map(function($player) use ($initialScore) {
            /** @var Player $player */
            $player->currentScore =  $initialScore;
            return $player;
        });

        return $players;
    }

    /**
     * @param Collection<int, Player> $players
     * @param Game $game
     * @param int $initialScore
     * @return Collection<int, Player>
     */
    public static function mapPlayers(Collection $players, Game $game, int $initialScore): Collection
    {
        $scoreService = new ScoreService();

        $players = $players->map(function($player) use ($game, $initialScore, $scoreService) {
            /** @var Player $player */
            // Initialize the score for this player
            $scoreService->save($game, $player, $initialScore);
            return $player;
        });

        return $players;
    }

    /**
     * @param string $outType
     * @return AnyOutStrategy|DoubleExactOutStrategy|ExactOutStrategy|null
     * @throws Exception
     */
    private static function createOutTypeStrategy(?string $outType)
    {
        if ($outType === null) {
            return null;
        }

        return match ($outType) {
            OutType::DoubleExact->value => new DoubleExactOutStrategy(),
            OutType::Exact->value => new ExactOutStrategy(),
            OutType::Any->value => new AnyOutStrategy(),
            default => throw new Exception("Unsupported out type: {$outType}"),
        };
    }
}
