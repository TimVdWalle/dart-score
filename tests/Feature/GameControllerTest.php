<?php

use App\Models\Game;
use App\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    // Mock the GameService to control the hash generation
    $this->gameServiceMock = Mockery::mock(GameService::class);
    $this->app->instance(GameService::class, $this->gameServiceMock);
});


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
//            ->has('gameHash')
            ->has('csrf')
        );
});

it('fails to store game with invalid data', function () {
    $response = $this->post(route('game.store'), []);

    $response->assertSessionHasErrors(['gameType', 'outType', 'players']);
});

it('successfully stores a new game and redirects', function () {
    $mockedHash = 'testhash'; // Mocked hash value

    $this->gameServiceMock
        ->shouldReceive('getNextHash')
        ->once()
        ->andReturn($mockedHash);

    // Mock the createGame method to return a Game instance
    $this->gameServiceMock
        ->shouldReceive('createGame')
        ->once()
        ->andReturnUsing(function ($hash, $gameType, $outType, $players) {
            $game = new Game();
            $game->hash = $hash;
            $game->game_type = $gameType;
            $game->out_type = $outType;
            $game->save();

            // Additional logic to add players to the game if needed

            return $game;
        });

    $gameData = [
        'gameType' => '501',
        'outType' => 'double_exact',
        'players' => ['Player 1', 'Player 2'],
    ];

    $response = $this->post(route('game.store'), $gameData);

    $response->assertRedirect(route('game.show', ['gameHash' => $mockedHash]));
});

it('stores new game successfully', function () {
    $mockedHash = '123456'; // Mocked hash value

    $this->gameServiceMock
        ->shouldReceive('getNextHash')
        ->once()
        ->andReturn($mockedHash);

    // Assuming createGame method does some processing and then saves the game
    $this->gameServiceMock
        ->shouldReceive('createGame')
        ->once()
        ->andReturnUsing(function ($hash, $gameType, $outType, $players) {
            $game = new Game();
            $game->hash = $hash;
            $game->game_type = $gameType;
            $game->out_type = $outType;
            $game->save();

            return $game;
        });

    $gameData = [
        'gameType' => '501',
        'outType' => 'double_exact',
        'players' => ['Player 1', 'Player 2'],
    ];

    $response = $this->post(route('game.store'), $gameData);

    // Since we're mocking, we assert that the redirect happens as expected
    // The actual creation of the game in the database is not performed by the mock
    $response->assertRedirect(route('game.show', ['gameHash' => $mockedHash]));

    // Additional assertions can be added here if needed
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
