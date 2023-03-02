<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarkahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warkahs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_akta');
            $table->string('nama_pihak1');
            $table->string('nama_pihak2');
            $table->string('rincian');
            $table->string('alamat');
            $table->integer('nomial_transaksi');
            $table->string('file');
            $table->string('nama_file');
            $table->string('komentar')->nullable();
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
        Schema::dropIfExists('warkah');
    }
}
