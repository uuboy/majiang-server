<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game_record extends Model
{
    protected $fillable = ['game_id','winner_id','score','loser_id'];

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
