<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratwarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratwaris', function (Blueprint $table) {
           $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('akta_kematian')->default('belum di upload');
            $table->string('ktp_alm')->default('belum di upload');
            $table->string('kk_alm')->default('belum di upload');
            $table->string('akta_nikah_alm')->default('belum di upload');
            $table->string('ktp_penerima')->default('belum di upload');
            $table->string('kk_penerima')->default('belum di upload');
            $table->string('akta_lahir_penerima')->default('belum di upload');
            $table->text('keterangan');
            $table->string('keterangan_ditolak')->default('-');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('suratwaris');
    }
}
