<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            // Key
            $table->bigIncrements('id');
            
            // Foreign Key
            $table->unsignedBigInteger('number_id');
            $table->foreign('number_id')->references('id')->on('number_list');
            $table->unsignedBigInteger('reviewed_by');
            $table->foreign('reviewed_by')->references('id')->on('users');

            // Information
            $table->text('review')->nullable();
            $table->tinyInteger('rating');

            // Time
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
        Schema::dropIfExists('review');
    }
}
