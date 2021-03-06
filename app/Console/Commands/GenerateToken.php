<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'majiang-server:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速生成用户token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->ask('输入用户ID');

        $user = User::find($userId);

        if(!$user) {
            return $this->error('用户不存在');
        }

        $ttl= 365*24*60;
        $this->info(auth('api')->setTTL($ttl)->login($user));

    }
}
