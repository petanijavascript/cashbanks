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

class ReportSummaryController extends Controller
{
    public function index()
	{  
        if(!$this->accessMenuAuthorization("Report Summary")){ 
             return view('errors.403');
        } 
        $listProject = $this->getListProjectSelectedSummary();
        $listBank = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::orderBy('account_no')->get();   
        // get list bank account per project only 
            $projectID = $listProject[0]->project_id;
            $listBankAccount = BankAccount::where([['project_id','=',$projectID],['transaction_type','=','deposit']])->orderBy('account_no')->get();  
    
        $nowYear = date("Y");
        // $nowYear = '2019'; 
        $nowMonthString = date("F");
        $nowMonthNumber = date("m");
        // $nowWeekNumber = date("W");
        $ddate = date("Y-m-d");
        $duedt = explode("-", $ddate);
        $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        $nowWeekNumber = (int)date('W', $date);
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
        $printValue="TESTING";
		
		session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Report Summary');  
		return view('app/cashbank/reportsummary', compact(['latestDepositRate','totalValue','listTransaction','listProject','listBank','listBankAccount','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber','printValue']));
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
        $yearSelected = "";
        if($request['yearSelected']){
            $yearSelected = $request['yearSelected']; 
        }
        $monthSelected = "";
        if($request['monthSelected']){
            $monthSelected = $request['monthSelected']; 
        }
        $weekSelected = "";
        if($request['weekSelected']){
            $weekSelected = $request['weekSelected']; 
        }
		$timeSelected = " 1 = 
                        CASE
                            WHEN a.year < ".$yearSelected."  THEN 1 
                            WHEN a.year = ".$yearSelected." THEN 
                                CASE 
                                    WHEN a.month < ".$monthSelected."  THEN 1 
                                    WHEN a.month = ".$monthSelected."  
                                        AND (a.week BETWEEN 1 AND ".$weekSelected.")  THEN 1  
                                    ELSE  0 
                                END 
                        END";
		$projectSelected = "";
        if($request['projectSelected']!="all88"){
            $projectSelected = " AND a.project_id = ".$request['projectSelected']; 
        } 	
        $depositSelected= " AND a.deposit_type = 'deposit'";
		$bankSelected= " AND b.bank_id = '4'";
		
		$deposit = DB::table('t_deposit AS a')->select([
            'b.bank_id', 'd.bank_name',
			DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(f.in)-SUM(f.out)
                    FROM t_deposit f 
                    WHERE f.project_id = a.project_id 
                    AND f.bank_account_id = a.bank_account_id    
                    AND 1 =  
                    CASE
                        WHEN f.year < a.year THEN 1
                        WHEN f.year = a.year THEN
                            CASE
                                WHEN f.month < a.month THEN 1
                                WHEN f.month = a.month AND f.week < a.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+a.in-a.out
            ) 
            AS closing_balance'),
			DB::raw('SUM(IF(b.project_id=130,a.in-a.out,0)) as `Barsa City Yogya`'),
			DB::raw('SUM(IF(b.project_id=105,a.in-a.out,0)) as `Bizpark 1 Pulogadung`'),
			DB::raw('SUM(IF(b.project_id=106,a.in-a.out,0)) as `Bizpark 2 Penggilingan`'),
			DB::raw('SUM(IF(b.project_id=93,a.in-a.out,0)) as `Bizpark 3 Bekasi`'),
			DB::raw('SUM(IF(b.project_id=110,a.in-a.out,0)) as `Bizpark Bandung`'),
			DB::raw('SUM(IF(b.project_id=94,a.in-a.out,0)) as `Bizpark Palembang`'),
			DB::raw('SUM(IF(b.project_id=121,a.in-a.out,0)) as `ByPass Ngurah Rai`'),
			DB::raw('SUM(IF(b.project_id=122,a.in-a.out,0)) as `Ciputra Golf`'),
			DB::raw('SUM(IF(b.project_id=71,a.in-a.out,0)) as `Ciputra World Surabaya`'),
			DB::raw('SUM(IF(b.project_id=74,a.in-a.out,0)) as `Citra Garden Pekanbaru`'),
			DB::raw('SUM(IF(b.project_id=75,a.in-a.out,0)) as `Citra Grand Semarang`'),
			DB::raw('SUM(IF(b.project_id=72,a.in-a.out,0)) as `Citra Harmoni Sidoarjo`'),
			DB::raw('SUM(IF(b.project_id=73 or b.project_id=143 or b.project_id=144,a.in-a.out,0)) as `Citra Indah Jonggol`'),
			DB::raw('SUM(IF(b.project_id=96,a.in-a.out,0)) as `Citra Garden Lampung`'),
			DB::raw('SUM(IF(b.project_id=95,a.in-a.out,0)) as `Citra Garden Sidoarjo`'),
			DB::raw('SUM(IF(b.project_id=1,a.in-a.out,0)) as `Citragran Cibubur`'),
			DB::raw('SUM(IF(b.project_id=126,a.in-a.out,0)) as `Citragran Mutiara`'),
			DB::raw('SUM(IF(b.project_id=76,a.in-a.out,0)) as `CitraLand Ambon`'),
			DB::raw('SUM(IF(b.project_id=89,a.in-a.out,0)) as `CitraLand Cibubur`'),
			DB::raw('SUM(IF(b.project_id=154,a.in-a.out,0)) as `CitraLand City East Jakarta`'),
			DB::raw('SUM(IF(b.project_id=78 or b.project_id=120,a.in-a.out,0)) as `CitraLand Denpasar`'),
			DB::raw('SUM(IF(b.project_id=158,a.in-a.out,0)) as `CitraLand Driyorejo`'),
			DB::raw('SUM(IF(b.project_id=109,a.in-a.out,0)) as `CitraLand Jayapura`'),
			DB::raw('SUM(IF(b.project_id=159,a.in-a.out,0)) as `CitraLand Kedamean`'),
			DB::raw('SUM(IF(b.project_id=79,a.in-a.out,0)) as `CitraLand Kendari`'),
			DB::raw('SUM(IF(b.project_id=140,a.in-a.out,0)) as `CitraLand Lampung`'),
			DB::raw('SUM(IF(b.project_id=90,a.in-a.out,0)) as `CitraLand Losari Makassar`'),
			DB::raw('SUM(IF(b.project_id=80,a.in-a.out,0)) as `CitraLand Manado`'),
			DB::raw('SUM(IF(b.project_id=149,a.in-a.out,0)) as `CitraLand Palembang`'),
			DB::raw('SUM(IF(b.project_id=97,a.in-a.out,0)) as `CitraLand Palu`'),
			DB::raw('SUM(IF(b.project_id=81,a.in-a.out,0)) as `CitraLand Pekanbaru`'),
			DB::raw('SUM(IF(b.project_id=165,a.in-a.out,0)) as `CitraLand Puncak Tidar`'),
			DB::raw('SUM(IF(b.project_id=163,a.in-a.out,0)) as `CitraLand Setiabudi`'),
			DB::raw('SUM(IF(b.project_id=104,a.in-a.out,0)) as `CitraLand Surabaya`'),
			DB::raw('SUM(IF(b.project_id=91,a.in-a.out,0)) as `CitraLand Tallasa City Makassar`'),
			DB::raw('SUM(IF(b.project_id=92,a.in-a.out,0)) as `CitraLandUtara Surabaya`'),
			DB::raw('SUM(IF(b.project_id=153,a.in-a.out,0)) as `CitraLand Vittorio`'),
            DB::raw('SUM(IF(b.project_id=171,a.in-a.out,0)) as `UC Makassar`')
           
        ]) 

