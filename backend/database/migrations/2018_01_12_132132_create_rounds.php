<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("rounds", function (Blueprint $table){
           $table->increments("id");
           $table->string("game");
           $table->integer("score")->unsigned();
           $table->integer("player_id")->unsigned();
           $table->integer("location_id")->unsigned();
           $table->timestamps();

           $table->foreign('player_id')
               ->references('id')
               ->on('players')
               ->onDelete('cascade')
               ->onUpdate('cascade');

            $table->foreign('location_id')
               ->references('id')
               ->on('locations')
               ->onDelete('restrict')
               ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("rounds", function (Blueprint $table){
           $table->dropForeign(["player_id"]);
           $table->dropForeign(["location_id"]);
        });

        Schema::dropIfExists("rounds");
    }
}
