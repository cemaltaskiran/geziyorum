<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url')->unique()->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('about')->nullable();
            $table->unsignedInteger('total_distance')->nullable();
            $table->unsignedInteger('average_speed')->nullable();
            $table->unsignedInteger('total_time')->nullable();
            $table->unsignedInteger('media_id')->nullable();
            $table->foreign('media_id')->references('id')->on('medias');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('locations', function($table) {
            $table->foreign('trip_id')->references('id')->on('trips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
