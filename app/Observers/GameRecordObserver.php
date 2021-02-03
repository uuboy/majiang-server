<?php

namespace App\Observers;

use App\Models\Game_record;
use App\Models\Game;

class GameRecordObserver
{
    /**
     * Handle the game_record "created" event.
     *
     * @param  \App\Models\Game_record  $gameRecord
     * @return void
     */
    public function created(Game_record $gameRecord)
    {
        $game = Game::where('id', $gameRecord->game_id)->first();
        if(isset($game)) {
            if($gameRecord->winner_id == $gameRecord->loser_id) {
                switch ($gameRecord->winner_id) {
                    case 1:
                        $gameRecord->player1_score = ($gameRecord->score)*24;
                        $gameRecord->player2_score = ($gameRecord->score)*-8;
                        $gameRecord->player3_score = ($gameRecord->score)*-8;
                        $gameRecord->player4_score = ($gameRecord->score)*-8;
                        break;
                    case 2:
                        $gameRecord->player1_score = ($gameRecord->score)*-8;
                        $gameRecord->player2_score = ($gameRecord->score)*24;
                        $gameRecord->player3_score = ($gameRecord->score)*-8;
                        $gameRecord->player4_score = ($gameRecord->score)*-8;
                        break;
                    case 3:
                        $gameRecord->player1_score = ($gameRecord->score)*-8;
                        $gameRecord->player2_score = ($gameRecord->score)*-8;
                        $gameRecord->player3_score = ($gameRecord->score)*24;
                        $gameRecord->player4_score = ($gameRecord->score)*-8;
                        break;
                    case 4:
                        $gameRecord->player1_score = ($gameRecord->score)*-8;
                        $gameRecord->player2_score = ($gameRecord->score)*-8;
                        $gameRecord->player3_score = ($gameRecord->score)*-8;
                        $gameRecord->player4_score = ($gameRecord->score)*24;
                        break;
                    default:
                        break;
                }
            } else {
                switch ($gameRecord->winner_id) {
                    case 1:
                        $gameRecord->player1_score = ($gameRecord->score)*10;
                        $gameRecord->player2_score = ($gameRecord->score)*-1;
                        $gameRecord->player3_score = ($gameRecord->score)*-1;
                        $gameRecord->player4_score = ($gameRecord->score)*-1;
                        break;
                    case 2:
                        $gameRecord->player1_score = ($gameRecord->score)*-1;
                        $gameRecord->player2_score = ($gameRecord->score)*10;
                        $gameRecord->player3_score = ($gameRecord->score)*-1;
                        $gameRecord->player4_score = ($gameRecord->score)*-1;
                        break;
                    case 3:
                        $gameRecord->player1_score = ($gameRecord->score)*-1;
                        $gameRecord->player2_score = ($gameRecord->score)*-1;
                        $gameRecord->player3_score = ($gameRecord->score)*10;
                        $gameRecord->player4_score = ($gameRecord->score)*-1;
                        break;
                    case 4:
                        $gameRecord->player1_score = ($gameRecord->score)*-1;
                        $gameRecord->player2_score = ($gameRecord->score)*-1;
                        $gameRecord->player3_score = ($gameRecord->score)*-1;
                        $gameRecord->player4_score = ($gameRecord->score)*10;
                        break;
                    default:
                        break;
                }

                switch ($gameRecord->loser_id) {
                    case 1:
                        $gameRecord->player1_score -= ($gameRecord->score)*7;
                        break;
                    case 2:
                        $gameRecord->player2_score -= ($gameRecord->score)*7;
                        break;
                    case 3:
                        $gameRecord->player3_score -= ($gameRecord->score)*7;
                        break;
                    case 4:
                        $gameRecord->player4_score -= ($gameRecord->score)*7;
                        break;
                    default:
                        break;
                }

            }

            $gameRecord->save();

            $game->winner_id = $gameRecord->winner_id;
            $gameRecords = Game_record::where('game_id', $gameRecord->game_id)->get();
            $player1_score = $gameRecords->sum('player1_score');
            $player2_score = $gameRecords->sum('player2_score');
            $player3_score = $gameRecords->sum('player3_score');
            $player4_score = $gameRecords->sum('player4_score');
            $game->player1_score = $player1_score;
            $game->player2_score = $player2_score;
            $game->player3_score = $player3_score;
            $game->player4_score = $player4_score;
            if($gameRecord->winner_id != $gameRecord->loser_id) {
                if($player1_score <= -1*($game->goal) || $player2_score <= -1*($game->goal) || $player3_score < -1*($game->goal) || $player4_score < -1*($game->goal)) {
                    $game->is_end = true;
                }
            }
            $game->save();
        }


    }

    /**
     * Handle the game_record "updated" event.
     *
     * @param  \App\Models\Game_record  $gameRecord
     * @return void
     */
    public function updated(Game_record $gameRecord)
    {
        //
    }

    /**
     * Handle the game_record "deleted" event.
     *
     * @param  \App\Models\Game_record  $gameRecord
     * @return void
     */
    public function deleted(Game_record $gameRecord)
    {
        $game = Game::where('id', $gameRecord->game_id)->first();
        if(isset($game)) {
            $gameRecords = Game_record::where('game_id', $gameRecord->game_id)->get();
            $player1_score = $gameRecords->sum('player1_score');
            $player2_score = $gameRecords->sum('player2_score');
            $player3_score = $gameRecords->sum('player3_score');
            $player4_score = $gameRecords->sum('player4_score');
            $game->player1_score = $player1_score;
            $game->player2_score = $player2_score;
            $game->player3_score = $player3_score;
            $game->player4_score = $player4_score;
            $game->save();
        }

    }

    /**
     * Handle the game_record "restored" event.
     *
     * @param  \App\Models\Game_record  $gameRecord
     * @return void
     */
    public function restored(Game_record $gameRecord)
    {
        //
    }

    /**
     * Handle the game_record "force deleted" event.
     *
     * @param  \App\Models\Game_record  $gameRecord
     * @return void
     */
    public function forceDeleted(Game_record $gameRecord)
    {
        //
    }
}
