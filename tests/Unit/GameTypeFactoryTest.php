<?php

use App\Contracts\GameTypeInterface;
use App\Factories\GameTypeFactory;
use App\Models\Game;

it('creates the correct game type object', function () {
    // Mock the Game model
    $game = Mockery::mock(Game::class);
    $game->shouldReceive('getAttribute')->with('id')->andReturn(1);
    $game->shouldReceive('getAttribute')->with('game_type')->andReturn('501'); // Example game type
    $game->shouldReceive('getAttribute')->with('out_type')->andReturn('double_exact'); // Example out type

    // Create the game type object
    $gameTypeObject = GameTypeFactory::create($game);

    // Test if the created object is an instance of GameTypeInterface
    expect($gameTypeObject)->toBeInstanceOf(GameTypeInterface::class);
});
