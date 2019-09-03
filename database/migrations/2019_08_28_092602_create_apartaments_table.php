<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('title', 255);
            $table->tinyInteger('total_rooms');
            $table->tinyInteger('total_beds');
            $table->tinyInteger('total_baths');
            $table->integer('square_meters');
            $table->string('image_url', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->decimal('long', 11, 8)->nullable();
            $table->decimal('lat', 11, 8)->nullable();
            $table->boolean('visible');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartaments');
    }
}
