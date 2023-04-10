<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $hash
 * @property string $game_type;
 * @property string $exit_type;
 * */
class Game extends Model
{
    protected $table = 'game';

    /**
     * @return BelongsToMany<Player>
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }
}
