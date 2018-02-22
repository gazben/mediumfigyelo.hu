<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('count');
            $table->unsignedInteger('site_state_id');
            $table->foreign('site_state_id')->references('id')->on('site_states');

            $table->unsignedInteger('keyword_id');
            $table->foreign('keyword_id')->references('id')->on('keywords');
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
        Schema::dropIfExists('keyword_counts');
    }
}
