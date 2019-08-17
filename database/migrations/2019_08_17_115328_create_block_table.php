<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            // Key
            $table->bigIncrements('id');
            
            // Foreign Key
            $table->unsignedBigInteger('number_id');
            $table->foreign('number_id')->references('id')->on('number_list');
            $table->unsignedBigInteger('blocked_by');
            $table->foreign('blocked_by')->references('id')->on('users');

            // Information
            $table->text('reason')->nullable();

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
        Schema::dropIfExists('block');
    }
}
