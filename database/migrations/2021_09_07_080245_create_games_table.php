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
            $table->id();
            $table->uuid('player_1');
            $table->uuid('player_2');
            $table->uuid('player_3')->nullable();
            $table->uuid('player_4')->nullable();
            $table->bigInteger('place_id')->unsigned();
            $table->timestamps();

            $table->foreign('player_1')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player_2')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player_3')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player_4')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
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
