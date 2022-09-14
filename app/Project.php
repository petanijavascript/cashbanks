<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $table = 'm_project';
    protected $primaryKey = 'project_id'; 
    protected $fillable = ['project_id','project_code','pt_name','project_name','project_location','project_location_group','created_at','created_by','updated_at','updated_by'];
 

}
