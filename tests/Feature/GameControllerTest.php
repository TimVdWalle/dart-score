<?php

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('initializes game correctly', function () {
    $response = $this->get(route('game.init'));
    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert->component('Game/Init'));
});

it('stores new game successfully', function () {
    // Mock data similar to what your form would send
    $gameData = [
        'hash' => '123456',  // Example hash value
        'gameType' => '501', // Assuming '501' is a valid game type
        'outType' => 'double_exact', // Assuming this is a valid out type
        'players' => json_encode([
            ['name' => 'Player 1'],
            ['name' => 'Player 2'],
        ]),
    ];

    $response = $this->post(route('game.store'), $gameData);

    // Fetch the game based on the hash used in `$gameData`
    $game = Game::where('hash', $gameData['hash'])->first();

    // Assert redirection to the correct route with the right game hash
    $response->assertRedirect(route('game.show', ['gameHash' => $game->hash]));

    // Assert that a game was indeed created
    expect(Game::count())->toBe(1);

    // Additional assertions can be made here to verify the game data
});
