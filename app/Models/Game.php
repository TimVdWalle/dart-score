<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $hash
 * @property string $gameType  // CamelCase to match Laravel's accessor convention
 * @property string $outType   // CamelCase to match Laravel's accessor convention
 * @property ?Player $currentPlayer   // CamelCase to match Laravel's accessor convention
 * @property string $game_type
 * @property string $out_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Player> $players
 * @property-read int|null $players_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Set> $sets
 * @property-read ?Set $currentSet
 * @property-read ?Leg $currentLeg
 * @property-read int|null $sets_count
 *
 * @method static \Database\Factories\GameFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereGameType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereOutType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Game extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'games';
    //    protected $casts = [
    //        'created_at' => 'datetime', // Cast the 'created_at' attribute to datetime
    //];

    /**
     * @return BelongsToMany<Player>
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }

    /**
     * @return HasMany<Set>
     */
    public function sets(): HasMany
    {
        return $this->HasMany(Set::class);
    }

    // dynamic relations from subquery : https://reinink.ca/articles/dynamic-relationships-in-laravel-using-subqueries
    /**
     * @param Builder<Game> $query
     * @return void
     */
    public function scopeWithCurrentSetAndLeg(Builder $query)
    {
        $query->addSelect([
            'current_set_id' => Set::query()->select('id')
                ->whereColumn('game_id', 'games.id')
                ->latest('created_at')
                ->take(1),

            'current_leg_id' => Leg::query()->select('id')
                ->where('set_id', function ($query) {
                    $query->select('id')
                        ->from('sets')
                        ->whereColumn('game_id', 'games.id')
                        ->latest('created_at')
                        ->take(1);
                })
                ->latest('created_at')
                ->take(1),
        ])->withCasts(['created_at' => 'datetime']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Set>
     */
    public function currentSet()
    {
        return $this->hasOne(Set::class, 'id', 'current_set_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Leg>
     */
    public function currentLeg()
    {
        return $this->hasOne(Leg::class, 'id', 'current_leg_id');
    }

    //    public function getCurrentSetAttribute(): ?Set
    //    {
    //        $set =
    //        return $this->sets()->latest('id')->first();
    //    }
    //
    //    /**
    //     * Get the current leg of the game dynamically.
    //     *
    //     * @return Leg|null
    //     */
    //    public function getCurrentLegAttribute(): ?Leg
    //    {
    //        $currentSet = $this->currentSet;
    //        if (!$currentSet) {
    //            return null;
    //        }
    //
    //        return $currentSet->legs()->latest('id')->first();
    //    }
}
