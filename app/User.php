<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
 
	protected $table = 'm_user';
 
	protected $fillable = ['username','password','first_name','last_name','email','group_user_id','is_active_record','created_at','created_by','updated_at','updated_by','list_project'];
      
	protected $hidden = ['password', 'remember_token'];

    protected $primaryKey = 'user_id';
}
