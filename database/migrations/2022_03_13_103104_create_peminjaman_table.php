<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('peminjaman_id');
            $table->bigInteger('peminjaman_ruangan_id');
            $table->foreign('peminjaman_ruangan_id', 'tbl_peminjaman_ruangan_id_foreign')->references('ruangan_id')->on('ruangan');
            $table->bigInteger('peminjaman_user_peminjam');
            $table->foreign('peminjaman_user_peminjam', 'tbl_peminjaman_user_peminjam_foreign')->references('user_id')->on('users');
            $table->bigInteger('peminjaman_user_acc')->nullable();
            $table->foreign('peminjaman_user_acc', 'tbl_peminjaman_user_acc_foreign')->references('user_id')->on('users');
            $table->string('peminjaman_kode', 255);
            $table->date('peminjaman_tgl_awal');
            $table->date('peminjaman_tgl_akhir');
            $table->time('peminjaman_jam_awal');
            $table->time('peminjaman_jam_akhir');
            $table->string('peminjaman_telp', 15);
            $table->string('peminjaman_kegiatan', 255);
            $table->string('peminjaman_deskripsi', 255)->nullable();
            $table->char('is_active', 1)->nullable();
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
        Schema::dropIfExists('peminjaman');
    }
}
