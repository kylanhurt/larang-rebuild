<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score');
            $table->string('description')->nullable();
            $table->string('criteria')->default('general');
            $table->integer('entity_id')->unsigned();
            $table->integer('user_id')->unsigned();
            
            //need one column for user id
            $table->foreign('user_id')->references('id')->on('users');
            //need one column for entity ID
            $table->foreign('entity_id')->references('id')->on('entities');
            
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
        Schema::drop('reviews');
    }
}
