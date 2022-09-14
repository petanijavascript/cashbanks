<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_menu', function(Blueprint $table)
		{
			$table->increments('menu_id');
            $table->string('name');
            $table->integer('parent_menu_id')->nullable();
            $table->integer('child_no')->nullable();
            $table->integer('app_id');
            $table->integer('group_user_id');
            $table->string('link_to');
            $table->string('icon');
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
		Schema::drop('m_menu');
	}

}
