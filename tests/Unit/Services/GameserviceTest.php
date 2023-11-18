<?php

use App\Models\Player;
use App\Services\GameService;
use App\Services\PlayerService;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;


uses(Tests\TestCase::class, RefreshDatabase::class);

it('generates unique game hash', function () {
    // Mock the dependencies you need for GameService
    $playerService = Mockery::mock(\App\Services\PlayerService::class);

    // Create an instance of GameService with mocked dependencies
    $gameService = new GameService($playerService);

    // Your test logic for generating a unique game hash
    $hash = $gameService->getNextHash();

    expect($hash)->toBeInt();
    // Add more assertions to validate the hash
});

it('creates a game successfully', function () {
    // Mock the dependencies you need for GameService
    $playerService = Mockery::mock(PlayerService::class);

    // Create a Collection to simulate the expected return value
    $player1 = Player::factory()->create(['id' => 1, 'name' => 'Player 1']);
    $player2 = Player::factory()->create(['id' => 2, 'name' => 'Player 2']);

    // Create a Collection and add Player instances to it
    $playersCollection = new Collection([$player1, $player2]);


    // Set up an expectation for the storePlayers method
    $playerService
        ->shouldReceive('storePlayers')
        ->once()
        ->with(Mockery::type('array'))
        ->andReturn($playersCollection); // Return the Collection instance

    // Create an instance of GameService with mocked dependencies
    $gameService = new GameService($playerService);

    // Your test logic for creating a game
    $gameData = [
        'hash' => 'exampleHash123',
        'gameType' => '501',
        'outType' => 'double_exact',
        'players' => [
            'Player 1',
            'Player 2',
        ],
    ];

    // Call the method with unpacked array as arguments
    $game = $gameService->createGame(...$gameData);

    // Assert the Game model was created and exists in the database
    $this->assertModelExists($game);

    // Additional assertions
    expect($game->hash)->toBe($gameData['hash']);
    expect($game->game_type)->toBe($gameData['gameType']);
    expect($game->out_type)->toBe($gameData['outType']);
    expect($game->players)->toHaveCount(count($gameData['players']));

    // You can add more assertions here to thoroughly test the game creation
});

