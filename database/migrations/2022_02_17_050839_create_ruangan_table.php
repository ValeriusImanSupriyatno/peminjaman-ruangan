<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->bigIncrements('ruangan_id');
            $table->bigInteger('ruangan_hak_id')->unsigned();
            $table->foreign('ruangan_hak_id', 'tbl_ruangan_hak_id_foreign')->references('hak_id')->on('hak_milik');
            $table->bigInteger('ruangan_kategori_id')->unsigned();
            $table->foreign('ruangan_kategori_id', 'tbl_ruangan_kategori_id_foreign')->references('kategori_id')->on('kategori_ruangan');
            $table->string('kode_ruangan', 255);
            $table->string('nama_ruangan', 255);
            $table->integer('kapasitas')->nullable();
            $table->string('deskripsi_ruangan', 255)->nullable();
            $table->char('is_active')->default('Y');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangan');
    }
}
