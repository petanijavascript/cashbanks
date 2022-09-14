<?php

namespace App\Http\Controllers; 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\Project; 
use App\UserProject; 
use App\GroupUser;  
use App\User;  
use Illuminate\Http\Request; 
use Auth;   
use Illuminate\Database\Query\Expression; 

class DirViewController extends Controller
{ 
    public function index()
	{      
        if(!$this->accessMenuAuthorization("View Cashbank Project")){ 
             return view('errors.403');
        } 
		
        $listProject = $this->getListProjectSelectedUser(); 
	      
        $nowYear = date("Y");  
        $nowMonthString = date("F"); 
        $nowMonthNumber = date("m");
        //Set week list(get all friday in month)
        $listWeek = array();
		$totalWeek = 0 ;
        $dateBegin = $nowYear.'-'.$nowMonthNumber.'-01';
        $dateEnd = $nowYear.'-'.$nowMonthNumber.'-' . date('t', strtotime($dateBegin)); //get end date of month
        while(strtotime($dateBegin) <= strtotime($dateEnd)) {
            $day_num = date('d', strtotime($dateBegin));
            $day_name = date('l', strtotime($dateBegin));
            $dateBegin = date("Y-m-d", strtotime("+1 day", strtotime($dateBegin)));
            if($day_name=="Friday"){
                array_push($listWeek, $day_num);
				$totalWeek++;
            } 
        }  
         
        session()->set('activeParentMenu', 'Mutasi Cash & Bank');  
        session()->set('activeChildMenu', 'View Cashbank Project');  
		return view('app/cashbank/dirview', compact(['listProject','listWeek','nowMonthString','nowMonthNumber','nowYear','totalWeek']));
	}
       
     
    
}
