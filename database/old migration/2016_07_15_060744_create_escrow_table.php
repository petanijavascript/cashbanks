<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_escrow', function (Blueprint $table) {
            $table->increments('escrow_id');
            $table->integer('project_id')->nullable(); 
            $table->integer('pt_id')->nullable(); 
            $table->integer('bank_account_id');
            $table->decimal('opening_balance',20,2);
            $table->decimal('in',20,2)->nullable(); 
            $table->decimal('out',20,2)->nullable(); 
            $table->decimal('closing_balance',20,2)->nullable();  
            $table->dateTime('date_transaction');
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
        Schema::drop('t_escrow');
    }
}
