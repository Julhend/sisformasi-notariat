<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeralihanjualbeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralihanjualbeli', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->string('pihakpertama');
            $table->string('pihakkedua');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('pertamaktp')->default('belum di upload');
            $table->string('pertamaktppasangan')->default('belum di upload');
            $table->string('pertamakk')->default('belum di upload');
            $table->string('pertamaaktanikah')->default('belum di upload');
            $table->string('pertamanpwp')->default('belum di upload');
            $table->string('pertamapbb')->default('belum di upload');
            $table->string('pertamasertifikat')->default('belum di upload');
            $table->string('pertamakwitansi')->default('belum di upload');
            $table->string('keduaktp')->default('belum di upload');
            $table->string('keduakk')->default('belum di upload');
            $table->string('keduanpwp')->default('belum di upload');
            $table->text('keterangan');
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
        Schema::dropIfExists('peralihanjualbeli');
    }
}
