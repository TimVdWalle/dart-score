<?php

namespace App\Http\Resources;

use App\Models\Game\Score;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Score
 */
class ScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'playerId' => $this->player_id,
            'gameId' => $this->game_id,
            'score' => $this->score,
            // Add other relevant score fields
        ];
    }
}

