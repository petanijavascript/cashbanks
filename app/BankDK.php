<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDK extends Model
{
    protected $table = 't_bank_dk';
    protected $primaryKey = 'bank_dk_id'; 
    protected $fillable = ['bank_dk_id','project_id','pt_id','bank_account_id','bank_name','account_no','account_detail','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
