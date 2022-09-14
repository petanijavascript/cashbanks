<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'm_bank_account';
    protected $primaryKey = 'bank_account_id'; 
    protected $fillable = ['bank_account_id','bank_id','project_id','account_no','account_detail','currency','transaction_type','operational_type','deposit_type','created_at','created_by','updated_at','updated_by','aktif'];
}
