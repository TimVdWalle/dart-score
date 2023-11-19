<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;


    protected $fillable = ['game_id', 'set_number'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Game, Set>
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Leg>
     */
    public function legs()
    {
        return $this->hasMany(Leg::class);
    }
}
