<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) { 
            $table->bigIncrements('id');
            $table->string('street_name', 255);
            $table->string('street_number', 10); 
            $table->integer('post_code'); 
            $table->string('city'); 
            $table->decimal('long', 11, 8);
            $table->decimal('lat', 11, 8);
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
        Schema::dropIfExists('addresses');
    }
}
