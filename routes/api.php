<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->namespace('Api')
                    ->name('api.v1.')
                    ->group(function() {

    Route::get('version', function() {
        return 'this is verison v1';
    })->name('version');
    //微信小程序登录
    Route::post('weapp/authorizations', 'AuthorizationsController@weappStore')
        ->name('weapp.authorizations.store');
    //刷新Token
    Route::put('authorizations/current', 'AuthorizationsController@update')
        ->name('authorizations.update');
    //删除Token
    Route::delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('authorizations.destory');
    //获取某个用户的信息
    Route::get('users/{user}', 'UsersController@show')
        ->name('user.show');
    //----------------登录之后的API----------------------
    Route::middleware('auth:api')->group(function (){
        //获取登录用户信息
        Route::get('user', 'UsersController@me')
            ->name('user.show.me');

        //创建游戏对局
        Route::post('games', 'GamesController@store')
            ->name('games.store');
        //加入游戏对局
        Route::put('games/{game}/join', 'GamesController@join')
            ->name('games.join');
        //获取游戏对局信息
        Route::get('games/{game}', 'GamesController@show')
            ->name('games.show');
        //设置游戏庄家
        Route::put('games/{game}/set_winner', 'GamesController@set_winner')
            ->name('games.set_winner');
        //删除游戏对局
        Route::delete('games/{game}', 'GamesController@destory')
            ->name('games.destory');
        //创建游戏记录
        Route::post('game_records', 'GameRecordsController@store')
            ->name('game_records.store');
        //获取游戏记录
        Route::get('game_records/{record}', 'GameRecordsController@show')
            ->name('game_records.show');
        //删除游戏记录
        Route::delete('game_records/{record}', 'GameRecordsController@destory')
            ->name('game_records.destory');
        //获取对局下的游戏记录
        Route::get('games/{game}/records', 'GamesController@records_index')
            ->name('games.records_index');
        //获取玩家参与的对局
        Route::get('my_games', 'GamesController@my_games')
            ->name('my_games');

    });
});

