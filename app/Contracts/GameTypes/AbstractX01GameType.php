<?php

namespace App\Contracts\GameTypes;

use App\Contracts\GameTypeInterface;
use App\Contracts\OutTypeStrategyInterface;
use App\Factories\GameTypeFactory;
use App\Http\Exceptions\ScoreException;
use App\Models\Game;
use App\Models\Leg;
use App\Models\Player;
use App\Models\Score;
use App\Models\Set;
use Exception;
use Illuminate\Support\Collection;

abstract class AbstractX01GameType implements GameTypeInterface
{
    protected OutTypeStrategyInterface $outTypeStrategy;

    public function __construct(OutTypeStrategyInterface $outTypeStrategy)
    {
        $this->outTypeStrategy = $outTypeStrategy;
    }

    /**
     * @param  Collection<int, Player>  $players
     * @return Collection<int, Player>
     */
    public function initializeScores(Collection $players): Collection
    {
        $initialScore = $this->getInitialScore();

        return GameTypeFactory::mapPlayers($players, $initialScore);
    }

    public function getTitle(): string
    {
        $outTypeTitle = $this->outTypeStrategy->getTitle();

        return '501, '.$outTypeTitle;
    }

    public function checkForLegWinner(Game $game, Player $player): ?Player
    {
        $currentScore = $this->calculateCurrentScore($player, $game);
        if ($this->outTypeStrategy->isValidOut($currentScore)) {
            return $player; // This player is the winner
        }

        return null; // No winner yet
    }

    /**
     * @throws ScoreException
     */
    public function calculateCurrentScore(Player $player, Game $game): int
    {
        $initialScore = $this->getInitialScore();

        if(!$game->currentSet || !$game->currentLeg) {
            throw new ScoreException('Not in a game');
        }

        $score = Score::query()
            ->where('game_id', '=', $game->id)
            ->where('set_id', '=', $game->currentSet->id)
            ->where('leg_id', '=', $game->currentLeg->id)
            ->where('player_id', '=', $player->id)
            ->sum('score');

        return $initialScore - $score;
    }

    /**
     * @throws ScoreException
     */
    public function calculateAvgScore(Player $player, Game $game): ?int
    {
        if(!$game->currentSet || !$game->currentLeg) {
            throw new ScoreException('Not in a game');
        }

        /** @var int $totalScore */
        $totalScore = Score::query()
            ->where('game_id', '=', $game->id)
            ->where('set_id', '=', $game->currentSet->id)
            ->where('leg_id', '=', $game->currentLeg->id)
            ->where('player_id', $player->id)
            ->sum('score');

        /** @var int $throwsCount */
        $throwsCount = Score::query()
            ->where('game_id', '=', $game->id)
            ->where('set_id', '=', $game->currentSet->id)
            ->where('leg_id', '=', $game->currentLeg->id)
            ->where('player_id', $player->id)
            ->count();

        return $throwsCount > 0 ? intdiv($totalScore, $throwsCount) : null;
    }

    /**
     * @throws Exception
     */
    public function validateScore(Game $game, Set $currentSet, Leg $currentLeg, Player $player, int $score, bool $withDouble): bool
    {
        if ($score < $this->getMinThrow() || $score > $this->getMaxThrow()) {
            return false;
        }

        $currentScore = $this->calculateCurrentScore($player, $game);

        // Delegate to the OutTypeStrategy
        return $this->outTypeStrategy->validateScore($currentScore, $score, $withDouble);
    }

    public function checkWinner(): void
    {
        //        // Determine the winner for GameType501
        //        // This is an example and needs to be adjusted based on your game logic
        //        foreach ($this->game->players as $player) {
        //            if ($player->currentScore === 0) {
        //                return $player; // Winner found
        //            }
        //        }
        //
        //        return null; // No winner yet
    }

    //    public function initializeScoresForPlayers(Collection $players, ?int $initialScore): Collection {
    //        return GameTypeFactory::mapPlayers($players, $initialScore);
    //    }

    // Additional common methods can be defined here
}
