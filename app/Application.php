<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'm_application';
    protected $primaryKey = 'app_id'; 
    protected $fillable = ['app_id','name','description','created_at','created_by','updated_at','updated_by'];
}
