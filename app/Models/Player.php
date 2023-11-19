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
 *
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
}
