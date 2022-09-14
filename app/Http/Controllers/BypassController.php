<?php

namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\Project; 
use App\UserProject;  
use App\GroupUser;  
use App\User;  
use App\UserPrivileges;
use App\Menu;
use App\LogTransaction;
use App\LogReportEmail; 
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
use Mail;
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\BankOperationalController;
use App\Http\Controllers\BankLoanController;
use App\Http\Controllers\BankDKController;

class BypassController extends Controller
{ 
    public function index(Request $request)
	{      
		$data = array(
			"email"  => $request['email'],
			"key" => "123456whyyoucheckthiscode",
			"token" => md5(md5('123456whyyoucheckthiscode'))
		);
		
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://aauth.uc.ac.id');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);           
        curl_close($ch);
		//return $result; 
     
        if(trim($result)=="login"){   
             $user = User::where('email','=',$data['email'])->firstOrFail();  
            //ByPASS LOGIN
            Auth::login($user);  
            //list project
            $listProject = DB::table('t_user_project AS userProject')
                            ->select(
                            'userProject.project_id', 
                            'project.pt_name',
                            'project.project_name' ) 
                            ->join('m_project AS project', 'project.project_id', '=', 'userProject.project_id') 
                            ->where('userProject.user_id',$user->user_id)
                            ->orderBy('pt_name', 'ASC')
                            ->get();    
            session()->set('listProject', $listProject);  
            $userPrivileges = UserPrivileges::where('group_user_id',(int)$user->group_user_id)->get();
            //list menu
            $listMenuID = array();
            foreach($userPrivileges as $p){
                array_push($listMenuID, $p->menu_id);
            }
            $listMenu = Menu::whereIn('menu_id', $listMenuID)->orderBy('child_no')->get(); 
            session()->set('listMenu', $listMenu);    
            session()->set('bypassAccess', 'true');    
            
            //Make log login
            $data = array(); 
            $data['username'] = Auth::user()->email;  
            $data['activity_type'] = "Login Web";   
            LogTransaction::insert($data);  
			 
			return redirect("http://cashbank.ciputragroup.com/cashbank/public");   
	
        }
         
		return redirect("http://cashbank.ciputragroup.com/cashbank/public/login");   
		
	}
	 
    
}
