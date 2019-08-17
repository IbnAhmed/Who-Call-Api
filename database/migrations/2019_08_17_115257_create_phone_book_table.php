<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_book', function (Blueprint $table) {
            // Key
            $table->bigIncrements('id');
            
            // Foreign Key
            $table->unsignedBigInteger('number_id');
            $table->foreign('number_id')->references('id')->on('number_list');
            $table->unsignedBigInteger('save_by');
            $table->foreign('save_by')->references('id')->on('users');
            
            // Information
            $table->string('name');

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
        Schema::dropIfExists('phone_book');
    }
}
