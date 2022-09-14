<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{ 
    protected $table = 't_user_project';
    protected $primaryKey = 'user_project_id'; 
    protected $fillable = ['user_project_id','user_id','group_user_id','project_id','pt_id','created_at','created_by','updated_at','updated_by'];
}
