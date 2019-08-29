<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsortypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsortypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 255);
            $table->string('price', 10);
            // numero di ore della sponsorizzazione 
            $table->string('time_length');
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
        Schema::dropIfExists('sponsortypes');
    }
}
