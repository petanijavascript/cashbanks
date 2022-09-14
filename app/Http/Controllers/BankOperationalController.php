<?php

namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BankLoan;
use App\BankOperational;
use App\Escrow;
use App\Bank;
use App\BankAccount;
use App\Project; 
use App\User; 
use App\LogReportEmail; 
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
use Mail;
use DateTime;
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\CashBankController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EscrowController; 
use App\Http\Controllers\BankLoanController;
use App\Http\Controllers\BankDKController;


class BankOperationalController extends Controller
{

    public function index()
	{ 
        if(!$this->accessMenuAuthorization("Tr Bank Operational")){ 
             return view('errors.403');
        }  
        $listProject = $this->getListProjectSelectedUser();
        $listBank = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::orderBy('account_no')->get();  
        //get list bank account per project only 
            $projectID = $listProject[0]->project_id;
            $listBankAccount = BankAccount::where([['project_id','=',$projectID],['transaction_type','=','bank_operational'],['aktif','=','1']])->orderBy('account_no')->get();  
    
        $nowYear = date("Y");
        $hariini = date('Y-m-d');
        $datetoprint = date("d-m-Y", strtotime($hariini));
        $nowMonthNumber = substr($datetoprint, 3, -5);
        
        switch($nowMonthNumber)
        {
            case 1 : $nowMonthString = "January";
            break;
            case 2 : $nowMonthString = "February";
            break;
            case 3 : $nowMonthString = "March";
            break;
            case 4 : $nowMonthString = "April";
            break;
            case 5 : $nowMonthString = "May";
            break;
            case 6 : $nowMonthString = "June";
            break;
            case 7 : $nowMonthString = "July";
            break;
            case 8 : $nowMonthString = "August";
            break;
            case 9 : $nowMonthString = "September";
            break;
            case 10 : $nowMonthString = "October";
            break;
            case 11 : $nowMonthString = "November";
            break;
            case 12 : $nowMonthString = "December";
            break;
        }

        // $nowYear = '2019'; 
        // $nowMonthNumber = date("m");
		// $nowMonthString = date("F");
		// $nowMonthString = 'April';
		// $nowMonthNumber = 4;
		$nowWeekNumber = 4;
        //Set week list(get all friday in month)
        $listWeek = array();
        $dateBegin = $nowYear.'-'.$nowMonthNumber.'-01';
        $dateEnd = $nowYear.'-'.$nowMonthNumber.'-' . date('t', strtotime($dateBegin)); //get end date of month
        while(strtotime($dateBegin) <= strtotime($dateEnd)) {
            $day_num = date('d', strtotime($dateBegin));
            $day_name = date('l', strtotime($dateBegin));
            $dateBegin = date("Y-m-d", strtotime("+1 day", strtotime($dateBegin)));
            if($day_name=="Friday"){
                array_push($listWeek, $day_num);
            } 
        }
		$totalValue = $this->getTotalValue("t_bank_operational", $listProject[0]->project_id, $nowYear, $nowMonthNumber, $nowWeekNumber); 
        
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'Tr Bank Operational');  
        $listTransaction = BankOperational::all();    
		return view('app/cashbank/bankoperational', compact(['totalValue','listTransaction','listProject','listBank','listBankAccount','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber']));
	}
    public function getTotal($projectID, $year, $month, $week){
        return $this->getTotalValue("t_bank_operational", $projectID, $year, $month, $week);
    }
	public function getListBankAccount($projectSelectedID){    
        return $this->getListBankAccountHTML($projectSelectedID, "bank_operational");    
    }
    public function create()
	{
		//
	} 
	public function store(Request $request)
	{   
        //get all request
        $dataRequest = array(); 
        $createdBy = Auth::user()->email;
        $listBankAccount = BankAccount::where([['project_id','=',(int)$request['project_id']],['transaction_type','=','bank_operational'],['aktif','=','1']])->get();
        foreach($listBankAccount as $b){  
            //check if user already input at the same year, month and week(duplicate data) then return message error
            $findBankOperational = BankOperational::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',$b->bank_account_id)
                                    ->where('week',(int)$request['week'])
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->get();  
            if(count($findBankOperational)>0){
                //Data has been set, delete first to replace with new value
                BankOperational::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',$b->bank_account_id)
                                    ->where('week',(int)$request['week'])
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->delete();
            }
            
            // if new data then create list to insert to db 
            array_push($dataRequest,
                array(
                    'project_id'=>$request['project_id'],
                    'bank_name'=>$request['bank_name_'.$b->bank_account_id],
                    'bank_account_id'=>$b->bank_account_id,
                    'account_no'=>$b->account_no,
                    'account_detail'=>$b->account_detail, 
                    'operational_type'=>$b->operational_type, 
                    'currency'=>$b->currency, 
                    'in'=>$request['in_'.$b->bank_account_id],
                    'out'=>$request['out_'.$b->bank_account_id],
                    'year'=>$request['year'],
                    'month'=>$request['month'],
                    'week'=>$request['week'],
                    'created_by'=>$createdBy,
                    'created_at'=>date('Y-m-d H:i:s')
                     )       
            );
            //validate input
            $this->validate($request,[ 
                'year' => "required" ,
                'month' => "required" ,
                'week' => "required" ,
                'in_'.$b->bank_account_id => "numeric" ,
                'out_'.$b->bank_account_id => "numeric" 
            ]);
        }  
        $bankOperational = BankOperational::insert($dataRequest);   
        return "Bank Operational added successfully.";  
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return BankOperational::find($id);
	}
 
	public function edit($id)
	{
		//
	}
 
	public function update(Request $request)
	{ 
        $id = $request->get('bank_operational_id'); 
        $data = BankOperational::where('bank_operational_id', $id)  
               ->get();     
        if(count($data)<0){ 
            return "Bank Operational ID Not Found ";
        } 
        $request['updated_by']=Auth::user()->email;  
        $this->validate($request,[
            'bank_account_id' => "required" ,  
            'year' => "required" ,
            'month' => "required" ,
            'week' => "required" , 
            'in' => "numeric" ,
            'out' => "numeric" 
        ]); 
        $bankAccount = BankAccount::find($request['bank_account_id']);
        $bank = Bank::find($bankAccount->bank_id); 
        $request['bank_name']=$bank->bank_name; 
        $request['account_no']=$bankAccount->account_no; 
        $request['account_detail']=$bankAccount->account_detail;  
		$input = $request->all();
        BankOperational::find($id)->update($input);  
        return "Bank Operational updated succesfully.";
	}
 
	public function destroy($bankOperationalID)
	{
        BankOperational::find($bankOperationalID)->delete();
        return "Bank Operational deleted succesfully.";
	}
    
    public function datatable(Request $request){
        $projectSelected = "";
        if($request['projectSelected']!=0){
            $projectSelected = " bankOperational.project_id = ".$request['projectSelected']; 
        } 
        $yearSelected = "";
        if($request['yearSelected']){
            $yearSelected = " AND bankOperational.year = ".$request['yearSelected']; 
        } 
        $monthSelected = "";
        if($request['monthSelected']){
            $monthSelected = " AND bankOperational.month = ".$request['monthSelected']; 
        }  
        $weekSelected = "";
        if($request['weekSelected']){
            $weekSelected = " AND bankOperational.week = ".$request['weekSelected']; 
        }  
        
        $bankOperational = DB::table('t_bank_operational AS bankOperational JOIN m_bank_account as g ON bankOperational.bank_account_id=g.bank_account_id AND g.aktif=1')->select([
            'bankOperational.bank_operational_id',  
            'bankOperational.bank_account_id', 
//            DB::raw('CONCAT(bankOperational.bank_name, " ", bankOperational.account_no, " ", bankOperational.account_detail, IFNULL(concat("(",bankOperational.operational_type,")"),"")) AS bank_account '),
//            DB::raw('CONCAT(bankOperational.bank_name, " ", bankOperational.account_no, " ", IFNULL(concat("(",bankOperational.operational_type,")"),"")) AS bank_account '), 
            DB::raw('CONCAT(bankOperational.operational_type, " (",bankOperational.currency,")") AS operational_type'), 
            DB::raw('
            case 
                when length(bankOperational.bank_name)+length(bankOperational.account_no) <20 then CONCAT(bankOperational.bank_name," ",IFNULL(bankOperational.account_no,"")," ",IFNULL(bankOperational.account_detail ,""))
                else CONCAT(bankOperational.bank_name," ",IFNULL(bankOperational.account_no,""))
            end 
            AS bank_account'),
//            DB::raw('CONCAT(bankOperational.bank_name, " ", bankOperational.account_no) AS bank_account '),
            DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out)
                    FROM t_bank_operational a 
                    WHERE a.bank_account_id = bankOperational.bank_account_id 
                    AND a.project_id = bankOperational.project_id   
                    AND 1 = 
                    CASE
                        WHEN a.year < bankOperational.year THEN 1
                        WHEN a.year = bankOperational.year THEN
                            CASE
                                WHEN a.month < bankOperational.month THEN 1
                                WHEN a.month = bankOperational.month AND a.week < bankOperational.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)
            ) 
            AS opening_balance'),
            'in',
            'out',
            DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out)
                    FROM t_bank_operational a 
                    WHERE a.bank_account_id = bankOperational.bank_account_id 
                    AND a.project_id = bankOperational.project_id   
                    AND 1 = 
                    CASE
                        WHEN a.year < bankOperational.year THEN 1
                        WHEN a.year = bankOperational.year THEN
                            CASE
                                WHEN a.month < bankOperational.month THEN 1
                                WHEN a.month = bankOperational.month AND a.week < bankOperational.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+bankOperational.in-bankOperational.out
            ) 
            AS closing_balance'),
            DB::raw("MONTHNAME(STR_TO_DATE(month, '%m'))as month"),
            'week'  
        ]) ->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected)
           ->orderBy('bankOperational.bank_name');
