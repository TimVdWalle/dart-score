<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class ScoreStoreRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'score' => ['required', 'integer', 'min:0'], // Assuming score is an integer
            'player_id' => ['required', 'exists:players,id'], // Assuming player_id should exist in the players table
            'client_id' => ['required', 'string'],
            'with_double' => ['sometimes', 'bool'],
        ];
    }
}
