<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('complaint_id');
            $table->unsignedInteger('complaintable_id');
            $table->string('complaintable_type');
            $table->unsignedInteger('user_id');
            $table->boolean('resolved')->default(false);
            $table->timestamps();

            $table->foreign('complaint_id')->references('id')->on('complaints');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
