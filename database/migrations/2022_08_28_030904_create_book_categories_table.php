<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'book_category_id')){
                $table->bigInteger('book_category_id')->after('id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_categories');   
        Schema::table('log_peminjaman', function (Blueprint $table) {
            $table->dropColumn(['book_category_id']);
        });
    }
}
