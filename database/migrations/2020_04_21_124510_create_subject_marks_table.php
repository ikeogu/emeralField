<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id');
            $table->bigInteger('subject_id');
            $table->double('HW', 15, 8)->nullable();
            $table->double('CW', 15, 8)->nullable();
            $table->double('FT', 15, 8)->nullable();
            $table->double('HA', 15, 8)->nullable();
            $table->double('Summative_test', 15, 8)->nullable();
            $table->double('CAT1', 15, 8)->nullable();
            $table->double('CAT2', 15, 8)->nullable();
            $table->double('MSC', 15, 8)->nullable();
            $table->double('Exam', 15, 8)->nullable();
            $table->double('GT', 15, 8)->nullable();
            
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
        Schema::dropIfExists('subject_marks');
    }
}
