<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_service', function (Blueprint $table) {
            $table->bigInteger('apartament_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->primary(['apartament_id', 'service_id']); 

            $table->foreign('apartament_id')->references('id')->on('apartaments')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartament_service');
    }
}
