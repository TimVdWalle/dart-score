<?php

namespace App\Events;

class GameUpdated extends GameEvent
{
    public function broadcastAs(): string
    {
        return 'GameUpdated';
    }
}
