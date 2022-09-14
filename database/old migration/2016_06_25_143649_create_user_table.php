<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_user', function(Blueprint $table)
		{
			$table->increments('user_id');
			$table->string('username');
			$table->string('password', 60);
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->integer('group_user_id');
			$table->boolean('is_active_record')->default(1);
			$table->string('remember_token');
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
		Schema::drop('m_user');
	}

}
