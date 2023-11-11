<?php

namespace App\Http\Resources;

use App\Models\Game\Player;
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'scores' => ScoreResource::collection($this->whenLoaded('scores')),
            // Include other player attributes or relationships as needed
        ];
    }
}
