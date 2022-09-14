<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth; 
use App\Project;
use App\User;
use App\UserProject;
use App\Bank;
use Hash;  
use App\Menu;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $email =  Auth::user()->email;
//        // get group user and set session project and pt
//        $user = User::where('email',$email)->get();
//        $userID = $user[0]['user_id'];
//
//        $listProject = DB::table('t_user_project AS userProject')
//            ->select(
//            'userProject.project_id', 
//            'project.pt_name',
//            'project.project_name' 
//            ) 
//            ->join('m_project AS project', 'project.project_id', '=', 'userProject.project_id') 
//            ->where('userProject.user_id',$userID)
//            ->get();   
////            return $listProjectAndPT[0]->pt_id;
//        session()->set('listProject', $listProject); 
//        
//        //get List Menu 
//        //select menu which groupID = Userlogin GroupID
//        $listMenu = Menu::where(function($query) {
//                    //get user groupID
//                    $groupID = Auth::user()->group_user_id;
//            
//                    $query->where('group_user_id', $groupID)
//                          ->orWhere('group_user_id', 0);
//                    })->get(); 
//        session()->set('listMenu', $listMenu);  
        //session()->set('activeParentMenu', 'Master Data');
        //session()->set('activeChildMenu', 'Master Data'); 
		$listBank = Bank::orderBy('bank_name')->get();
		$nowYear = date("Y");
        // $nowYear = '2019'; 
        $nowMonthString = date("F");
        $nowMonthNumber = date("m");
        // $nowWeekNumber = date("W");
        $ddate = date("Y-m-d");
        $duedt = explode("-", $ddate);
        $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        $nowWeekNumber = (int)date('W', $date);
		$projectSelected="";
		
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
		
		$listProject = $this->getListProjectSelectedSummary();
		$listDeposit = $this->getListDepoBank($nowYear,$nowMonthNumber,$nowWeekNumber,$projectSelected);
		
	if(Auth::user()->group_user_id ==4 || Auth::user()->group_user_id ==1) {
		$isAdmin = $this->isAdmin();     
        $totalCashbank = DB::table('t_cashbank AS cashBank')->select([ 
            DB::raw("SUM(cashBank.in)-SUM(cashBank.out) as result") , 
        ])->where('cashBank.currency','=','IDR')->get();
		$totalCashbank = number_format($totalCashbank[0]->result);
		
        $totalDeposit = DB::table('t_deposit AS deposit')->select([ 
            DB::raw("SUM(deposit.in)-SUM(deposit.out) as result") , 
        ])->where('deposit.currency','=','IDR')->get();
		$totalDeposit = number_format($totalDeposit[0]->result);
		
        $totalEscrow = DB::table('t_escrow AS escrow')->select([ 
            DB::raw("SUM(escrow.in)-SUM(escrow.out) as result") , 
        ])->get();
		$totalEscrow = number_format($totalEscrow[0]->result);
		
        $totalBankOperational = DB::table('t_bank_operational AS bo')->select([ 
            DB::raw("SUM(bo.in)-SUM(bo.out) as result") , 
        ])->where('bo.currency','=','IDR')->get();
		$totalBankOperational = number_format($totalBankOperational[0]->result);
		
        $totalBankLoan = DB::table('t_bankloan AS bl')->select([ 
            DB::raw("SUM(bl.in)-SUM(bl.out) as result") , 
        ])->get();
		$totalBankLoan = number_format($totalBankLoan[0]->result);
		
        $totalBankDK = DB::table('t_bank_dk AS dk')->select([ 
            DB::raw("SUM(dk.in)-SUM(dk.out) as result") , 
        ])->get();
		$totalBankDK = number_format($totalBankDK[0]->result);
		
		return view('dashboard', compact('isAdmin','totalCashbank','totalDeposit','totalEscrow','totalBankOperational','totalBankLoan','totalBankDK','listProject','listDeposit','listWeek','nowMonthString','nowMonthNumber','nowYear','nowWeekNumber','listBank')); 
			return view('dashboard');
		}
        return view('home');
    }
	
    public function changePassword(Request $request){
        $newPassword = $request['new_password']; 
        $confirmPassword = $request['confirm_password']; 
        if($newPassword !== $confirmPassword){
            return redirect('home')
                ->with('status', 'danger')
                ->with('message', 'Update failed, your new password is not same with confirm password!')
                ;
        }
        
        $request['password']=Hash::make($newPassword);  
        $request['updated_by']=Auth::user()->email; 
		$input = $request->all(); 
        $id = Auth::user()->user_id; 
        User::find($id)->update($input);     
        return redirect('home')
                ->with('status', 'success')
                ->with('message', 'Password has been updated!');
    }
    
      
}
