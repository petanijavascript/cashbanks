<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportWeekly extends Model
{
    protected $table = 'm_report_weekly';
    protected $primaryKey = 'rw_id'; 
    protected $fillable = ['rw_id', 'project_id','mail_to','cc','created_at','created_by','updated_at','updated_by'];

    public function detailData($id)
    {
        return DB::table('m_report_weekly')->where('project_id', $id)->first();
    }
 
}
