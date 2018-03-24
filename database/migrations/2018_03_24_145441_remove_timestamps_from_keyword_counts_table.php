<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTimestampsFromKeywordCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keyword_counts', function (Blueprint $table) {
            $table->removeColumn('created_at');
            $table->removeColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keyword_counts', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
