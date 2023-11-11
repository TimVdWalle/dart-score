<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $hash
 * @property string $gameType  // CamelCase to match Laravel's accessor convention
 * @property string $outType   // CamelCase to match Laravel's accessor convention
 */
class Game extends Model
{
    protected $table = 'games';

    /**
     * @return BelongsToMany<Player>
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }
}
