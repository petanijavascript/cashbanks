<?php

namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BankAccount;
use App\Bank;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;

class BankAccountController extends Controller
{
    public function index()
	{ 
        if(!$this->accessMenuAuthorization('Bank Account')){ 
             return view('errors.403');
        }
        $listBank = Bank::orderBy('bank_name')->get();     
        $listProject = $this->getListProjectSelectedUser();
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Bank Account');  
        $listBankAccount = BankAccount::all();    
		return view('master/bankaccount', compact(['listProject','listBankAccount','listBank']));
        
	}
    public function create()
	{
		//
	} 
	public function store(Request $request)
	{ 
        $request['created_by']=Auth::user()->email; 
        if($request['transaction_type']=="cashbank"){
            $request['operational_type']=null;
            $request['deposit_type']=null;
        }
        else if($request['transaction_type']=="deposit"){
            $request['operational_type']=null; 
        }
        else if($request['transaction_type']=="bank_operational"){ 
            $request['deposit_type']=null;
        }
	    $input = $request->all();
        $this->validate($request,[
            'bank_id' => "required" , 
//            'account_no' => "unique:m_bank_account" , 
            'project_id' => "required",   
            'transaction_type' => "required"   
        ]);
        
        $bankAccount = BankAccount::create($input);
        return "Bank Account added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return BankAccount::find($id);
	}
    
	public function edit($id)
	{
		//
	}
    
	public function update(Request $request)
	{
        $request['updated_by']=Auth::user()->email;  
        if($request['transaction_type']=="cashbank"){
            $request['operational_type']=null;
            $request['deposit_type']=null;
        }
        else if($request['transaction_type']=="deposit"){
            $request['operational_type']=null; 
        }
        else if($request['transaction_type']=="bank_operational"){ 
            $request['deposit_type']=null;
        }
		$input = $request->all();
        $this->validate($request,[
            'bank_id' => "required" , 
            'project_id' => "required",   
            'transaction_type' => "required"                                  
        ]);
        $id = $request->get('bank_account_id');
        BankAccount::find($id)->update($input);  
        return "Bank Account updated successfully."; 
	}
 
	public function destroy($bankAccountID)
	{ 
		$transactionType = DB::table('m_bank_account')->where('bank_account_id', $bankAccountID)->pluck('transaction_type')[0];  
		$tableName="";
		if($transactionType == "cashbank"){
			$tableName = "t_cashbank"; 
		} else if($transactionType == "deposit"){
			$tableName = "t_deposit";
		} else if($transactionType == "escrow"){
			$tableName = "t_escrow"; 
		} else if($transactionType == "bank_loan"){
			$tableName = "t_bankloan"; 
		} else if($transactionType == "bank_operational"){
			$tableName = "t_bank_operational"; 
		} else if($transactionType == "bank_dk"){
			$tableName = "t_bank_dk"; 
		}
		 
		$closingBalance =  
		DB::table($tableName.' as tr')->select([
			DB::raw('
					IFNULL(
						SUM(tr.in)-SUM(tr.out) 
						,0
					) as closing
				')
		])->whereRaw('bank_account_id ='.$bankAccountID)->get();
		
		if($closingBalance[0]->closing>0){ 
			return "Tidak dapat hapus bank account dikarenakan transaksi masih berjalan atau tidak 0.";
		}
		
        BankAccount::find($bankAccountID)->delete();
        return "Bank Account deleted successfully.";
	}
    
    public function datatable(Request $request){
        $projectSelected = "1";
        if($request['projectSelected']!=0){
            $projectSelected = " bankAccount.project_id = ".$request['projectSelected']; 
        } 
        $transactionType = "";
        if($request['transactionType']!=""){
            $transactionType = " AND bankAccount.transaction_type = '".$request['transactionType']."'"; 
        } 
        $bankAccount = DB::table('m_bank_account AS bankAccount')->select([
            'bankAccount.bank_account_id', 
             DB::raw('CONCAT(bank.bank_name, " ", IFNULL(concat("(",bankAccount.operational_type,")"),""), " ", IFNULL(concat("(",bankAccount.deposit_type,")"),""), " ", IFNULL(concat("(",bankAccount.currency,")"),"")) AS bank_name '),  
            'bankAccount.account_no',
            'bankAccount.account_detail' 
        ])->join('m_bank as bank', 'bank.bank_id', '=', 'bankAccount.bank_id')
          ->whereRaw($projectSelected.$transactionType);
        return Datatables::of($bankAccount) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit" href="#edit_modal" data-id="'.$data->bank_account_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->bank_account_id.'" ></a></center>';  
                        })->make(true); 
    }
    
public function exportFile(Request $request){    
        
        $exportType         = $request['type_export'];  
        $project            = $request['project'];
        $transactionType    = $request['transaction_type'];
        $creator            = Auth::user()->email; 
        $listBankAccount = DB::table('m_bank_account as bankAccount')->select('bank_name','account_no','account_detail')->join('m_bank as bank', 'bankAccount.bank_id', '=', 'bank.bank_id')->where([['project_id','=', $project],['transaction_type','=',$transactionType]])->get(); 
         
        if($exportType == "excel"){  
            $report = array();
                Excel::create('List Bank Account', function($excel) use($report,$creator,$listBankAccount) {
                    $excel->setTitle('List Bank Account');  
                    $excel->setCreator($creator)
                          ->setCompany('Ciputra'); 
                    $excel->setDescription('Bank Account List Data');
                    $excel->sheet('Sheet 1', function($sheet) use($report,$creator,$listBankAccount) {  
                        foreach ($listBankAccount as $c) {   
                            $report[] = (array)$c; 
                        }    
//                        dd($report); 
                        
                        $sheet->setFontFamily('Comic Sans MS');  
                       
                        $sheet->setStyle(array(
                            'font' => array(
                                'name'      =>  'Calibri',
                                'size'      =>  12 
                            )
                        ));   
                        $sheet->fromArray($report, null, 'B3', true);
                        $sheet->row(2, function($row) { 
                            $row->setBackground('#000000'); 
                        });   
                    }); 
                })->export('xls'); 
            return true;
        } else{  
            return view('master/bankaccountprintreport', compact(['listBankAccount'])); 
        }
    }  
}
