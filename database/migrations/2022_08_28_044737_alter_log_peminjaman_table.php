<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLogPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('log_peminjaman', 'status')){
                $table->bigInteger('status')->after('denda')->default(1);
            }
        });

        Schema::table('peminjam', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjam', 'status')){
                $table->bigInteger('status')->after('no_identitas')->default(1);
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
        Schema::table('log_peminjaman', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });

        Schema::table('peminjam', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
