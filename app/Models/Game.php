<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['player1_id','player2_id','player3_id','player4_id','player1_score','player2_score','player3_score','player4_score','winner_id','goal','is_end'];
    public function game_records()
    {
        return $this->hasMany('App\Models\Game_record');
    }

    public function player1()
    {
        return $this->belongsTo('App\Models\User', 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo('App\Models\User', 'player2_id');
    }

    public function player3()
    {
        return $this->belongsTo('App\Models\User', 'player3_id');
    }

    public function player4()
    {
        return $this->belongsTo('App\Models\User', 'player4_id');
    }
}
