<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model {

	protected $table = 'm_group_user';
    protected $primaryKey = 'group_user_id'; 
    protected $fillable = ['group_user_id','group_code','group_detail','is_active_record','created_at','created_by','updated_at','updated_by'];

   	 


}
