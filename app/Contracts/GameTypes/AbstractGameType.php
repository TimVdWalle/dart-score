<?php
namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use Exception;

abstract class AbstractGameType implements GameTypeInterface {
    /**
     * @var OutTypeStrategyInterface|null
     */
    protected ?OutTypeStrategyInterface $outTypeStrategy;

    /**
     * @param OutTypeStrategyInterface|null $outTypeStrategy
     */
    public function __construct(?OutTypeStrategyInterface $outTypeStrategy) {
        $this->outTypeStrategy = $outTypeStrategy;
    }

    /**
     * @param Player $player
     * @param Game $game
     * @return int|null
     */
    public function calculateAvgScore(Player $player, Game $game): ?int
    {
        return null;
    }

    /**
     * @throws Exception
     */
    public function processScore(int $playerId, int $score)
    {
        // Process the score for GameTypeX01

        /** @var Player $player */
        $player = Player::find($playerId);

        if(!$player){
            throw new Exception("no player");
        }
        $currentScore = $player->getCurrentScoreForContext($gameId, $setId, $legId);
        $newScore = $currentScore - $score;

        if ($newScore >= 0) {
            $player->currentScore = $newScore;
            $player->save();

            $newScoreRecord = new Score([
                'player_id' => $playerId,
                'game_id' => $this->game->id,
                'score' => $score,
            ]);
            $newScoreRecord->save();
        }

        // Additional logic if needed
    }

    /**
     * @return Player|null
     */
    public function checkWinner(): ?Player
    {
        // Determine the winner for GameType501
        // This is an example and needs to be adjusted based on your game logic
        foreach ($this->game->players as $player) {
            if ($player->currentScore === 0) {
                return $player; // Winner found
            }
        }

        return null; // No winner yet
    }

//    public function initializeScoresForPlayers(Collection $players, ?int $initialScore): Collection {
//        return GameTypeFactory::mapPlayers($players, $initialScore);
//    }

    // Additional common methods can be defined here
}

