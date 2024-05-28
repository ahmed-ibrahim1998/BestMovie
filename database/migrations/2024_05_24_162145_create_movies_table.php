<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('field_2023')->nullable();
            $table->string('field_2022')->nullable();
            $table->string('title')->nullable();
            $table->string('director')->nullable();
            $table->string('year')->nullable();
            $table->string('country')->nullable();
            $table->string('length_of_film')->nullable();
            $table->string('genre')->nullable();
            $table->string('colour')->nullable();
            $table->string('tmdb_id')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
