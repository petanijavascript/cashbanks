<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUserProjecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_user_project', function (Blueprint $table) {
            $table->increments('user_project_id');
            $table->integer('user_id');
            $table->integer('group_user_id');
            $table->integer('project_id')->nullable();  
            $table->integer('pt_id')->nullable();  
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
        Schema::drop('t_user_project');
    }
}
