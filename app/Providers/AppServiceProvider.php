<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use App\Models\Game_record;
use App\Observers\GameRecordObserver;
use App\Models\Game;
use App\Observers\GameObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Resource::withoutWrapping();
        Game_record::observe(GameRecordObserver::class);
        Game::observe(GameObserver::class);
    }
}
