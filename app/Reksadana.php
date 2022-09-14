<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reksadana extends Model
{
   protected $table = 't_reksadana';
   protected $primaryKey = 'reksadana_id'; 
   protected $fillable = ['reksadana_id','project_id','pt_id','bank_account_id','bank_name','account_no','account_detail','currency','percent_reksadana','reksadana_type','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
