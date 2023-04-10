<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules()
    {
        return [
            'players' => 'required|array|min:1',
            'players.*.name' => 'required|string|max:255',
            'hash' => 'required|string|length:4',
            'gameType' => 'required|string|min:3',
            'exitType' => 'required|string|min:3',
        ];
    }
}
