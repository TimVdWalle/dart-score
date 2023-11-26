<?php

namespace App\Events;

use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Game $game;                     // the game object
    public GameResource $gameResource;      // the game object in the correct json format to send to frontend
    /**
     * Create a new event instance.
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
        $this->gameResource = new GameResource($game);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("channel-name-{$this->game->hash}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'GameUpdated';
    }
}
