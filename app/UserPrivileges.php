<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivileges extends Model {

	protected $table = 'm_user_privileges';
    protected $primaryKey = 'user_privileges_id'; 
    protected $fillable = ['user_privileges_id','menu_id','group_user_id','view_data','crud_access','created_at','created_by','updated_at','updated_by'];
 

}
