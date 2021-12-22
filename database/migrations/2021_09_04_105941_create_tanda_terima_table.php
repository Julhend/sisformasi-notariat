<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTandaTerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanda_terima', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_dokumen');
            $table->string('jenis_hak');
            $table->string('no_sertifikat');
            $table->string('kelurahan');
            $table->string('luas');
            $table->string('keterangan');
            $table->string('nomor_antrian');
            $table->string('penyerah_sertifikat');
            $table->string('sertifikat_atas_nama');
            $table->string('nomor_handphone');
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
        Schema::dropIfExists('tanda_terima');
    }
}
