<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashbankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cashbank', function (Blueprint $table) {
            $table->increments('cashbank_id');
            $table->integer('project_id')->nullable(); 
            $table->integer('pt_id')->nullable(); 
            $table->integer('bank_account_id');
            $table->decimal('opening_balance',20,2);
            $table->decimal('in',20,2)->nullable(); 
            $table->decimal('out',20,2)->nullable(); 
            $table->decimal('closing_balance',20,2)->nullable(); 
            $table->string('account_type');
            $table->dateTime('date_transaction');
            $table->string('created_by');   
            $table->string('updated_by')->nullable();  
			$table->timestamps();
        });
    }
/////////////////////blom set default ke 0
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_cashbank');
    }
}
