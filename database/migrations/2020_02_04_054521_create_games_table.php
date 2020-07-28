<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('genre')->nullable();
            $table->date('release')->nullable();
            $table->string('developer')->nullable();
            $table->double('ukuran');
            $table->text('spec')->nullable();
            $table->text('install')->nullable();
            $table->integer('rating')->nullable();
            $table->string('poster')->nullable();
            $table->string('link_download')->nullable();
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('game');
    }
}
