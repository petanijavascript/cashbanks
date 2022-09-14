<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportSummary extends Model
{
    protected $table = 't_deposit';
    protected $primaryKey = 'deposit_id'; 
    protected $fillable = ['deposit_id','project_id','bank_account_id','bank_name','account_no','account_detail','percent_deposit','deposit_type','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
