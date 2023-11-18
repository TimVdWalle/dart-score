<?php
namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            // Define your default values for Player model
            'name' => $this->faker->name,
            // Add other necessary fields
        ];
    }
}