//            ->join('m_bank_account as c', 'bankOperational.bank_account_id', '=', 'c.bank_account_id') ->orderBy('bankOperational.month', 'desc');
          
         
        return Datatables::of($bankOperational) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit" href="#edit_modal" data-id="'.$data->bank_operational_id.'"></a><input type="hidden" class="ba_id" value="'.$data->bank_account_id.'"\></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->bank_operational_id.'" ></a></center>';   
                        })->make(true); 
    }
     
     
    public function exportFile(Request $request){  
       $operationalType = $request['operational_type'];
       return $this->exportCashbankFile($request, $operationalType);
    } 
    
    public function sendEmail(Request $request){  
        $this->sendCashbankByEmail($request); 
        return redirect('bankoperational')->with('message', 'Email Has Been Sent!'); 
    }
    
    
    public function getBankOperational($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, $operationalType){ 

			$bankOperational = DB::table('t_bank_operational AS bankOperational')->select(
            DB::raw("
                    CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail,
                    IFNULL(concat(\"(\",c.operational_type,\")\"),\"\")) AS bank_account, bankOperational.bank_account_id,
                    @opening_balance :=(   
                        IFNULL(
                            (SELECT SUM(a.in)-SUM(a.out)
                            FROM t_bank_operational a 
                            WHERE a.project_id = bankOperational.project_id  
                            AND a.bank_account_id = bankOperational.bank_account_id   
                            AND 1 = 
                            CASE 
                                WHEN a.year < ".$yearSelect."  THEN 1 
                                WHEN a.year = ".$yearSelect." THEN 
                                    CASE 
                                        WHEN a.month < ".$monthSelect."  THEN 1 
                                        WHEN a.month = ".$monthSelect."  
                                            AND a.week < ".$startWeek." THEN 1  
                                        ELSE  0 
                                    END 
                            END)
                        ,0)
                    ) AS opening_balance, 
                    @in_ :=(SELECT sum(b.in) FROM t_bank_operational b WHERE 
                        b.project_id = bankOperational.project_id  
                        AND b.bank_account_id = bankOperational.bank_account_id 
                        AND b.year = ".$yearSelect." 
                        AND b.month = ".$monthSelect." 
                        AND b.week BETWEEN ".$startWeek." AND ".$endWeek." 
                    ) AS in_,
                    @out_ :=(SELECT sum(c.out) FROM t_bank_operational c WHERE        
                        c.project_id = bankOperational.project_id  
                        AND c.bank_account_id = bankOperational.bank_account_id  
                        AND c.year = ".$yearSelect." 
                        AND c.month = ".$monthSelect." 
                        AND c.week BETWEEN ".$startWeek." AND ".$endWeek.") AS out_,
                    (   
                        IFNULL(ROUND(@opening_balance,2),0)
                        +
                        IFNULL(round(@in_,2),0)
                        -
                        IFNULL(round(@out_,2),0)
                    )  AS closing_balance,
                    bankOperational.currency,
                    bankOperational.operational_type,
                    CONCAT(bankOperational.bank_name, \" \", bankOperational.account_no) AS bank_account_report
                ")         
            ) 
			->join('m_bank_account as c', 'bankOperational.bank_account_id', '=', 'c.bank_account_id')
			->Leftjoin('m_bank as d', 'c.bank_id', '=', 'd.bank_id')
            ->whereRaw("c.aktif='1'
						AND bankOperational.project_id = ".$projectSelect." 
                        AND c.operational_type = '".$operationalType."'  
                        AND 1 = 
                        CASE
                            WHEN bankOperational.year < ".$yearSelect."  THEN 1 
                            WHEN bankOperational.year = ".$yearSelect." THEN 
                                CASE 
                                    WHEN bankOperational.month < ".$monthSelect."  THEN 1 
                                    WHEN bankOperational.month = ".$monthSelect."  
                                        AND (bankOperational.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    ELSE  0 
                                END 
                        END  ")
            ->groupBy('bankOperational.bank_account_id') 
            ->orderBy('bankOperational.bank_name') 
            ->get();
			
			// $bankOperational = DB::table('t_bank_operational AS bankOperational')->select(
            // DB::raw("
                    // CONCAT(bankOperational.bank_name, \" \", bankOperational.account_no, \" \", bankOperational.account_detail,
                    // IFNULL(concat(\"(\",bankOperational.operational_type,\")\"),\"\")) AS bank_account, bankOperational.bank_account_id,
                    // @opening_balance :=(   
                        // IFNULL(
                            // (SELECT SUM(a.in)-SUM(a.out)
                            // FROM t_bank_operational a 
                            // WHERE a.project_id = bankOperational.project_id  
                            // AND a.bank_account_id = bankOperational.bank_account_id   
                            // AND a.operational_type = '".$operationalType."'  
                            // AND 1 = 
                            // CASE 
                                // WHEN a.year < ".$yearSelect."  THEN 1 
                                // WHEN a.year = ".$yearSelect." THEN 
                                    // CASE 
                                        // WHEN a.month < ".$monthSelect."  THEN 1 
                                        // WHEN a.month = ".$monthSelect."  
                                            // AND a.week < ".$startWeek." THEN 1  
                                        // ELSE  0 
                                    // END 
                            // END)
                        // ,0)
                    // ) AS opening_balance, 
                    // @in_ :=(SELECT sum(b.in) FROM t_bank_operational b WHERE 
                        // b.project_id = bankOperational.project_id  
                        // AND b.bank_account_id = bankOperational.bank_account_id 
                        // AND b.operational_type = '".$operationalType."'  
                        // AND b.year = ".$yearSelect." 
                        // AND b.month = ".$monthSelect." 
                        // AND b.week BETWEEN ".$startWeek." AND ".$endWeek." 
                    // ) AS in_,
                    // @out_ :=(SELECT sum(c.out) FROM t_bank_operational c WHERE        
                        // c.project_id = bankOperational.project_id  
                        // AND c.bank_account_id = bankOperational.bank_account_id  
                        // AND c.operational_type = '".$operationalType."'  
                        // AND c.year = ".$yearSelect." 
                        // AND c.month = ".$monthSelect." 
                        // AND c.week BETWEEN ".$startWeek." AND ".$endWeek.") AS out_,
                    // (   
                        // IFNULL(ROUND(@opening_balance,2),0)
                        // +
                        // IFNULL(round(@in_,2),0)
                        // -
                        // IFNULL(round(@out_,2),0)
                    // )  AS closing_balance,
                    // bankOperational.currency,
                    // bankOperational.operational_type,
                    // CONCAT(bankOperational.bank_name, \" \", bankOperational.account_no) AS bank_account_report
                // ")         
            // ) 
			// ->join('m_bank_account as c', 'bankOperational.bank_account_id', '=', 'c.bank_account_id')
            // ->whereRaw("c.aktif='1'
						// AND bankOperational.project_id = ".$projectSelect." 
                        // AND bankOperational.operational_type = '".$operationalType."'  
                        // AND 1 = 
                        // CASE
                            // WHEN bankOperational.year < ".$yearSelect."  THEN 1 
                            // WHEN bankOperational.year = ".$yearSelect." THEN 
                                // CASE 
                                    // WHEN bankOperational.month < ".$monthSelect."  THEN 1 
                                    // WHEN bankOperational.month = ".$monthSelect."  
                                        // AND (bankOperational.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    // ELSE  0 
                                // END 
                        // END  ")
            // ->groupBy('bankOperational.bank_account_id') 
            // ->orderBy('bankOperational.bank_name') 
            // ->get();
		
        return $bankOperational;
    }
     
     
    
    public function autocompleteEmail(Request $request)
    { 
        $data = User::select("email as name")->where("email","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    } 
}

