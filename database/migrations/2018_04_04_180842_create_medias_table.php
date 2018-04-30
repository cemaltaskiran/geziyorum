<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->unique();
            $table->string('name');
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('media_type_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('media_type_id')->references('id')->on('media_types');
            $table->ipAddress('ip');
            $table->softDeletes();
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
        Schema::dropIfExists('medias');
    }
}
