<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('jk')->nullable();
            $table->string('alamat')->nullable();
            $table->string('hp');
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('wa')->nullable();
            $table->text('ambil')->nullable();
            $table->double('ukuran')->nullable();
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('pelanggan');
    }
}
