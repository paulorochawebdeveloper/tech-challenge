<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_movie', function (Blueprint $table) {
            $table->integer('appearances')->default(1);

            // Foreign keys
            $table->foreignId('actor_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade') 
                ->constrained();
            $table->foreignId('movie_id')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_movie');
    }
}
