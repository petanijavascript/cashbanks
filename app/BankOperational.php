<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankOperational extends Model
{
   protected $table = 't_bank_operational';
   protected $primaryKey = 'bank_operational_id'; 
   protected $fillable = ['bank_operational_id','project_id','pt_id','bank_account_id','bank_name','account_no','account_detail','currency','operational_type','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
