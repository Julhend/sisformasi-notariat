<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahFieldUserid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peralihanjualbeli', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('peralihanhibah', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('peralihanwaris', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('peralihanlelang', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('suratkuasamenjual', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('suratwaris', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('formatsurat', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('pemberianpembaruanhaks', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('penghapusanhaks', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
         Schema::table('tanda_terima', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
