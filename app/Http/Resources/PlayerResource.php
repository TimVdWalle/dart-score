<?php

namespace App\Http\Resources;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Player
 */
class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        $game = $this->resource;
//        $gameTypeObject = GameTypeFactory::create($this->games());
//        $gameTypeObject = GameTypeFactory::create($this->whenLoaded('game')->gameType ?? 'default_game_type');

        return [
            'id' => $this->id,
            'name' => '$this->name',
            'currentScore' => $this->currentScore,
            'scores' => ScoreResource::collection($this->whenLoaded('scores')),
            // Include other player attributes or relationships as needed
        ];
    }
}
