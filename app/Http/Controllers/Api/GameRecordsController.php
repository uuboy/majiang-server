<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\GameRecordRequest;
use App\Models\Game_record;
use App\Models\Game;
use App\Http\Resources\GameRecordResource;

class GameRecordsController extends Controller
{
    public function store(Game_record $record, GameRecordRequest $request)
    {
        $game = Game::where('id', $request->game_id)->first();
        if(empty($game)) {
            abort(403, '游戏对局不存在');
        } else {
            if(empty($game->winner_id)) {
                abort(403, '游戏庄家未设置');
            } else {
                if($game->is_end) {
                    abort(403, '游戏对局已结束');
                } else {
                    $record->fill($request->all());
                    $record->loser_id = $game->winner_id;
                    $record->save();

                    return new GameRecordResource($record);
                }
            }
        }
    }

    public function destory(Game_record $record, Request $request)
    {
        $record->delete();
        return response(null, 204);
    }

    public function show(Game_record $record, Request $request)
    {
        return new GameRecordResource($record);
    }
}
