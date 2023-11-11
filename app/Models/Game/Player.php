<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property int $currentScore
 *
 */
class Player extends Model
{
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
}
