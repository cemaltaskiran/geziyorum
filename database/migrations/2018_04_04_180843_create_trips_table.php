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
            $table->unsignedInteger('id');
            $table->string('name');
            $table->string('url')->unique()->nullable();
            $table->unsignedInteger('user_id');
            $table->text('about')->nullable();
            $table->unsignedInteger('total_distance')->nullable();
            $table->unsignedInteger('average_speed')->nullable();
            $table->unsignedInteger('total_time')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users');
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
