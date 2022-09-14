<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escrow extends Model
{
    protected $table = 't_escrow';
    protected $primaryKey = 'escrow_id'; 
    protected $fillable = ['escrow_id','project_id','pt_id','bank_account_id','bank_name','account_no','account_detail','opening_balance','in','out','closing_balance','year','month','week','created_at','created_by','updated_at','updated_by'];
}
