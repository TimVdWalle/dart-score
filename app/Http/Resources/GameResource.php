<?php

namespace App\Http\Resources;

use App\Models\Game\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Game
 */
class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hash' => $this->hash,
            'gameType' => $this->gameType,
            'outType' => $this->outType,
            'players' => PlayerResource::collection($this->players),
            // Add other fields as needed
        ];
    }
}
