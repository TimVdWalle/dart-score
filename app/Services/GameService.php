<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Collection;

class GameService
{
    protected PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }
    /**
     * @return int
     */
    public function getNextHash()
    {
        $gameHash = rand(0, 9999999);

        $bignum = hexdec(substr(sha1(strval($gameHash)), 0, 15));
        $smallnum = $bignum % 9999;

        // TODO: check if hash already exists for other game

        return $smallnum;
    }

    /**
     * @param string $hash
     * @param string $gameType
     * @param string $outType
     * @param string[] $players
     * @return Game
     * @throws \Exception
     */
    public function createGame(string $hash, string $gameType, string $outType, array $players): Game
    {
        $game = new Game();
        $game->hash = $hash;
        $game->game_type = $gameType;
        $game->out_type = $outType;

        $game->save();

        $players = $this->playerService->storePlayers($players);

        $gameTypeObject = GameTypeFactory::create($game);
        $playersWithScores = $gameTypeObject->initializeScores(players: $players, game: $game);
        $game->players()->attach($playersWithScores->pluck('id'));

        return $game;
    }

    /**
     * Add current score to all players of a game.
     *
     * @param Game $game
     * @return Collection<int, Player>
     * @throws \Exception
     */
//    public function addCurrentScoreToPlayers(Game $game): Collection
//    {
//        $playerService = new PlayerService();
//
//        $players = $game->players;
//
//        foreach ($players as $player) {
//            /** @var Player $player */
//            $player->currentScore = $playerService->calculateCurrentScore($player, $game);
//        }
//
//        return $players;
//    }
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
}

