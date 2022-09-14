<?php

namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BankLoan;
use App\Reksadana;
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
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\CashBankController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EscrowController; 
use App\Http\Controllers\BankLoanController;
use App\Http\Controllers\BankDKController;


class ReksadanaController extends Controller
{
    public function index()
	{ 
        if(!$this->accessMenuAuthorization("Tr Reksadana")){ 
             return view('errors.404');
        }  
        $listProject = $this->getListProjectSelectedUser();
        $listBank = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::orderBy('account_no')->get();  
        //get list bank account per project only 
            $projectID = $listProject[0]->project_id;
            $listBankAccount = BankAccount::where([['project_id','=',$projectID],['transaction_type','=','reksadana'],['aktif','=','1']])->orderBy('account_no')->get();  
    
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
		// $nowMonthString = 'September';
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
		$totalValue = $this->getTotalValue("t_reksadana", $listProject[0]->project_id, $nowYear, $nowMonthNumber, $nowWeekNumber); 
        $latestReksadanaRate = $this->getLatestReksadanaRate($listProject[0]->project_id, $nowYear, $nowMonthNumber, $nowWeekNumber);
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'Tr Reksadana');  
        $listTransaction = Reksadana::all();    
		return view('app/cashbank/reksadana', compact(['latestReksadanaRate','totalValue','listTransaction','listProject','listBank','listBankAccount','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber']));
	}
    public function getTotal($projectID, $year, $month, $week){
        return $this->getTotalValue("t_reksadana", $projectID, $year, $month, $week);
    }
	public function getListBankAccount(Request $request){    
        $projectSelected    = $request['projectSelected'];
        $yearSelected       = $request['yearSelected'];
        $monthSelected      = $request['monthSelected'];
        $weekSelected       = $request['weekSelected'];   
        return $this->getListBankAccountHTMLReksadana($projectSelected, "reksadana", $yearSelected, $monthSelected, $weekSelected);   
    }

    public function getLatestReksadanaRate($projectID, $year, $month, $week){   

        $result = DB::table('t_reksadana AS reksadana')->select([ 
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
			$result = DB::table('t_reksadana AS reksadana')->select([ 
						'bank_account_id as bankAccountID',
						'percent_reksadana as rate'
					 ])->whereRaw('project_id ='.$projectID.' AND year ='.$latestYear.' AND month ='.$latestMonth.' AND week ='.$latestWeek)->get();
       
        //dd($result);
		}
        return $result; 
    }

//     public function create()
// 	{
// 		//
// 	} 
	public function store(Request $request)
	{   
        //get all request
        $dataRequest = array(); 
        $createdBy = Auth::user()->email;
        $listBankAccount = BankAccount::where([['project_id','=',(int)$request['project_id']],['transaction_type','=','reksadana'],['aktif','=','1']])->get();
        foreach($listBankAccount as $b){  
            //check if user already input at the same year, month and week(duplicate data) then return message error
            $findReksadana = Reksadana::where('project_id',(int)$request['project_id'])
                                    ->where('reksadana_id',$b->bank_account_id)
                                    ->where('week',(int)$request['week'])
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->get();  
            if(count($findReksadana)>0){
                //Data has been set, delete first to replace with new value
                Reksadana::where('project_id',(int)$request['project_id'])
                                    ->where('reksadana_id',$b->bank_account_id)
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
                    'reksadana_type'=>$b->reksadana_type, 
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
        $reksadana = Reksadana::insert($dataRequest);   
        return "Reksadana added successfully.";  
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Reksadana::find($id);
	}
 
// 	public function edit($id)
// 	{
// 		//
// 	}
 
	public function update(Request $request)
	{ 
        $id = $request->get('reksadana_id'); 
        $data = Reksadana::where('reksadana_id', $id)  
               ->get();     
        if(count($data)<0){ 
            return "Reksadana ID Not Found ";
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
        Reksadana::find($id)->update($input);  
        return "Reksadana updated succesfully.";
	}
 
	public function destroy($reksadanaID)
	{
        Reksadana::find($reksadanaID)->delete();
        return "Reksadana deleted succesfully.";
	}
    
    public function datatable(Request $request){
        $projectSelected = "";
        if($request['projectSelected']!=0){
            $projectSelected = " reksadana.project_id = ".$request['projectSelected']; 
        } 
        $yearSelected = "";
        if($request['yearSelected']){
            $yearSelected = " AND reksadana.year = ".$request['yearSelected']; 
        } 
        $monthSelected = "";
        if($request['monthSelected']){
            $monthSelected = " AND reksadana.month = ".$request['monthSelected']; 
        }  
        $weekSelected = "";
        if($request['weekSelected']){
            $weekSelected = " AND reksadana.week = ".$request['weekSelected']; 
        }  
        
        $reksadana = DB::table('t_reksadana AS reksadana JOIN m_bank_account as g ON reksadana.bank_account_id=g.bank_account_id AND g.aktif=1')
        ->select([
            'reksadana.reksadana_id',  
            'reksadana.bank_account_id', 
//            DB::raw('CONCAT(reksadana.bank_name, " ", reksadana.account_no, " ", reksadana.account_detail, IFNULL(concat("(",reksadana.operational_type,")"),"")) AS bank_account '),
//            DB::raw('CONCAT(reksadana.bank_name, " ", reksadana.account_no, " ", IFNULL(concat("(",reksadana.operational_type,")"),"")) AS bank_account '), 
            DB::raw('CONCAT(reksadana.reksadana_type, " (",reksadana.currency,")") AS reksadana_type'), 
            DB::raw('
            case 
                when length(reksadana.bank_name)+length(reksadana.account_no) <20 then CONCAT(reksadana.bank_name," ",IFNULL(reksadana.account_no,"")," ",IFNULL(reksadana.account_detail ,""))
                else CONCAT(reksadana.bank_name," ",IFNULL(reksadana.account_no,""))
            end 
            AS bank_account'),
//            DB::raw('CONCAT(reksadana.bank_name, " ", reksadana.account_no) AS bank_account '),
            DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out)
                    FROM t_reksadana a 
                    WHERE a.bank_account_id = reksadana.bank_account_id 
                    AND a.project_id = reksadana.project_id   
                    AND 1 = 
                    CASE
                        WHEN a.year < reksadana.year THEN 1
                        WHEN a.year = reksadana.year THEN
                            CASE
                                WHEN a.month < reksadana.month THEN 1
                                WHEN a.month = reksadana.month AND a.week < reksadana.week  THEN 1 
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
                    FROM t_reksadana a 
                    WHERE a.bank_account_id = reksadana.bank_account_id 
                    AND a.project_id = reksadana.project_id   
                    AND 1 = 
                    CASE
                        WHEN a.year < reksadana.year THEN 1
                        WHEN a.year = reksadana.year THEN
                            CASE
                                WHEN a.month < reksadana.month THEN 1
                                WHEN a.month = reksadana.month AND a.week < reksadana.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+reksadana.in-reksadana.out
            ) 
            AS closing_balance'),
            DB::raw("MONTHNAME(STR_TO_DATE(month, '%m'))as month"),
            'week'  
        ]) ->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected)
           ->orderBy('reksadana.bank_name');
           
//            ->join('m_bank_account as c', 'reksadana.bank_account_id', '=', 'c.bank_account_id') ->orderBy('reksadana.month', 'desc');
          
         
        return Datatables::of($reksadana) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit" href="#edit_modal" data-id="'.$data->reksadana_id.'"></a><input type="hidden" class="ba_id" value="'.$data->bank_account_id.'"\></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->reksadana_id.'" ></a></center>';   
                        })->make(true); 
    }
     
     
    public function exportFile(Request $request){  
       $operationalType = $request['operational_type'];
       return $this->exportCashbankFile($request, $operationalType);
    } 
    
    public function sendEmail(Request $request){  
        $this->sendCashbankByEmail($request); 
        return redirect('reksadana')->with('message', 'Email Has Been Sent!'); 
    }
    
    
    public function getReksadana($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, $reksadanaType){ 

             // $bankAccountQuery = "deposit.bank_name AS bank_account, deposit.bank_account_id, ";
		 $bankAccountQuery = "d.bank_name AS bank_account, reksadana.bank_account_id, ";
		 // $bankAccountQuery = "CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail,
                    // IFNULL(concat(\"(\",c.operational_type,\")\"),\"\")) AS bank_account, deposit.bank_account_id, ";
         //buat 2 proyek surabaya wiwik doang minta ada detail dan jika surabaya jadi 3
         if ($projectSelect == 100 || $projectSelect == 142 || $projectSelect == 104){
             // $bankAccountQuery = "CONCAT(deposit.bank_name, \" \", max(deposit.account_no), \" \", max(deposit.account_detail)) AS bank_account, deposit.bank_account_id, ";
			 // $bankAccountQuery = "CONCAT(deposit.bank_name) AS bank_account, deposit.bank_account_id, ";
			 // $bankAccountQuery = "CONCAT(d.bank_name) AS bank_account, deposit.bank_account_id, ";
			$bankAccountQuery = "CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail) AS bank_account, reksadana.bank_account_id, ";			 
         }  

			$reksadana = DB::table('t_reksadana AS reksadana')
            ->select(DB::raw($bankAccountQuery."
                    (   
                        IFNULL(
                            (SELECT CONCAT(b.percent_reksadana ,\" %\")
                            FROM t_reksadana b 
                            where b.project_id = reksadana.project_id  
							AND b.bank_account_id = reksadana.bank_account_id 
							AND b.year = ".$yearSelect." 
							AND b.month = ".$monthSelect." 
							AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                            order by year desc ,month desc, week desc 
                            limit 1
                            ) 
                        ,0)
                    ) AS percent_reksadana,
                    @opening_balance :=(   
                        IFNULL(
                            (SELECT SUM(a.in)-SUM(a.out)
                            FROM t_reksadana a 
                            WHERE a.project_id = reksadana.project_id  
                            AND a.bank_account_id = reksadana.bank_account_id  
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
                    @in_ :=(SELECT sum(b.in) FROM t_reksadana b WHERE 
                        b.project_id = reksadana.project_id  
                        AND b.bank_account_id = reksadana.bank_account_id 
                        AND b.year = ".$yearSelect." 
                        AND b.month = ".$monthSelect." 
                        AND b.week BETWEEN ".$startWeek." AND ".$endWeek."  
                    ) AS in_,
                    @out_ :=(SELECT sum(c.out) FROM t_reksadana c WHERE    
                        c.project_id = reksadana.project_id  
                        AND c.bank_account_id = reksadana.bank_account_id  
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
                    reksadana.reksadana_type,
                    reksadana.currency
                ")         
            )
			->join('m_bank_account as c', 'reksadana.bank_account_id', '=', 'c.bank_account_id')
			->Leftjoin('m_bank as d', 'c.bank_id', '=', 'd.bank_id')
			->whereRaw("c.aktif='1'
						AND reksadana.project_id = ".$projectSelect." 
                        AND c.transaction_type = '".$reksadanaType."'  
                        AND 1 = 
                        CASE
                            WHEN reksadana.year < ".$yearSelect."  THEN 1 
                            WHEN reksadana.year = ".$yearSelect." THEN 
                                CASE 
                                    WHEN reksadana.month < ".$monthSelect."  THEN 1 
                                    WHEN reksadana.month = ".$monthSelect."  
                                        AND (reksadana.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    ELSE  0 
                                END 
                        END ")
            ->groupBy('reksadana.bank_account_id')  
            ->orderBy('reksadana.bank_name')
            ->get();

            // ->select(DB::raw("
            //         CONCAT(d.bank_name, \" \", c.account_no, \" \", c.account_detail,
            //         IFNULL(concat(\"(\",c.operational_type,\")\"),\"\")) AS bank_account, reksadana.bank_account_id,
            //         @opening_balance :=(   
            //             IFNULL(
            //                 (SELECT SUM(a.in)-SUM(a.out)
            //                 FROM t_reksadana a 
            //                 WHERE a.project_id = reksadana.project_id  
            //                 AND a.bank_account_id = reksadana.bank_account_id   
            //                 AND 1 = 
            //                 CASE 
            //                     WHEN a.year < ".$yearSelect."  THEN 1 
            //                     WHEN a.year = ".$yearSelect." THEN 
            //                         CASE 
            //                             WHEN a.month < ".$monthSelect."  THEN 1 
            //                             WHEN a.month = ".$monthSelect."  
            //                                 AND a.week < ".$startWeek." THEN 1  
            //                             ELSE  0 
            //                         END 
            //                 END)
            //             ,0)
            //         ) AS opening_balance, 
            //         @in_ :=(SELECT sum(b.in) FROM t_reksadana b WHERE 
            //             b.project_id = reksadana.project_id  
            //             AND b.bank_account_id = reksadana.bank_account_id 
            //             AND b.year = ".$yearSelect." 
            //             AND b.month = ".$monthSelect." 
            //             AND b.week BETWEEN ".$startWeek." AND ".$endWeek." 
            //         ) AS in_,
            //         @out_ :=(SELECT sum(c.out) FROM t_reksadana c WHERE        
            //             c.project_id = reksadana.project_id  
            //             AND c.bank_account_id = reksadana.bank_account_id  
            //             AND c.year = ".$yearSelect." 
            //             AND c.month = ".$monthSelect." 
            //             AND c.week BETWEEN ".$startWeek." AND ".$endWeek.") AS out_,
            //         (   
            //             IFNULL(ROUND(@opening_balance,2),0)
            //             +
            //             IFNULL(round(@in_,2),0)
            //             -
            //             IFNULL(round(@out_,2),0)
            //         )  AS closing_balance,
            //         reksadana.currency,
            //         reksadana.reksadana_type,
            //         CONCAT(reksadana.bank_name, \" \", reksadana.account_no) AS bank_account_report
            //     ")         
            // ) 
			// ->join('m_bank_account as c', 'reksadana.bank_account_id', '=', 'c.bank_account_id')
			// ->Leftjoin('m_bank as d', 'c.bank_id', '=', 'd.bank_id')
            // ->whereRaw("c.aktif='1'
			// 			AND reksadana.project_id = ".$projectSelect." 
            //             AND c.operational_type = '".$reksadanaType."'  
            //             AND 1 = 
            //             CASE
            //                 WHEN reksadana.year < ".$yearSelect."  THEN 1 
            //                 WHEN reksadana.year = ".$yearSelect." THEN 
            //                     CASE 
            //                         WHEN reksadana.month < ".$monthSelect."  THEN 1 
            //                         WHEN reksadana.month = ".$monthSelect."  
            //                             AND (reksadana.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
            //                         ELSE  0 
            //                     END 
            //             END  ")
            // ->groupBy('reksadana.bank_account_id') 
            // ->orderBy('reksadana.bank_name') 
            // ->get();
		
        return $reksadana;
    }
     
     
    
    public function autocompleteEmail(Request $request)
    { 
        $data = User::select("email as name")->where("email","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    } 
}

