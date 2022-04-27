<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ruangan', function (Blueprint $table) {
            $table->bigIncrements('detru_id');
            $table->bigInteger('detru_ruangan_id')->unsigned();
            $table->foreign('detru_ruangan_id', 'tbl_detru_ruangan_id_foreign')->references('ruangan_id')->on('ruangan');
            $table->bigInteger('detru_fasilitas_id')->unsigned();
            $table->foreign('detru_fasilitas_id', 'tbl_detru_fasilitas_id_foreign')->references('fasilitas_id')->on('fasilitas');
            $table->integer('detru_jumlah');
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
        Schema::dropIfExists('detail_ruangan');
    }
}
