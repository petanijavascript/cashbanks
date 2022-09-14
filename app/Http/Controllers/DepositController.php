<?php


namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Deposit;
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
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\CashBankController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\BankOperationalController;
use App\Http\Controllers\BankLoanController;
use App\Http\Controllers\BankDKController;

class DepositController extends Controller
{
    public function index()
	{  
        // ini_set('max_execution_time', 0);
        ini_set('memory_limit','2048M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
        // ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
        // ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv

        if(!$this->accessMenuAuthorization("Tr Deposit")){ 
             return view('errors.403');
        } 
        $listProject = $this->getListProjectSelectedUser();
        $listBank = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::orderBy('account_no')->get();   
        // get list bank account per project only 
            $projectID = $listProject[0]->project_id;
            $listBankAccount = BankAccount::where([['project_id','=',$projectID],['transaction_type','=','deposit'],['aktif','=','1']])->orderBy('account_no')->get();  
    
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
        // $nowMonthString = date("F");
        // $nowMonthNumber = date("m");
		// $nowMonthString = 'April';
		// $nowMonthNumber = 4;
        $nowWeekNumber = 4;
        $ddate = date("Y-m-d");
		// $firstOfMonth = date("Y-m-01");
    	// $nowWeekNumber = intval(date("W", $ddate)) - intval(date("W", $firstOfMonth)) + 1;
        $duedt = explode("-", $ddate);
        $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        // $nowWeekNumber = (int)date('W', $date);
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

        $lastWeek = $nowWeekNumber-1;
        if($lastWeek<0) { $lastWeek=1;}
        //14 Jan 2019
		// $totalValue = $this->getTotalValue("t_deposit", $listProject[0]->project_id, $nowYear, $nowMonthNumber, 1); 
        // $latestDepositRate = $this->getLatestDepositRate($projectID, $nowYear, $nowMonthNumber, 1); 
        
        $totalValue = $this->getTotalValue("t_deposit", $listProject[0]->project_id, $nowYear, $nowMonthNumber, $nowWeekNumber);
        $latestDepositRate = $this->getLatestDepositRate($projectID, $nowYear, $nowMonthNumber, $nowWeekNumber); 
        $listTransaction = Deposit::all();    
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'Tr Deposit');  
		return view('app/cashbank/deposit', compact(['latestDepositRate','totalValue','listTransaction','listProject','listBank','listBankAccount','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber']));
	}
    public function getTotal($projectID, $year, $month, $week){
        return $this->getTotalValue("t_deposit", $projectID, $year, $month, $week);
    }
    public function getListBankAccount(Request $request){      
        $projectSelected    = $request['projectSelected'];
        $yearSelected       = $request['yearSelected'];
        $monthSelected      = $request['monthSelected'];
        $weekSelected       = $request['weekSelected'];   
        return $this->getListBankAccountHTMLDeposit($projectSelected, "deposit", $yearSelected, $monthSelected, $weekSelected);   
    }
	public function getLatestDepositRate($projectID, $year, $month, $week){   
		//$projectID =83;
        $result = DB::table('t_deposit AS deposit')->select([ 
            'year',
            'month',
            'week'
          ])->whereRaw('project_id ='.$projectID.' AND (year < '.$year.' or (year = '.$year.' AND (month < '.$month.' OR (month = '.$month.' AND week <='.$week.' ))))')
            ->groupBy('year','month','week')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('week', 'desc')
            ->take(1)
            ->get();
		if($result){
			$latestYear  = $result[0]->year;
			$latestMonth = $result[0]->month;
			$latestWeek  = $result[0]->week;
			//dd($result);
			//get value
			$result = DB::table('t_deposit AS deposit')->select([ 
						'bank_account_id as bankAccountID',
						'percent_deposit as rate'
					 ])->whereRaw('project_id ='.$projectID.' AND year ='.$latestYear.' AND month ='.$latestMonth.' AND week ='.$latestWeek)->get();
       
        //dd($result);
		}
        return $result; 
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
        $listBank = BankAccount::where([['project_id','=',(int)$request['project_id']],['transaction_type','=','deposit']])->get();
        foreach($listBank as $b){  
            //check if user already input at the same year, month and week(duplicate data)  
            $findDeposit = Deposit::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',(int)$b->bank_account_id) 
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->get();   
            if(count($findDeposit)>0){
                //Data has been set, delete first to replace with new value
                Deposit::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',(int)$b->bank_account_id) 
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->delete();   
            }
            
            if($request['percent_deposit_'.$b->bank_account_id]==""){
                $request['percent_deposit_'.$b->bank_account_id] = 0;
            }
            
            // if new data then create list to insert to db 
            array_push($dataRequest,
                array(
                    'project_id'        =>$request['project_id'],
                    'bank_name'         =>$request['bank_name_'.$b->bank_account_id],
                    'bank_account_id'   =>$b->bank_account_id,
                    'account_no'        =>$b->account_no,
                    'account_detail'    =>$b->account_detail, 
                    'percent_deposit'   =>$request['percent_deposit_'.$b->bank_account_id], 
                    'deposit_type'      =>$b->deposit_type, 
                    'currency'          =>$b->currency, 
                    'in'                =>$request['in_'.$b->bank_account_id],
                    'out'               =>$request['out_'.$b->bank_account_id],
                    'year'              =>$request['year'],
                    'month'             =>$request['month'],
                    'week'              =>$request['week'],
                    'created_by'        =>$createdBy,
                    'created_at'        =>date('Y-m-d H:i:s')
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
        $deposit = Deposit::insert($dataRequest);   
        return "Deposit added successfully."; 
	}
    public function storedoc(Request $request)
	{ 
        $createdBy = Auth::user()->email;
        $bankAccount = BankAccount::find($request['bank_account_id']);
        $bank = Bank::find($bankAccount->bank_id); 
        $request['bank_name']=$bank->bank_name; 
        $request['account_no']=$bankAccount->account_no; 
        $request['account_detail']=$bankAccount->account_detail; 
        $request['deposit_type']="deposit"; 
        
        $input = $request->all();
        $this->validate($request,[
            'bank_account_id' => "required" ,  
            'year' => "required" ,
            'month' => "required" ,
            'week' => "required" ,  
            'in' => "numeric" ,
            'out' => "numeric" 
        ]); 
        Deposit::create($input);   
        return "Deposit created succesfully.";
    }
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Deposit::find($id);
	}
 
	public function edit($id)
	{
		//
	}
 
	public function update(Request $request)
	{ 
        $id = $request->get('deposit_id'); 
        $data = Deposit::where('deposit_id', $id)  
               ->get();     
        if(count($data)<0){ 
            return "Deposit ID Not Found ";
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
        $request['bank_name']       =$bank->bank_name; 
        $request['account_no']      =$bankAccount->account_no; 
        $request['account_detail']  =$bankAccount->account_detail;  
        $request['currency']        =$bankAccount->currency;  
		$input = $request->all();
        Deposit::find($id)->update($input);   
        return "Deposit updated succesfully.";
	}
 
	public function destroy($depositID)
	{
        Deposit::find($depositID)->delete();
        return "Deposit deleted succesfully.";
	}
    
    public function datatable(Request $request){

        $projectSelected = "";
        if($request['projectSelected']!=0){
            $projectSelected = " deposit.project_id = ".$request['projectSelected']; 
        } 
        $yearSelected = "";
        if($request['yearSelected']){
            $yearSelected = " AND deposit.year = ".$request['yearSelected']; 
        }
        $monthSelected = "";
        if($request['monthSelected']){
            $monthSelected = " AND deposit.month = ".$request['monthSelected']; 
        }
        $weekSelected = "";
        if($request['weekSelected']){
            $weekSelected = " AND deposit.week = ".$request['weekSelected']; 
        }  
        
        $deposit = DB::table('t_deposit AS deposit')->select([
            'deposit_id',  
            'deposit.bank_account_id', 
            DB::raw('CONCAT(deposit.deposit_type, "(", deposit.currency, ")") AS deposit_type'),  
			DB::raw('CONCAT(percent_deposit, " %") AS percent_deposit '),
            DB::raw('
            case 
                when length(deposit.bank_name)+length(deposit.account_no) <20 then CONCAT(deposit.bank_name," ",IFNULL(deposit.account_no,"")," ",IFNULL(deposit.account_detail ,""))
                else CONCAT(deposit.bank_name," ",IFNULL(deposit.account_no,""))
            end 
            AS bank_name '),
            DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out)    
                    FROM t_deposit a 
                    WHERE a.project_id = deposit.project_id  
                    AND a.bank_account_id = deposit.bank_account_id
                    AND 1 = 
                    CASE
                        WHEN a.year < deposit.year THEN 1
                        WHEN a.year = deposit.year THEN
                            CASE
                                WHEN a.month < deposit.month THEN 1
                                WHEN a.month = deposit.month AND a.week < deposit.week  THEN 1 
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
                    FROM t_deposit a 
                    WHERE a.project_id = deposit.project_id 
                    AND a.bank_account_id = deposit.bank_account_id    
                    AND 1 =  
                    CASE
                        WHEN a.year < deposit.year THEN 1
                        WHEN a.year = deposit.year THEN
                            CASE
                                WHEN a.month < deposit.month THEN 1
                                WHEN a.month = deposit.month AND a.week < deposit.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+deposit.in-deposit.out
            ) 
            AS closing_balance'), 
            DB::raw("MONTHNAME(STR_TO_DATE(month, '%m'))as month"),
            'week'  
        ])  ->join('m_bank_account as c', 'deposit.bank_account_id', '=', 'c.bank_account_id')
			->whereRaw('c.aktif=1 AND '.$projectSelected.$yearSelected.$monthSelected.$weekSelected) 
            ->orderBy('deposit.bank_name') ;
          
         
        return Datatables::of($deposit) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit" href="#edit_modal" data-id="'.$data->deposit_id.'"></a><input type="hidden" class="ba_id" value="'.$data->bank_account_id.'"\></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->deposit_id.'" ></a></center>';   
                        })->make(true); 
    } 
    
