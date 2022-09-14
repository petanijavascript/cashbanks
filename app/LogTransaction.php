<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    protected $table = 'log_transaction';
    protected $primaryKey = 'log_id'; 
    protected $fillable =  ['log_id','username','project_id','activity_type','detail','report_year','report_month','report_week','report_target_date','report_send_date','tr_id','created_at','created_by'];
 
}
