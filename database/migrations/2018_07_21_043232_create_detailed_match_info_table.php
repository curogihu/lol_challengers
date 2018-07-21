<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailedMatchInfoTable extends Migration
{
    protected $primaryKey = null;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_match_info', function (Blueprint $table) {
            $table->bigInteger('match_id');
            $table->integer('champion_id');
            $table->string('role_id');
            $table->integer('opponent_champion_id');
            $table->integer('item_id');
            $table->integer('elapsed_seconds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailed_match_info');
    }
}
