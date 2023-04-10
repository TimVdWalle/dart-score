<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

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

//    /**
//     * @param $gameData
//     * @return int
//     */
//    public function createGame($gameData)
//    {
//        // Insert game data into the database
//        $gameId = DB::table('games')->insertGetId($gameData);
//
//        // Return the ID of the newly created game
//        return $gameId;
//    }
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

