<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('apart_id')->unsigned();
            $table->bigInteger('sponsortype_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->foreign('apart_id')->references('id')->on('apartaments')->onDelete('cascade');
            $table->foreign('sponsortype_id')->references('id')->on('sponsortypes')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
