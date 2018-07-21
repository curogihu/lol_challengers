<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngestedApiTable extends Migration
{
    protected $primaryKey = null;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingested_api', function (Blueprint $table) {
            $table->integer('major_version');
            $table->integer('minor_version');
            $table->string('kind');

            $table->unique(['major_version', 'minor_version', 'kind']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingested_api');
    }
}
