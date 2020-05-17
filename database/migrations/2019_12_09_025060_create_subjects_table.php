<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('description');
            $table->integer('home_work');
            $table->integer('class_work');
            $table->integer('friday_test');
            $table->integer('holiday_assignment');
            $table->string('level');
            $table->integer('summative_test')->nullable();
            $table->integer('cat_1')->nullable();
            $table->integer('cat_2')->nullable();
            $table->integer('exam');
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
        Schema::dropIfExists('subjects');
    }
}
