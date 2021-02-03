<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedInteger('winner_id')->default(0);
            $table->unsignedInteger('loser_id')->default(0);
            $table->unsignedInteger('score')->default(0);
            $table->integer('player1_score')->default(0);
            $table->integer('player2_score')->default(0);
            $table->integer('player3_score')->default(0);
            $table->integer('player4_score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_records');
    }
}
