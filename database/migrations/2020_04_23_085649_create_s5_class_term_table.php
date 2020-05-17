<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateS5ClassTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Schema::disableForeignKeyConstraints();
        // Schema::create('s5_class_term', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedInteger('s5_class_id');
        //     $table->unsignedInteger('term_id');

        //     $table->foreign('s5_class_id')
        //             ->references('id')->on('s5_classes')->onDelete('cascade');

        //     $table->foreign('term_id')
        //             ->references('id')->on('terms')->onDelete('cascade');
        // });
        
        // Schema::enableForeignKeyConstraints();
            
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        // Schema::dropIfExists('s5_class_term');
        // Schema::enableForeignKeyConstraints();
    }
}
