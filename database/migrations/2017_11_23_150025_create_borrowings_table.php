<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_peminjam');
            $table->text('alamat_peminjam');
            $table->string('judul_buku');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->integer('denda')->nullable();
            $table->string('status_peminjam');
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
        Schema::dropIfExists('borrowings');
    }
}
