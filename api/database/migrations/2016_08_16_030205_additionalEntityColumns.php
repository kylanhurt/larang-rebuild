<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalEntityColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entities',function($table) {
           $table->smallInteger('year_founded')->nullable()->unsigned()->after('website');
           $table->string('industry', 200)->nullable()->after('year_founded');
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
           $table->dropColumn(['year_founded', 'industry']);
        });
    }
}
