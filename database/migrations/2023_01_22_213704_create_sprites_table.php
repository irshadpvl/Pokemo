<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprites', function (Blueprint $table) {
            $table->id();
            $table->foreignId("pokemon_id");
            $table->string("back_default")->nullable();
            $table->string("back_female")->nullable();
            $table->string("back_shiny")->nullable();
            $table->string("back_shiny_female")->nullable();
            $table->string("front_default")->nullable();
            $table->string("front_female")->nullable();
            $table->string("front_shiny")->nullable();
            $table->string("front_shiny_female")->nullable();
            $table->timestamps($precision = 0);
            $table->dateTime("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sprites');
    }
}
