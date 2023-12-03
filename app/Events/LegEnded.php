<?php

namespace App\Events;

class LegEnded extends GameEvent
{
    public function broadcastAs(): string
    {
        return 'LegEnded';
    }
}
