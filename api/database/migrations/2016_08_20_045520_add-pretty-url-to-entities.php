<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrettyUrlToEntities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entities',function($table) {
           $table->string('pretty_url', 100)->nullable()->after('title');
           $table->unique('pretty_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entities',function($table) {
           $table->dropColumn(['pretty_url']);
        });
    }
}
