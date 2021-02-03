<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player1_id')->nullable();
            $table->unsignedBigInteger('player2_id')->nullable();
            $table->unsignedBigInteger('player3_id')->nullable();
            $table->unsignedBigInteger('player4_id')->nullable();
            $table->integer('player1_score')->default(0);
            $table->integer('player2_score')->default(0);
            $table->integer('player3_score')->default(0);
            $table->integer('player4_score')->default(0);
            $table->unsignedInteger('winner_id')->default(0);
            $table->integer('goal')->default(0);
            $table->boolean('is_end')->default(false);
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
        Schema::dropIfExists('games');
    }
}
