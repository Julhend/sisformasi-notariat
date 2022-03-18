<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeralihanhibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralihanhibah', function (Blueprint $table) {
           $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->string('pihakpertama');
            $table->string('pihakkedua');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('pemberiktp')->default('belum di upload');
            $table->string('pemberiktppasangan')->default('belum di upload');
            $table->string('pemberikk')->default('belum di upload');
            $table->string('pemberiaktanikah')->default('belum di upload');
            $table->string('pemberinpwp')->default('belum di upload');
            $table->string('pemberipbb')->default('belum di upload');
            $table->string('pemberisertifikat')->default('belum di upload');
            $table->string('penerimaktp')->default('belum di upload');
            $table->string('penerimakk')->default('belum di upload');
            $table->string('penerimanpwp')->default('belum di upload');
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
        Schema::dropIfExists('peralihanhibah');
    }
}
