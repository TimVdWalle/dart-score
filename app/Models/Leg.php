<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
