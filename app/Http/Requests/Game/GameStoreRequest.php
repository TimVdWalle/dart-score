<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameStoreRequest extends FormRequest
{

    /**
     * @return array<string, array<int, \Illuminate\Validation\Rules\In|string>>
     */
    public function rules()
    {
        return [
            'hash' => ['required', 'string'],
            'gameType' => ['required', 'string', Rule::in(['501', '301', '101', 'cricket'])],
            'outType' => ['required', 'string', Rule::in(['double_exact', 'exact', 'any'])],
//            'players' => ['required', 'min:1', 'max:6'],
            'players.*.name' => ['required', 'string'],
        ];
    }
}
