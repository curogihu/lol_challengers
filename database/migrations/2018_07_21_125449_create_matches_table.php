<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigInteger('gameId');
            $table->integer('champion');
            $table->integer('queue');
            $table->integer('season');
            $table->bigInteger('timestamp');
            $table->string('role')->index();
            $table->string('lane')->index();

            $table->primary(['gameId', 'champion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
