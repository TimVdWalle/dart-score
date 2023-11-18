<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class ResetDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset db: clear all players, games, and games_players tables';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("truncating tables: players and games");
        Player::query()->truncate();
        Game::query()->truncate();
        DB::table('game_player')->truncate();

        $this->info("truncating done!");
    }
}
