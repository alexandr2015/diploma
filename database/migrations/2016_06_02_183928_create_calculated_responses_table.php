<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatedResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('now_a');
            $table->decimal('now_b');
            $table->decimal('now_c');
            $table->decimal('now_d');
            $table->decimal('future_a');
            $table->decimal('future_b');
            $table->decimal('future_c');
            $table->decimal('future_d');
            $table->string('time');
            $table->softDeletes();
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
        Schema::drop('calculated_responses');
    }
}
