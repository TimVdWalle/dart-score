<?php

namespace App\Services;

use App\Factories\GameTypeFactory;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Set;
use Illuminate\Support\Collection;

class GameService
{
    protected PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * @return string
     */
    public function getNextHash()
    {
        // Read hash length from configuration, with a fallback default
        /** @var int $hashLength */
        $hashLength = config('game.default_hash_length', 4);
        $hashLength = intval($hashLength);

        // Ensure hash length is within a reasonable range
        $hashLength = max(1, min($hashLength, 15)); // Example range: 1 to 15

        $gameHash = rand(0, 9999999);
        $bignum = hexdec(substr(sha1(strval($gameHash)), 0, 15));
        $smallnum = $bignum % pow(10, $hashLength); // Use $hashLength in calculation

        // Convert $smallnum to string and pad with zeros if necessary
        return str_pad(strval($smallnum), $hashLength, '0', STR_PAD_LEFT);
    }

    /**
     * @param  string[]  $players
     *
     * @throws \Exception
     */
    public function createGame(string $gameType, string $outType, array $players): Game
    {
        $game = new Game();
        $game->hash = strval($this->getNextHash());
        $game->game_type = $gameType;
        $game->out_type = $outType;

        $game->save();

        $gameTypeObject = GameTypeFactory::create($game);
        $players = $this->playerService->storePlayers($players);
        $game = $this->initGame($game);
        $playersWithScores = $gameTypeObject->initializeScores(players: $players);
        $game->players()->attach($playersWithScores->pluck('id'));

        return $game;
    }

    private function initGame(Game $game): Game
    {
        // Create the first set
        $set = new Set();
        $set->game_id = $game->id;
        $set->set_number = 1;
        $set->save();

        // Create the first leg for the first set
        $leg = new Leg();
        $leg->set_id = $set->id;
        $leg->leg_number = 1;
        $leg->turn = 0; // Initialize turn counter
        $leg->save();

        return $game;
    }

    //    /**
    //     * @param Game $game
    //     * @return Collection<int, Player>
    //     * @throws \Exception
    //     */
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

}
