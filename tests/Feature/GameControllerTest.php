<?php

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('initializes game correctly', function () {
    $response = $this->get(route('game.init'));
    $response->assertStatus(200);
    $response->assertInertia(fn ($assert) => $assert->component('Game/Init'));
});

it('initializes game with correct view and data', function () {
    $response = $this->get(route('game.init'));

    $response->assertStatus(200)
        ->assertInertia(fn ($assert) => $assert
            ->component('Game/Init')
            ->has('gameHash')
            ->has('csrf')
        );
});

it('fails to store game with invalid data', function () {
    $response = $this->post(route('game.store'), []);

    $response->assertSessionHasErrors(['hash', 'gameType', 'outType', 'players']);
});

it('successfully stores a new game and redirects', function () {
    $gameData = [
        'hash' => 'testhash',
        'gameType' => '501',  // Example game type
        'outType' => 'double_exact',  // Example out type
        'players' => [
            'Player 1',
            'Player 2'
        ],
    ];

    $response = $this->post(route('game.store'), $gameData);

    $response->assertRedirect(route('game.show', ['gameHash' => 'testhash']));
});

it('stores new game successfully', function () {
    // Mock data similar to what your form would send
    $gameData = [
        'hash' => '123456',  // Example hash value
        'gameType' => '501', // Assuming '501' is a valid game type
        'outType' => 'double_exact', // Assuming this is a valid out type
        'players' => [
            'Player 1',
            'Player 2'
        ],
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

//it('displays the correct game data', function () {
//    $game = Game::factory()->create(['hash' => 'testhash']);
//
//    $response = $this->get(route('game.show', ['gameHash' => 'testhash']));
//
//    $response->assertStatus(200)
//        ->assertInertia(fn ($assert) => $assert
//            ->component('Game/Show')
//            ->has('game', fn ($assert) => $assert->where('hash', 'testhash')->etc())
//        );
//});

it('redirects if the game does not exist', function () {
    $response = $this->get(route('game.show', ['gameHash' => 'nonexistent']));

    $response->assertRedirect(route('game.init'));
});

//it('fails to store game with invalid data2', function () {
//    $response = $this->post(route('game.store'), []);
//
//    // Temporarily add this line for debugging
//    dd(session('errors')->getMessages());
//
//    $response->assertSessionHasErrors(['hash', 'gameType', 'outType', 'players']);
//});