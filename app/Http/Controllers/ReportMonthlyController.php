<?php namespace App\Http\Controllers;
 
use App\UserProject; 
use App\Project;
use App\User;
use App\LogTransaction;
use App\ReportMonthly;
use DB;
use Datatables;
use Mail;  
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;  

class ReportMonthlyController extends Controller {
 
 
 
	public function view(){
		//if(!$this->accessMenuAuthorization('Bank')){ 
        //     return view('errors.403');
        //}
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Report Monthly Setting');  
		     
		$isAdmin = $this->isAdmin();
		return view('master/reportmonthlysetting', compact('isAdmin'));
	}
 
	public function index()
	{     
        

//        $allProject = Project::all()->pluck('project_id');  
//        $allProject = Project::all()->pluck("project_id", "project_name");


        $listUser = User::all();  
        foreach($listUser as $user){  
             //if($user->user_id==42){ 
                $userID = $user->user_id; 
                $listProject = array();
                $listUserProject    = DB::table('t_user_project AS userProject')
                                            ->join('m_user AS user', 'userProject.user_id', '=', 'user.user_id') 
                                            ->join('m_project AS project', 'userProject.project_id', '=', 'project.project_id') 
                                            ->select([ 
                                                'user.email' ,
                                                'userProject.project_id' ,
                                                'project.project_name', 
                                                'project.pt_name' 
                                            ])->whereRaw(
                                                'userProject.group_user_id = 6  and
                                                 userProject.user_id ='.$userID
                                            )->get(); 
                // dd($listUserProject);
                //if is dead user
                if(count($listUserProject)==0) {
                    echo $user->email." tidak ada akses ke project manapun<br/>";
                } 
                else{
                    foreach($listUserProject as $userProject){  
                        $listLog     = LogTransaction::where('project_id','=',$userProject->project_id)
                                                ->where('detail', 'LIKE', '%nanik%')
                                                ->groupBy('username')
                                                ->pluck('username');
                        //no log send mail
                        if(count($listLog)==0){
                            echo $userProject->email." no log ever before<br/>";
                        }  
                        else {
                            array_push($listProject,$userProject);
                        }
                    }
                }   
                echo $user->email." ini </br>";    
                // dd($listProject);           
                if(count($listProject)>0){ 
                    $reportTarget = ReportMonthly::where('project_id','=',$listProject[0]->project_id)->get();  
                    // dd($reportTarget);
                    if(count($reportTarget)<=0){
                        echo $listProject[0]->project_name." blum diset</br>";
                    } else{
                        $mailTo = "";
                        if(trim($reportTarget[0]->mail_to)!=""){
                            $mailTo = explode(",",trim($reportTarget[0]->mail_to));
                        } 
                        $cc=[];
                            if($reportTarget[0]->cc != ""){
                                $cc = explode(",",$reportTarget[0]->cc);
                            }  
                        $replyTo     = $user->email; 

                        $data=[
                            'oneofprojectname'=>$listProject[0]->project_name,
                            'listProject'=>$listProject, 
                            'user'=>$user,
                            'useremail'=>$user->email,
    //                            'listLog'=>$listLog,
                            'reportMailTo'=>$mailTo,
                            'cc'=>$cc,
                            'replyTo'=>$replyTo

                        ];

                        //active project only
                        if($mailTo != ""){
                            Mail::send('emails.reportsendermonthly', $data, function ($mail) use($data)
                            {   
                            //   $mail->from("sh2mailsender@ciputra.com", $data['useremail']);
                              $mail->from("sh2mailsender@ciputra.co.id", 'Mailsender SH2');
                              $mail->to($data['reportMailTo']);
                              //$mail->to('rieky.lesmana@ciputra.com');

                              if(count($data['cc'])>0){
                                foreach($data['cc'] as $c){
                                    $mail->cc($c, $c); 
                                } 
                              }

                              //$mail->subject('Monthly Cashbank Report');
                              $mail->subject('Monthly Cashbank Report');
                              $mail->replyTo($data['replyTo'], 'Admin CashBank Ciputra'); 
                            });
                        }  

                    }
                }
                    
                




             //}
        }
        dd("sampai sini saja");
        
//         $allProject = Project::all(); 
//         foreach($allProject as $project){  
//                 //if($project->project_id==131){ 
                    
// //                    $tes = UserProject::with('user')->get();
// //                    dd($tes);
            
//                     $projectID   = $project->project_id; 
//                     $projectName = $project->project_name; 
//                     $ptName      = $project->pt_name; 
//                     $listUser    = DB::table('t_user_project AS userProject')
//                                     ->join('m_user AS user', 'userProject.user_id', '=', 'user.user_id') 
//                                     ->select([ 
//                                         'user.email'  
//                                     ])->whereRaw(
//                                         'userProject.group_user_id = 6 and
//                                         userProject.project_id ='.$projectID
//                                     )->get(); 
//                     $listLog     = LogTransaction::where('project_id','=',$projectID)
//                                                 ->where('detail', 'LIKE', '%nanik@ciputra.com%')
//                                                 ->groupBy('username')
//                                                 ->pluck('username');
//                     //no log send mail
//                     if(count($listLog)==0){
//                         echo $projectName."<br/>";
//                     } else {
//                         $reportTarget = ReportMonthly::where('project_id','=',$projectID)->get(); 
// 						$mailTo = "";
// 						if(trim($reportTarget[0]->mail_to)!=""){
// 							$mailTo = explode(",",trim($reportTarget[0]->mail_to));
// 						} 
//                         $cc=[];
//                             if($reportTarget[0]->cc != ""){
//                                 $cc = explode(",",$reportTarget[0]->cc);
//                             }  
//                         $replyTo     = $listLog[0]; 

//                         $data=[
//                             'projectID'=>$projectID,
//                             'projectName'=>$projectName,
//                             'ptName'=>$ptName,
//                             'listUser'=>$listUser,
// //                            'listLog'=>$listLog,
//                             'reportMailTo'=>$mailTo,
//                             'cc'=>$cc,
//                             'replyTo'=>$replyTo

//                         ];


//                         //active project only
//                         if($mailTo != ""){
//                             Mail::send('emails.reportsendermonthly', $data, function ($mail) use($data)
//                             {   
//                               $mail->from("sh2mailsender@ciputra.com", $data['projectID']);
//                               $mail->to($data['reportMailTo']);

//                               if(count($data['cc'])>0){
//                                 foreach($data['cc'] as $c){
//                                     $mail->cc($c, $c); 
//                                 } 
//                               }

//                               $mail->subject('Monthly Cashbank Report');
//                               $mail->replyTo($data['replyTo'], 'Admin CashBank Ciputra'); 
//                             });
//                         }         
//                     } 
//              //} 
//         }
        
        dd("Done mailing"); 

	}
     
	public function datatable(Request $request){
        $reportMonthly = DB::table('vm_report_monthly');

        // $reportMonthly = ReportMonthly::select([
        //     'project_id', 
        //     'mail_to',
        //     'cc' 
        // ]);
        return Datatables::of($reportMonthly) 
                        ->addColumn('action_update', function($data){
                            if($this->isAdmin()){ 
                                return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->report_id.'"></a></center>';
                            }
                        })
                        ->addColumn('action_delete', function($data){
                            if($this->isAdmin()){ 
                                return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->report_id.'" ></a></center>';  
                            }
                        })->make(true); 
    }
    

}
