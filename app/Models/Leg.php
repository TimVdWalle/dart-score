<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Leg
 *
 * @property int $id
 * @property int $set_id
 * @property int $leg_number
 * @property int $turn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Set $set
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Leg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leg query()
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereLegNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereTurn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leg whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Leg extends Model
{
    use HasFactory;

    protected $fillable = ['set_id', 'leg_number', 'turn'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Set, Leg>
     */
    public function set()
    {
        return $this->belongsTo(Set::class);
    }
}
