<?php

use App\Models\Game;
use App\Services\GameService;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->gameService = new GameService();
});

it('generates unique game hash', function () {
    $hash = $this->gameService->getNextHash();
    expect($hash)->toBeInt();
    // Add more assertions to validate the hash
});

it('creates a game successfully', function () {
    // Mock data
    $gameData = [
        'hash' => 'exampleHash123',  // Example hash value
        'gameType' => '501',         // Assuming '501' is a valid game type
        'outType' => 'double_exact', // Assuming this is a valid out type
        'players' => [
            ['id' => 1, 'name' => 'Player 1'], // Mock player data
            ['id' => 2, 'name' => 'Player 2'],
        ],
    ];

    // Call the method with unpacked array as arguments
    $game = $this->gameService->createGame(...$gameData);

    // Assert the Game model was created and exists in the database
    $this->assertModelExists($game);

    // Additional assertions
    expect($game->hash)->toBe($gameData['hash']);
    expect($game->game_type)->toBe($gameData['gameType']);
    expect($game->out_type)->toBe($gameData['outType']);
    expect($game->players)->toHaveCount(count($gameData['players']));

    // You can add more assertions here to thoroughly test the game creation
});
