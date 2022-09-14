<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_bank_account', function (Blueprint $table) {
            $table->increments('bank_account_id');
            $table->integer('bank_id');
            $table->string('account_no')->nullable(); 
            $table->string('account_detail')->nullable(); 
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
        Schema::drop('m_bank_account');
    }
}
