<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_infos', function (Blueprint $table) {
            $table->bigInteger('gameId');
            $table->integer('participantId');
            $table->integer('championId');
            $table->integer('spell1Id');
            $table->integer('spell2Id');
            $table->string('role');
            $table->string('lane');
            $table->bigInteger('accountId');
            $table->bigInteger('currentAccountId');
            $table->bigInteger('summonerId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_infos');
    }
}
