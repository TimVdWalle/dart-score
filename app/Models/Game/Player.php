<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 *
 */
class Player extends Model
{
    protected $table = 'player';

    /**
     * @return HasMany<Game>
     */
    public function players(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