    public function getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, $depositType){  
		  
		 // $bankAccountQuery = "deposit.bank_name AS bank_account, deposit.bank_account_id, ";
		 $bankAccountQuery = "d.bank_name AS bank_account, deposit.bank_account_id, ";
		 // $bankAccountQuery = "CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail,
                    // IFNULL(concat(\"(\",c.operational_type,\")\"),\"\")) AS bank_account, deposit.bank_account_id, ";
         //buat 2 proyek surabaya wiwik doang minta ada detail dan jika surabaya jadi 3
         if ($projectSelect == 100 || $projectSelect == 142 || $projectSelect == 104){
             // $bankAccountQuery = "CONCAT(deposit.bank_name, \" \", max(deposit.account_no), \" \", max(deposit.account_detail)) AS bank_account, deposit.bank_account_id, ";
			 // $bankAccountQuery = "CONCAT(deposit.bank_name) AS bank_account, deposit.bank_account_id, ";
			 // $bankAccountQuery = "CONCAT(d.bank_name) AS bank_account, deposit.bank_account_id, ";
			$bankAccountQuery = "CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail) AS bank_account, deposit.bank_account_id, ";			 
         }  
			 
         $deposit = DB::table('t_deposit AS deposit')
         ->select(DB::raw($bankAccountQuery."  
                    (   
                        IFNULL(
                            (SELECT CONCAT(b.percent_deposit ,\" %\")
                            FROM t_deposit b 
                            where b.project_id = deposit.project_id  
							AND b.bank_account_id = deposit.bank_account_id 
							AND b.year = ".$yearSelect." 
							AND b.month = ".$monthSelect." 
							AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                            order by year desc ,month desc, week desc 
                            limit 1
                            ) 
                        ,0)
                    ) AS percent_deposit,
                    @opening_balance :=(   
                        IFNULL(
                            (SELECT SUM(a.in)-SUM(a.out)
                            FROM t_deposit a 
                            WHERE a.project_id = deposit.project_id  
                            AND a.bank_account_id = deposit.bank_account_id  
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
                    @in_ :=(SELECT sum(b.in) FROM t_deposit b WHERE 
                        b.project_id = deposit.project_id  
                        AND b.bank_account_id = deposit.bank_account_id 
                        AND b.year = ".$yearSelect." 
                        AND b.month = ".$monthSelect." 
                        AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    ) AS in_,
                    @out_ :=(SELECT sum(c.out) FROM t_deposit c WHERE    
                        c.project_id = deposit.project_id  
                        AND c.bank_account_id = deposit.bank_account_id  
                        AND c.year = ".$yearSelect." 
                        AND c.month = ".$monthSelect." 
                        AND c.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    ) AS out_,
                    (   
                        IFNULL(ROUND(@opening_balance,2),0)
                        +
                        IFNULL(round(@in_,2),0)
                        -
                        IFNULL(round(@out_,2),0)
                    )  AS closing_balance,  
                    deposit.deposit_type,
                    deposit.currency
                ")         
            )
			->join('m_bank_account as c', 'deposit.bank_account_id', '=', 'c.bank_account_id')
			->Leftjoin('m_bank as d', 'c.bank_id', '=', 'd.bank_id')
			->whereRaw("c.aktif='1'
						AND deposit.project_id = ".$projectSelect." 
                        AND c.deposit_type = '".$depositType."'  
                        AND 1 = 
                        CASE
                            WHEN deposit.year < ".$yearSelect."  THEN 1 
                            WHEN deposit.year = ".$yearSelect." THEN 
                                CASE 
                                    WHEN deposit.month < ".$monthSelect."  THEN 1 
                                    WHEN deposit.month = ".$monthSelect."  
                                        AND (deposit.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    ELSE  0 
                                END 
                        END ")
            ->groupBy('deposit.bank_account_id')  
            ->orderBy('deposit.bank_name') 
            ->get();
			
			// $deposit = DB::table('t_deposit AS deposit')->select(
            // DB::raw($bankAccountQuery."  
                    // (   
                        // IFNULL(
                            // (SELECT CONCAT(b.percent_deposit ,\" %\")
                            // FROM t_deposit b 
                            // where b.project_id = deposit.project_id  
							// AND b.bank_account_id = deposit.bank_account_id 
                            // AND b.deposit_type = '".$depositType."'  
							// AND b.year = ".$yearSelect." 
							// AND b.month = ".$monthSelect." 
							// AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                            // order by year desc ,month desc, week desc 
                            // limit 1
                            // ) 
                        // ,0)
                    // ) AS percent_deposit,
                    // @opening_balance :=(   
                        // IFNULL(
                            // (SELECT SUM(a.in)-SUM(a.out)
                            // FROM t_deposit a 
                            // WHERE a.project_id = deposit.project_id  
                            // AND a.bank_account_id = deposit.bank_account_id  
                            // AND a.deposit_type = '".$depositType."'   
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
                    // @in_ :=(SELECT sum(b.in) FROM t_deposit b WHERE 
                        // b.project_id = deposit.project_id  
                        // AND b.bank_account_id = deposit.bank_account_id 
                        // AND b.deposit_type = '".$depositType."'  
                        // AND b.year = ".$yearSelect." 
                        // AND b.month = ".$monthSelect." 
                        // AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    // ) AS in_,
                    // @out_ :=(SELECT sum(c.out) FROM t_deposit c WHERE    
                        // c.project_id = deposit.project_id  
                        // AND c.bank_account_id = deposit.bank_account_id  
                        // AND c.deposit_type = '".$depositType."'  
                        // AND c.year = ".$yearSelect." 
                        // AND c.month = ".$monthSelect." 
                        // AND c.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    // ) AS out_,
                    // (   
                        // IFNULL(ROUND(@opening_balance,2),0)
                        // +
                        // IFNULL(round(@in_,2),0)
                        // -
                        // IFNULL(round(@out_,2),0)
                    // )  AS closing_balance,  
                    // deposit.deposit_type,
                    // deposit.currency
                // ")         
            // )
			// ->join('m_bank_account as c', 'deposit.bank_account_id', '=', 'c.bank_account_id')
			// ->whereRaw("c.aktif='1'
						// AND deposit.project_id = ".$projectSelect." 
                        // AND deposit.deposit_type = '".$depositType."'  
                        // AND 1 = 
                        // CASE
                            // WHEN deposit.year < ".$yearSelect."  THEN 1 
                            // WHEN deposit.year = ".$yearSelect." THEN 
                                // CASE 
                                    // WHEN deposit.month < ".$monthSelect."  THEN 1 
                                    // WHEN deposit.month = ".$monthSelect."  
                                        // AND (deposit.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    // ELSE  0 
                                // END 
                        // END ")
            // ->groupBy('deposit.bank_account_id')  
            // ->orderBy('deposit.bank_name') 
            // ->get();
			
        return $deposit;
    }
      
    public function exportFile(Request $request){  
        $depositType = $request['deposit_type'];
        return $this->exportCashbankFile($request, $depositType);    
    }  
    
    public function sendEmail(Request $request){ 
        
        $this->sendCashbankByEmail($request); 
        return redirect('deposit')->with('message', 'Email Has Been Sent!');
    }
    
    public function autocompleteEmail(Request $request)
    { 
        $data = User::select("email as name")->where("email","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    } 
}
