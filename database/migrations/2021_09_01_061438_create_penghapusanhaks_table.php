<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenghapusanhaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penghapusanhaks', function (Blueprint $table) {
              $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('sertifikat_asli')->default('belum di upload');
            $table->string('sertifikat_hak_tanggungan')->default('belum di upload');
            $table->string('surat_roya')->default('belum di upload');
            $table->string('ktp')->default('belum di upload');
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
        Schema::dropIfExists('penghapusanhaks');
    }
}
