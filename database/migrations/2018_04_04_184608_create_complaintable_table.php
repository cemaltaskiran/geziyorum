<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaintable', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('complaint_id');
            $table->foreign('complaint_id')->references('id')->on('complaints');
            $table->unsignedInteger('complaintable_id');
            $table->string('complaintable_type');
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
        Schema::dropIfExists('complaintable');
    }
}
