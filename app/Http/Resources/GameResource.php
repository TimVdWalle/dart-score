<?php

namespace App\Http\Resources;

use App\Factories\GameTypeFactory;
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
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        /** @var Game $game */
        $game = $this->resource;
        $gameTypeObject = GameTypeFactory::create($game);

        return [
            'hash' => $this->hash,
            'gameType' => $this->gameType,
            'outType' => $this->outType,
            'players' => PlayerResource::collection($this->players),

            'title' => $gameTypeObject->getTitle()
        ];
    }
}
