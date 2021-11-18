<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahForeignKeyConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peralihanjualbeli', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('peralihanhibah', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('peralihanwaris', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('peralihanlelang', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('suratkuasamenjual', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('suratwaris', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('formatsurat', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('pemberianpembaruanhaks', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('penghapusanhaks', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('tanda_terima', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
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
