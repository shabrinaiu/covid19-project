<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_slug');
            $table->string('province')->nullable();
            $table->string('date');
            $table->integer('confirmed');
            $table->integer('recovered');
            $table->integer('deaths');
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
        Schema::dropIfExists('country_details');
    }
}
