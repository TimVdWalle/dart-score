<?php

namespace App\Enums;

enum GameType: string
{
    case Game501 = '501';
    case Game301 = '301';
    case Game101 = '101';
    case Cricket = 'cricket';

    public function getStartingScore(): int
    {
        return match ($this) {
            self::Game501 => 501,
            self::Game301 => 301,
            self::Game101 => 101,
            self::Cricket => 0,
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Game501 => 'A standard game where players start with a score of 501 and aim to reach zero.',
            self::Game301 => 'A standard game where players start with a score of 301 and aim to reach zero.',
            self::Game101 => 'A standard game where players start with a score of 101 and aim to reach zero.',
            self::Cricket => 'A game focusing on hitting certain numbers on the board to score points or \'cricket\' the opponent.',
        };
    }
}
