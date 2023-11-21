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
    /**
     * @var PlayerService
     */
    protected PlayerService $playerService;


    /**
     * @param PlayerService $playerService
     * @param GameService $gameService
     */
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

    /*
     * @param string $gameType
     * @param string $outType
     * @param array<int, Player> $players
     * @return Game
     * @throws \Exception
     */
    /**
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

    /**
     * @param Game $game
     * @return Game
     */
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

    /**
     * Add current score to all players of a game.
     *
     * @param Game $game
     * @return Collection<int, Player>
     * @throws \Exception
     */
    public function addCurrentScoreToPlayers(Game $game): Collection
    {
        $playerService = new PlayerService();

        $players = $game->players;

        foreach ($players as $player) {
            /** @var Player $player */
            $player->currentScore = $playerService->calculateCurrentScore($player, $game);
        }

        return $players;
    }
    /**
     * @param Game $game
     * @return Collection
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
}

