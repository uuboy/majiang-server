<?php

namespace App\Observers;

use App\Models\Game;

class GameObserver
{
    /**
     * Handle the game "created" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function created(Game $game)
    {
        //
    }

    /**
     * Handle the game "updated" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function updated(Game $game)
    {
        //
    }

    /**
     * Handle the game "deleted" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function deleted(Game $game)
    {
        \DB::table('game_records')->where('game_id', $game->id)->delete();
    }

    /**
     * Handle the game "restored" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function restored(Game $game)
    {
        //
    }

    /**
     * Handle the game "force deleted" event.
     *
     * @param  \App\Models\Game  $game
     * @return void
     */
    public function forceDeleted(Game $game)
    {
        //
    }
}
