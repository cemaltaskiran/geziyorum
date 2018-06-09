<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('complaint_id');
            $table->unsignedInteger('report_id');
            $table->string('banable_type');
            $table->unsignedInteger('banable_id');
            $table->string('message');
            $table->dateTime('timeout');
            $table->timestamps();

            $table->foreign('complaint_id')->references('id')->on('complaints');
            $table->foreign('report_id')->references('id')->on('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bans');
    }
}
