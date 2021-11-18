<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratkuasamenjualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratkuasamenjual', function (Blueprint $table) {
             $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('ktp_pemberi_kuasa')->default('belum di upload');
            $table->string('ktp_penerima_kuasa')->default('belum di upload');
            $table->string('fotokopi_sertifikat')->default('belum di upload');
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
        Schema::dropIfExists('suratkuasamenjual');
    }
}
