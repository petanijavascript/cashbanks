<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pt', function (Blueprint $table) {
            $table->increments('pt_id');
            $table->string('pt_proyek');
            $table->string('pt_pt');
            $table->string('pt_nama');
            $table->string('pt_proyek_nama');
            $table->integer('flag_id');
            $table->string('user_tambah'); 
            $table->string('user_ubah')->nullable(); 
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
        Schema::drop('pt');
    }
}
