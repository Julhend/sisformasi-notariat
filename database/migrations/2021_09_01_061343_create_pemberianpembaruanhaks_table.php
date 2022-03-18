<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemberianpembaruanhaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemberianpembaruanhaks', function (Blueprint $table) {
              $table->increments('id');
            $table->string('jenis_pengajuan');
            $table->date('tgl_pengajuan');
            $table->string('akta')->nullable();
            $table->string('ktp')->default('belum di upload');
            $table->string('kk')->default('belum di upload');
            $table->string('sertifikat')->default('belum di upload');
            $table->string('pbb')->default('belum di upload');
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
        Schema::dropIfExists('pemberianpembaruanhaks');
    }
}
