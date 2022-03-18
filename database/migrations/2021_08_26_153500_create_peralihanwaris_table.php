<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeralihanwarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralihanwaris', function (Blueprint $table) {
          $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->string('pihakpertama');
            $table->string('pihakkedua');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('almaktakematian')->default('belum di upload');
            $table->string('almaktanikah')->default('belum di upload');
            $table->string('almkk')->default('belum di upload');
            $table->string('almnpwp')->default('belum di upload');
            $table->string('almpbb')->default('belum di upload');
            $table->string('almsertifikat')->default('belum di upload');
            $table->string('penerimaktp')->default('belum di upload');
            $table->string('penerimakk')->default('belum di upload');
            $table->string('penerimaaktanikah')->default('belum di upload');
            $table->string('penerimaaktalahir')->default('belum di upload');
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
        Schema::dropIfExists('peralihanwaris');
    }
}
