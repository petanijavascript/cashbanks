<?php

namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CashBank;
use App\Bank;
use App\BankAccount;
use App\Project; 
use App\UserProject; 
use App\GroupUser;  
use App\User;
use App\LogReportEmail;
//use App\Global\Constant;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
use Mail;
use Hash;
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\BankOperationalController;
use App\Http\Controllers\BankLoanController;
use App\Http\Controllers\BankDKController;

class CashBankController extends Controller
{ 
    public function index()
	{      
        if(!$this->accessMenuAuthorization("Tr Kas")){ 
             return view('errors.403');
        } 
        $listProject = $this->getListProjectSelectedUser();
        $listBank = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::orderBy('account_no')->get();  
		
        // get list bank account per project only 
            $projectID = $listProject[0]->project_id;
            $listBankAccount = BankAccount::where([['project_id','=',$projectID],['transaction_type','=','cashbank'],['aktif','=','1']])->orderBy('account_no')->get();  
        
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
				
        // $ddate = date("Y-m-d");
        // $duedt = explode("-", $ddate);
        // $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        // $nowWeekNumber = (int)date('W', $date);
		// $nowWeekNumber = $nowMonthString;

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
		
        
		$totalValue = $this->getTotalValue("t_cashbank", $listProject[0]->project_id, $nowYear, $nowMonthNumber, $nowWeekNumber); 
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'Tr Kas');  
		return view('app/cashbank/cashbank', compact(['totalValue','listProject','listBank','listBankAccount','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber']));
	}
    public function getTotal($projectID, $year, $month, $week){
        return $this->getTotalValue("t_cashbank",$projectID, $year, $month, $week);
    }
	public function getListBankAccount($projectSelectedID){    
        return $this->getListBankAccountHTML($projectSelectedID, "cashbank");    
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
        $listBankAccount = BankAccount::where([['project_id','=',(int)$request['project_id']],['transaction_type','=','cashbank'],['aktif','=','1']])->get();
        foreach($listBankAccount as $b){  
            //check if user already input at the same year, month and week(duplicate data)  
            $findCashBank = CashBank::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',$b->bank_account_id)
                                    ->where('week',(int)$request['week'])
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->get();  
            if(count($findCashBank)>0){
                //Data has been set, delete first to replace with new value
                CashBank::where('project_id',(int)$request['project_id'])
                                    ->where('bank_account_id',$b->bank_account_id)
                                    ->where('week',(int)$request['week'])
                                    ->where('year',(int)$request['year'])
                                    ->where('month',(int)$request['month'])
                                    ->where('week',(int)$request['week'])->delete();
            }
            
            // if new data then create list to insert to db 
            array_push($dataRequest,
                array(
                    'project_id'        =>$request['project_id'],
                    'bank_name'         =>$request['bank_name_'.$b->bank_account_id],
                    'bank_account_id'   =>$b->bank_account_id,
                    'account_no'        =>$b->account_no,
                    'account_detail'    =>$b->account_detail, 
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
        $cashbank = CashBank::insert($dataRequest);   
        return "cashbank added successfully"; 
	}
     
    
	public function show(Request $request)
	{
        $id = $request->get('id');
		return CashBank::find($id);
	}
 
	public function edit($id)
	{
		//
        
	}
 
	public function update(Request $request)
	{ 
        $id = $request->get('cashbank_id'); 
        $data = CashBank::where('cashbank_id', $id)->get();     
        if(count($data)<0){ 
            return "CashBank ID Not Found ";
        } 
        $request['updated_by']=Auth::user()->email; 
		$input = $request->all();
        $this->validate($request,[
            'bank_account_id'   => "required" ,   
            'year'              => "required" ,
            'month'             => "required" ,
            'week'              => "required", 
            'in'                => "numeric" ,
            'out'               => "numeric"
        ]); 
        CashBank::find($id)->update($input);   
        return "cashbank updated successfully";
	}
    
	public function destroy($cashbankID)
	{
        CashBank::find($cashbankID)->delete();
        return "Cashbank deleted succesfully.";
	}

    public function datatable(Request $request){ 
        $projectSelected = "";
        if($request['projectSelected']!=0){
            $projectSelected = " cashBank.project_id = ".$request['projectSelected']; 
        } 
        $yearSelected = "";
        if($request['yearSelected']){
            $yearSelected = " AND cashBank.year = ".$request['yearSelected']; 
        }
        $monthSelected = "";
        if($request['monthSelected']){
            $monthSelected = " AND cashBank.month = ".$request['monthSelected']; 
        }
        $weekSelected = "";
        if($request['weekSelected']){
            $weekSelected = " AND cashBank.week = ".$request['weekSelected']; 
        }  
        
        $cashbank = DB::table('t_cashbank AS cashBank JOIN m_bank_account as g ON cashBank.bank_account_id=g.bank_account_id AND g.aktif=1')->select([
            'cashbank_id',   
            'cashBank.bank_account_id',
            DB::raw('CONCAT(cashBank.bank_name, " ", cashBank.account_no, " ", cashBank.account_detail, " (",cashbank.currency,")") AS bank_account '), 
            DB::raw('
            (   
                (IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out) 
                    FROM t_cashbank a 
                    WHERE a.project_id = cashBank.project_id 
                    AND a.bank_account_id = cashBank.bank_account_id
                    AND 1 = 
                    CASE
                        WHEN a.year < cashBank.year THEN 1
                        WHEN a.year = cashBank.year THEN
                            CASE
                                WHEN a.month < cashBank.month THEN 1
                                WHEN a.month = cashBank.month AND a.week < cashBank.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0))
            ) 
            AS opening_balance'),
            DB::raw("IFNULL(cashBank.in,0) AS 'in'"),
            DB::raw("IFNULL(cashBank.out,0) AS 'out'"),
            DB::raw('
            IFNULL(
            (   
                IFNULL(
                    (SELECT SUM(a.in)-SUM(a.out)
                    FROM t_cashbank a 
                    WHERE a.project_id = cashBank.project_id
                    AND  a.bank_account_id = cashBank.bank_account_id   
                    AND 1 = 
                    CASE
                        WHEN a.year < cashBank.year THEN 1
                        WHEN a.year = cashBank.year THEN
                            CASE
                                WHEN a.month < cashBank.month THEN 1
                                WHEN a.month = cashBank.month AND a.week < cashBank.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+cashBank.in-cashBank.out
            ),0) 
            AS closing_balance'),
            DB::raw("MONTHNAME(STR_TO_DATE(month, '%m'))as month"),
            'week'  
        ])  
			->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected)
            ->orderBy('cashBank.cashbank_id', 'desc');
         
		 // ->join('m_bank_account as c', 'cashBank.bank_account_id', '=', 'c.bank_account_id')

        return Datatables::of($cashbank) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" title="Edit"  href="#edit_modal" data-id="'.$data->cashbank_id.'"></a><input type="hidden" class="ba_id" value="'.$data->bank_account_id.'"\></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" title="Delete" href="#confirm-dialog" data-id="'.$data->cashbank_id.'" ></a></center>';   
                        })->make(true); 
    }
     
        
    public function getCashBank($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek){ 
         $cashBank = DB::table('t_cashbank AS cashBank')->select(
            DB::raw("
                    CONCAT(cashBank.bank_name, \" \", cashBank.account_no, \" \", cashBank.account_detail) AS bank_account, cashBank.bank_account_id,
                    @opening_balance :=(   
                        IFNULL(
                            (SELECT SUM(a.in)-SUM(a.out)
                            FROM t_cashbank a 
                            WHERE a.project_id = cashBank.project_id 
                            AND a.bank_account_id = cashBank.bank_account_id   
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
                    @in_ :=(SELECT sum(b.in) FROM t_cashbank b WHERE 
                        b.project_id = cashBank.project_id 
                        AND b.bank_account_id = cashBank.bank_account_id   
                        AND b.year = ".$yearSelect." 
                        AND b.month = ".$monthSelect." 
                        AND b.week BETWEEN ".$startWeek." AND ".$endWeek." 
                    ) AS in_,
                    @out_ :=(SELECT sum(c.out) FROM t_cashbank c WHERE        
                        c.project_id = cashBank.project_id 
                        AND c.bank_account_id = cashBank.bank_account_id  
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
                    CONCAT(cashBank.bank_name, \" \", cashBank.account_no, \" \", cashBank.account_detail) AS bank_account_report,
                    cashBank.currency
                ")         
            )  
			->join('m_bank_account as c', 'cashBank.bank_account_id', '=', 'c.bank_account_id')	
            ->whereRaw("c.aktif='1'
						AND cashBank.project_id = ".$projectSelect." 
                        AND 1 = 
                        CASE
                            WHEN cashBank.year < ".$yearSelect."  THEN 1 
                            WHEN cashBank.year = ".$yearSelect." THEN 
                                CASE 
                                    WHEN cashBank.month < ".$monthSelect."  THEN 1 
                                    WHEN cashBank.month = ".$monthSelect."  
                                        AND (cashBank.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    ELSE  0 
                                END 
                        END  
                        ")
            ->groupBy('cashBank.bank_account_id') 
            ->get();
			
			 // $cashBank = DB::table('t_cashbank AS cashBank')->select(
            // DB::raw("
                    // CONCAT(cashBank.bank_name, \" \", cashBank.account_no, \" \", cashBank.account_detail) AS bank_account, cashBank.bank_account_id,
                    // @opening_balance :=(   
                        // IFNULL(
                            // (SELECT SUM(a.in)-SUM(a.out)
                            // FROM t_cashbank a 
                            // WHERE a.project_id = cashBank.project_id 
                            // AND a.bank_account_id = cashBank.bank_account_id   
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
                    // @in_ :=(SELECT sum(b.in) FROM t_cashbank b WHERE 
                        // b.project_id = cashBank.project_id 
                        // AND b.bank_account_id = cashBank.bank_account_id   
                        // AND b.year = ".$yearSelect." 
                        // AND b.month = ".$monthSelect." 
                        // AND b.week BETWEEN ".$startWeek." AND ".$endWeek." 
                    // ) AS in_,
                    // @out_ :=(SELECT sum(c.out) FROM t_cashbank c WHERE        
                        // c.project_id = cashBank.project_id 
                        // AND c.bank_account_id = cashBank.bank_account_id  
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
                    // CONCAT(cashBank.bank_name, \" \", cashBank.account_no, \" \", cashBank.account_detail) AS bank_account_report,
                    // cashBank.currency
                // ")         
            // )  
			// ->join('m_bank_account as c', 'cashBank.bank_account_id', '=', 'c.bank_account_id')	
            // ->whereRaw("c.aktif='1'
						// AND cashBank.project_id = ".$projectSelect." 
                        // AND 1 = 
                        // CASE
                            // WHEN cashBank.year < ".$yearSelect."  THEN 1 
                            // WHEN cashBank.year = ".$yearSelect." THEN 
                                // CASE 
                                    // WHEN cashBank.month < ".$monthSelect."  THEN 1 
                                    // WHEN cashBank.month = ".$monthSelect."  
                                        // AND (cashBank.week BETWEEN ".$startWeek ." AND ". $endWeek .")  THEN 1  
                                    // ELSE  0 
                                // END 
                        // END  
                        // ")
            // ->groupBy('cashBank.bank_account_id') 
            // ->get();
        return $cashBank;
    }
        
    public function exportFile(Request $request){   
         
        return $this->exportCashbankFile($request,"cashbank");    
    } 
    
    
    public function sendEmail(Request $request){ 
        
        $this->sendCashbankByEmail($request); 
        return redirect('cashbank')->with('message', 'Email Has Been Sent!');
    }
    
    public function autocompleteEmail(Request $request)
    { 
        $data = User::select("email as name")->where("email","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    } 
	
	public function reqForgotPass(Request $request){  
        $userEmail = $request['email']; 
        $user = User::where('email', $userEmail)->get(); 
        if(count($user)>0){ 
            $userID = $user[0]->user_id;
            $ecryptedID = md5(md5($userID)); 
            $generateUrl = 'http://cashbank.ciputragroup.com/cashbank/public/forgotpass/'.$ecryptedID.'/email/'.$userEmail;
            
            //send url to mail
            $data=[
                'mail_to' => $userEmail, 
                'generate_url'=> $generateUrl 
            ];

            //send mail
            Mail::send('emails.resetpass', $data, function ($mail) use($data)
            {  
              $mail->from('cashbank@ciputra.com', 'Cashbank System Automatic');
              $mail->to($data['mail_to']); 
              $mail->subject('Cashbank Notification : Reset your password'); 
            });
            dd("reset link has been sent to your email.. please check your email. Thanks..");
            
        } 
    }
    public function forgotPass($paramEncryptedID, $paramEmail){ 
        $user = User::where('email', $paramEmail)->get(); 
        if(count($user)>0){ 
            $userID = $user[0]->user_id;
            $ecryptedID = md5(md5($userID));
            if($ecryptedID == $paramEncryptedID){
                //reset pass  
                $newPass = Hash::make("sungairaya");    
                User::find($userID)->update(['password' => $newPass]);    
                dd("Password hasbeen reset become : sungairaya");
            }else{
                dd("Reset Failed. Please contact admin for help..");
            }
        }else{
            dd("Reset Failed, User not found. please contact admin for help...");
        }
        
    }
     
    
}
