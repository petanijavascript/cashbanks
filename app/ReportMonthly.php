<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMonthly extends Model
{
    protected $table = 'm_report_monthly';
    protected $primaryKey = 'report_id'; 
    protected $fillable = ['report_id', 'project_id','mail_to','cc','created_at','created_by','updated_at','updated_by'];
 
}
