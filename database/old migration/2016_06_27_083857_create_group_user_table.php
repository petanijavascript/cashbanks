<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_group_user', function (Blueprint $table) {
            $table->increments('group_user_id');
            $table->string('group_code');
            $table->string('group_detail');
            $table->boolean('is_active_record')->default(1);
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
        Schema::drop('m_group_user');
    }
}
