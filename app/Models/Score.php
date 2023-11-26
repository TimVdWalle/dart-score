<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Score
 *
 * @property int $id
 * @property int $game_id
 * @property int $player_id
 * @property int $set_id
 * @property int $leg_id
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\Leg $leg
 * @property-read \App\Models\Player $player
 * @property-read \App\Models\Set $set
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Score newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score query()
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereLegId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Score extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'player_id', 'set_id', 'leg_id', 'score'];

    /**
     * @return BelongsTo<Game, Score>
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return BelongsTo<Player, Score>
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo<Set, Score>
     */
    public function set(): BelongsTo
    {
        return $this->belongsTo(Set::class);
    }

    /**
     * @return BelongsTo<Leg, Score>
     */
    public function leg(): BelongsTo
    {
        return $this->belongsTo(Leg::class);
    }
}
