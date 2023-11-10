<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{

    protected $fillable = ['game_id', 'player_id', 'score'];

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
    }}
