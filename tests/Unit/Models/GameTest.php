<?php

uses(Tests\TestCase::class);

it('has players', function () {
    $game = \App\Models\Game::factory()->create();
    $player = \App\Models\Player::factory()->create();

    $game->players()->attach($player);
    $game->refresh();

    expect($game->players)->toHaveCount(1);
});
