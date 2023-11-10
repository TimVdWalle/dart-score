<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Models\Game\Game;
use Illuminate\Support\Collection;

class GameService
{
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
     * @param array<int, array{id: int, name: string}> $players
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

        $players = (new PlayerService())->storePlayers($players);

        $gameTypeObject = GameTypeFactory::create($game);
        $playersWithScores = $gameTypeObject->initializeScores(players: $players, game: $game);
        $game->players()->attach($playersWithScores->pluck('id'));

        return $game;
    }
//
//    /**
//     * @param $gameId
//     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
//     */
//    public function getGame($gameId)
//    {
//        // Retrieve the game data from the database
//        $gameData = DB::table('games')->where('id', $gameId)->first();
//
//        // Return the game data as an object
//        return $gameData;
//    }

    // Add any other methods you need for your game here
}

