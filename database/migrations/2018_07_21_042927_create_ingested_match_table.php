<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngestedMatchTable extends Migration
{
    protected $primaryKey = null;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingested_match', function (Blueprint $table) {
            $table->integer('major_version');
            $table->integer('minor_version');
            $table->bigInteger('match_id');

            $table->unique(['major_version', 'minor_version', 'match_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingested_match');
    }
}
