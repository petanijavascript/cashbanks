<?php

namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ReportWeekly;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;

class ReportWeeklyController extends Controller
{

    public function index()
	{ 
        if(!$this->accessMenuAuthorization('Report Weekly Setting')){ 
             return view('errors.403');
        }     
        $listProject = $this->getListProjectSelectedUser();
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Report Weekly Setting');  
		return view('master/reportweekly', compact(['listProject']));
        
	}

	public function store(Request $request)
	{ 
        $request['created_by']=Auth::user()->email; 
        
	    $input = $request->all();
        $this->validate($request,[
            'project_id' => "required" ,  
            'mail_to' => "required",   
            'cc' => "required"   
        ]);
        
        $reportWeekly = ReportWeekly::create($input);
        return "Report Weekly added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return ReportWeekly::find($id);
	}

    public function detailsender(Request $request)
    {
        $id = $request->get('id');
        $reportweekly = ReportWeekly::where('project_id', $id)->first();
        return ($reportweekly!='') ? $reportweekly : '';
    }
    
	public function update(Request $request)
	{
        $request['updated_by']=Auth::user()->email; 

		$input = $request->all();
        $this->validate($request,[
            'project_id' => "required" , 
            'mail_to' => "required",   
            'cc' => "required"                                  
        ]);
        $id = $request->get('rw_id');
        ReportWeekly::find($id)->update($input);  
        return "Report Weekly updated successfully."; 
	}
 
	public function destroy($rwID)
	{ 	
        ReportWeekly::find($rwID)->delete();
        return "Report Weekly deleted successfully.";
	}
    
    public function datatable(Request $request){
        
        $reportWeekly = DB::table('vm_report_weekly')
        ->orderBy('projectname', 'asc');
        return Datatables::of($reportWeekly) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit" href="#edit_modal" data-id="'.$data->rw_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->rw_id.'" ></a></center>';  
                        })->make(true); 
    }
    
// public function exportFile(Request $request){    
        
//         $exportType         = $request['type_export'];  
//         $project            = $request['project'];
//         $transactionType    = $request['transaction_type'];
//         $creator            = Auth::user()->email; 
//         $listBankAccount = DB::table('m_bank_account as bankAccount')->select('bank_name','account_no','account_detail')->join('m_bank as bank', 'bankAccount.bank_id', '=', 'bank.bank_id')->where([['project_id','=', $project],['transaction_type','=',$transactionType]])->get(); 
         
//         if($exportType == "excel"){  
//             $report = array();
//                 Excel::create('List Bank Account', function($excel) use($report,$creator,$listBankAccount) {
//                     $excel->setTitle('List Bank Account');  
//                     $excel->setCreator($creator)
//                           ->setCompany('Ciputra'); 
//                     $excel->setDescription('Bank Account List Data');
//                     $excel->sheet('Sheet 1', function($sheet) use($report,$creator,$listBankAccount) {  
//                         foreach ($listBankAccount as $c) {   
//                             $report[] = (array)$c; 
//                         }    
// //                        dd($report); 
                        
//                         $sheet->setFontFamily('Comic Sans MS');  
                       
//                         $sheet->setStyle(array(
//                             'font' => array(
//                                 'name'      =>  'Calibri',
//                                 'size'      =>  12 
//                             )
//                         ));   
//                         $sheet->fromArray($report, null, 'B3', true);
//                         $sheet->row(2, function($row) { 
//                             $row->setBackground('#000000'); 
//                         });   
//                     }); 
//                 })->export('xls'); 
//             return true;
//         } else{  
//             return view('master/bankaccountprintreport', compact(['listBankAccount'])); 
//         }
//     }  
}
