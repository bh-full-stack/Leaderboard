<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueRuleToPlayerSquadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_squad', function (Blueprint $table) {
            $table->unique(['player_id', 'squad_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_squad', function (Blueprint $table) {
            $table->dropForeign(['player_id']);
            $table->dropForeign(['squad_id']);
            $table->dropUnique('player_squad_player_id_squad_id_unique');
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('squad_id')
                ->references('id')
                ->on('squads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
