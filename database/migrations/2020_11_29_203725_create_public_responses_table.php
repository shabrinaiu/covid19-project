<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('news_date');
            $table->string('country', 100);
            $table->string('news_url', 200);
            $table->string('news_text');
            $table->decimal('response_value', 3, 2);
            $table->string('entried_by', 100);
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
        Schema::dropIfExists('public_responses');
    }
}
