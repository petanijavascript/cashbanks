<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBank extends Model
{
    protected $table = 't_cashbank';
    protected $primaryKey = 'cashbank_id'; 
    protected $fillable = ['cashbank_id','project_id','pt_id','bank_account_id','bank_name','account_no','account_detail','currency','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
