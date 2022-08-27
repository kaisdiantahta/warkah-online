<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_loan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id');
            $table->string('peminjam')->nullable();
            $table->string('no_identitas')->nullable();
            $table->datetime('tanggal_pinjam')->nullable();
            $table->datetime('batas_pengembalian')->nullable();
            $table->datetime('tanggal_kembali')->nullable();
            $table->integer('denda')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('books_loan_tables');
    }
}
