<?php

namespace App\Http\Resources;

use App\Factories\GameTypeFactory;
use App\Models\Game;
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
     *
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        /** @var Game $game */
        $game = $this->resource;
        $gameTypeObject = GameTypeFactory::create($game);

        $t1 = $this->outType;
//        $t2 = $gameTypeObject->outType;

        $result =  [
            'hash' => $this->hash,
            'gameType' => $this->game_type,
            'outType' => $this->out_type,
            'players' => PlayerResource::collection($this->players),
            'currentPlayer' => new PlayerResource($this->currentPlayer),

            'title' => $gameTypeObject->getTitle(),
        ];

        return $result;
    }
}
