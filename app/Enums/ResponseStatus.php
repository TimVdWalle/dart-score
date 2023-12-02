<?php

namespace App\Enums;

enum ResponseStatus: string
{
    case leg_ended = 'leg_ended';
    case set_ended = 'set_ended';
    case game_ended = 'game_ended';
    case valid_score = 'valid_score';
    case invalid_score = 'invalid_score';

}
