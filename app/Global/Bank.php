<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table = 'm_bank';
    protected $primaryKey = 'bank_id'; 
    protected $fillable = ['bank_id','bank_name','description','created_at','created_by','updated_at','updated_by'];
}
