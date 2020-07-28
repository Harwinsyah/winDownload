<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('tahun');
            $table->string('kualitas');
            $table->string('genre')->nullable();
            $table->string('subtitle')->default("Ada - Indonesia");
            $table->string('negara')->nullable();
            $table->double('ukuran')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('status')->default("Belum Ready");
            $table->string('penyimpanan')->default("HP");
            $table->string('jenis');
            $table->string('episode')->default(1);
            $table->integer('rating')->nullable();
            $table->string('sub_link')->nullable();
            $table->string('film_link')->nullable();
            $table->date('release')->nullable();
            $table->string('poster')->nullable();
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
        Schema::dropIfExists('film');
    }
}
