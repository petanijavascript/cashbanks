<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'm_menu';
    protected $primaryKey = 'menu_id'; 
    protected $fillable = ['menu_id','name','parent_menu_id','child_no','app_id','group_user_id','link_to','icon','created_at','created_by','updated_at','updated_by'];
 
}
