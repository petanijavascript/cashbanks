<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPrivilegesMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user_privileges', function (Blueprint $table) {
            $table->increments('user_privileges_id');
            $table->integer('menu_id');
            $table->integer('group_user_id');
            $table->boolean('view_data')->default(1);
            $table->boolean('crud_access')->default(0);
            $table->string('created_by');   
            $table->string('updated_by')->nullable();  
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
        Schema::drop('m_user_privileges');
    }
}