            ->leftJoin('m_bank_account as b', 'a.bank_account_id', '=', 'b.bank_account_id')
            ->join('m_project as c', 'a.project_id', '=', 'c.project_id')
			->join('m_bank as d', 'b.bank_id', '=', 'd.bank_id')
            // ->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected.$depositSelected)
			->whereRaw($projectSelected.$timeSelected)
            ->groupBy('d.bank_name')
            ->orderBy('d.bank_name','asc') ;
		 
        return Datatables::of($deposit)->make(true);
    } 
    
    public function getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, $depositType){  
		  
         $bankAccountQuery = "max(deposit.bank_name) AS bank_account, ";
         //buat 2 proyek surabaya wiwik doang minta ada detail dan jika surabaya jadi 3
         if ($projectSelect == 100 || $projectSelect == 142 || $projectSelect == 104){
             $bankAccountQuery = "CONCAT(max(deposit.bank_name), \" \", max(deposit.account_no), \" \", max(deposit.account_detail)) AS bank_account, "; 
         }  
          
         $deposit = DB::table('t_deposit AS deposit')->select(
            DB::raw($bankAccountQuery."  
                    (   
                        IFNULL(
                            (SELECT CONCAT(b.percent_deposit ,\" %\")
                            FROM t_deposit b 
                            where b.project_id = deposit.project_id  
							AND b.bank_account_id = deposit.bank_account_id 
                            AND b.deposit_type = '".$depositType."'  
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
                            AND a.deposit_type = '".$depositType."'   
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
                        AND b.deposit_type = '".$depositType."'  
                        AND b.year = ".$yearSelect." 
                        AND b.month = ".$monthSelect." 
                        AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    ) AS in_,
                    @out_ :=(SELECT sum(c.out) FROM t_deposit c WHERE    
                        c.project_id = deposit.project_id  
                        AND c.bank_account_id = deposit.bank_account_id  
                        AND c.deposit_type = '".$depositType."'  
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
            )->whereRaw("deposit.project_id = ".$projectSelect." 
                        AND deposit.deposit_type = '".$depositType."'  
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
