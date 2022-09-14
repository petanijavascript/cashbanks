<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Datatables; 
use Auth;
use App\LogTransaction;
use DB;

class LogReportController extends Controller {
 
	public function index()
	{   
        if(!$this->accessMenuAuthorization("Log Transaction")){ 
             return view('errors.403');
        } 
        $listProject = $this->getListProjectSelectedUser();
        $listLogReport = LogTransaction::all();   
        $nowMonthString = date("F"); 
        $nowMonthNumber = date("m");
        $nowYear = date("Y"); 
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'Log Transaction'); 
		return view('app/cashbank/logtransaction', compact('listLogReport','listProject','nowMonthString','nowMonthNumber','nowYear'));
	}
    public function create()
	{	//
	} 
	 
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return LogTransaction::find($id);
	}
  
  
    public function datatable(Request $request){
        $projectSelected = "1";
        if($request['projectSelected']!=0){
            $projectSelected = " logTR.project_id = ".$request['projectSelected']; 
        } 
//        $monthSelected = "";
//        if($request['monthSelected']){
//            $monthSelected = " AND logReportEmail.month = ".$request['monthSelected']; 
//        }
//        $yearSelected = "";
//        if($request['yearSelected']){
//            $yearSelected = " AND logReportEmail.year = ".$request['yearSelected']; 
//        } 
        
        
        $LogTransaction = DB::table('log_transaction AS logTR')->select([ 
            'logTR.username AS user',
            DB::raw('CONCAT(project.pt_name, ", ", project.project_name) AS project '),  
            'logTR.project_id',
            'logTR.activity_type',
            'logTR.tr_id',
            'logTR.detail' ,
            DB::raw('DATE_FORMAT(logTR.created_at,\'%d %M %Y %h:%i %p\') AS created_at') 
        ])  ->join('m_project AS project', 'project.project_id', '=', 'logTR.project_id') 
            ->whereRaw($projectSelected)
//            ->whereRaw($projectSelected.$monthSelected.$yearSelected)
            ->orderBy('log_id','DESC');

        return Datatables::of($LogTransaction)->make(true); 
    }
    
    


}
