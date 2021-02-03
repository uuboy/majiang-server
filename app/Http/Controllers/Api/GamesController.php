<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameRecordResource;
use App\Http\Requests\Api\GameRequest;

class GamesController extends Controller
{
    function store(Game $game, GameRequest $request)
    {
        $game->fill($request->only('goal'));
        $game->player1_id = $request->user()->id;
        $game->save();
        return new GameResource($game);
    }

    function join(Game $game, Request $request)
    {
        if($this->in_game($game,$request->user()->id))
        {
            abort(403,'您已经在对局中');
        }

        if(isset($game->player2_id)) {
            if(isset($game->player3_id)) {
                if(isset($game->player4_id)) {
                    abort(403,'该对局已满，无法加入');
                } else {
                    $game->player4_id = $request->user()->id;
                }
            } else {
                $game->player3_id = $request->user()->id;
            }
        } else {
            $game->player2_id = $request->user()->id;
        }
        $game->save();
        return new GameResource($game);
    }

    function show(Game $game, Request $request)
    {
        $query = $game->query();
        $game2 =$query->where('id',$game->id)->with('player1','player2','player3','player4')->first();
        return new GameResource($game2);
    }

    function in_game(Game $game, $id)
    {
        if($game->player1_id != $id) {
            if($game->player2_id != $id) {
                if($game->player3_id != $id) {
                    if($game->player4_id != $id){
                        return false;
                    }
                }
            }
        }

        return true;
    }

    function set_winner(Game $game, Request $request)
    {
        $winner_id = (int)$request->winner_id;
        if($winner_id >=1 && $winner_id <=4) {
            $game->winner_id = $winner_id;
            $game->save();
        } else {
            abort(403,'设置庄家无效');
        }


        return new GameResource($game);
    }

    function destory(Game $game, Request $request)
    {
        $game->delete();
        return response(null, 204);
    }

    function records_index(Game $game, Request $request)
    {
        $records = $game->game_records()->orderBy('id','desc')->paginate(5);

        return GameRecordResource::collection($records);
    }

    function my_games(Request $request)
    {
        $user_id = $request->user()->id;
        $games = Game::where('player1_id', $user_id)
                ->orWhere('player2_id', $user_id)
                ->orWhere('player3_id', $user_id)
                ->orWhere('player4_id', $user_id)
                ->orderBy('id', 'desc')
                ->paginate(5);
        return GameResource::collection($games);
    }
}
