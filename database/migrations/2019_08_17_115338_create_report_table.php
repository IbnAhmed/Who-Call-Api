<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            // Key
            $table->bigIncrements('id');
            
            // Foreign Key
            $table->unsignedBigInteger('number_id');
            $table->foreign('number_id')->references('id')->on('number_list');
            $table->unsignedBigInteger('reported_by');
            $table->foreign('reported_by')->references('id')->on('users');

            // Information
            $table->string('reason');
            $table->text('reason_description')->nullable();

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
        Schema::dropIfExists('report');
    }
}
