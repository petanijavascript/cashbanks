<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProject extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_project', function(Blueprint $table)
		{
			$table->increments('project_id');
            $table->string('project_code')->nullable();
            $table->string('project_name');
            $table->string('project_location'); 
            $table->string('project_location_group');   
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
		Schema::drop('m_project');
	}

}
