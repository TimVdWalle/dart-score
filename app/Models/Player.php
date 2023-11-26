<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property int $currentScore
 * @property ?int $avgScore
 * @property bool $isCurrentTurn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Game> $games
 * @property-read int|null $games_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Score> $scores
 * @property-read int|null $scores_count
 *
 * @method static \Database\Factories\PlayerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    /**
     * @return HasMany<Game>
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    /**
     * @return HasMany<Score>
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    // Method to set the current turn
    public function setCurrentTurn(bool $value): void
    {
        $this->isCurrentTurn = $value;
    }

    // Method to check if it's the player's turn
    public function isCurrentTurn(): bool
    {
        return $this->isCurrentTurn;
    }

    /**
     * Get the current score of the player for a specific game, set, and leg.
     */
    public function getCurrentScoreForContext(int $gameId, int $setId, int $legId): int
    {
        // Adjust this query based on your database structure and scoring logic
        $score = $this->scores()
            ->where('game_id', '=', $gameId)
            ->whereHas('leg', function ($query) use ($setId, $legId) {
                $query->where('set_id', $setId)->where('id', $legId);
            })
            ->sum('score');

        return is_numeric($score) ? intval($score) : 0;
    }
}
