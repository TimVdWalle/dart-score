<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        return [
            // Define your default values for Game model
            'hash' => $this->faker->unique()->bothify('????##'),
            'game_type' => '501', // Example value
            'out_type' => 'double_exact', // Example value
            // Add other necessary fields
        ];
    }
}
