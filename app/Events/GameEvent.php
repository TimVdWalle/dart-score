<?php

namespace App\Events;

use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class GameEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    protected string $hash;
    public GameResource $gameResource;      // the game object in the correct json format to send to frontend
    public string $clientId;      // the game object in the correct json format to send to frontend
    public ?array $data;

    /**
     * Create a new event instance.
     */
    public function __construct(Game $game, string $clientId, ?array $data = null)
    {
        $this->hash = $game->hash;
        $this->gameResource = new GameResource($game);
        $this->clientId = $clientId;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("channel-name-{$this->hash}"),
        ];
    }
}
