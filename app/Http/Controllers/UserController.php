<?php namespace App\Http\Controllers;
 
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\GroupUser;
use App\Project;
use App\UserProject;
use Illuminate\Http\Request;
use Datatables;
use Hash;
use Auth;
use DB;
class UserController extends Controller {

	  
	public function index()
	{ 
        if(!$this->accessMenuAuthorization('User')){ 
             return view('errors.403');
        }
        $listUser = User::all();   
        $listGroupUser = GroupUser::orderBy('group_detail', 'asc')->get();    
        $listProject = Project::all(); 
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'User'); 
		return view('master/user', compact(['listUser','listGroupUser','listProject']));
	}
    public function create()
	{
		//
	} 
	public function store(Request $request)
	{  
        $this->validate($request,[
            'username' => "required|max:50",
            'password' => "required|max:50",
            "first_name" => "required|max:50",
            "email" => "required|email|unique:m_user"    
        ]);  
        $request['password']=Hash::make($request['password']);  
        $request['created_by']=Auth::user()->email; 
		$input = $request->all(); 
        
        $user = User::create($input);
        
        $request['user_id']=$user->user_id; 
        $request['group_user_id']=$user->group_user_id;
        
        //input into t_user_project
        $listProjectID = explode(",",$request['project']);
        for($i=0;$i<count($listProjectID);$i++){
            $request['project_id']=$listProjectID[$i];
            $input = $request->all();  
            $userProject = UserProject::create($input);
        }
        return "User added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
        $listUserProject = UserProject::all()->where('user_id',(int)$id); 
        $listProjectID = array();
        foreach($listUserProject as $p){
            array_push($listProjectID, $p->project_id);
        }
        $listProject = Project::whereIn('project_id', $listProjectID)->get();
         
        $user = User::find($id); 
        $user->list_project = $listProject;  
		return $user;
	}
 
	public function edit($id)
	{
		//
	}
 
	public function update(Request $request)
	{
        //update to m_user 
        $this->validate($request,[
            'username' => "required",
            'password' => "required",
            "first_name" => "required",
            "email" => "required"
        ]);
        $request['password']=Hash::make($request['password']);  
        $request['updated_by']=Auth::user()->email; 
		$input = $request->all();
        $id = $request->get('user_id');
        User::find($id)->update($input);    
        
        //for update t_user_project
        //DEL all user project before, then create all new for that user 
        UserProject::where('user_id',(int)$id)->delete();
        
        $listProjectID = explode(",",$request['project']);
        for($i=0;$i<count($listProjectID);$i++){
            $request['project_id']=$listProjectID[$i];
            $input = $request->all();  
            UserProject::create($input);
        }
        return "User updated successfully.";
	}
 
	public function destroy($userID)
	{
        //destroy from user table
        User::find($userID)->delete();
        //destroy from user project
        UserProject::where('user_id',(int)$userID)->delete();
        return "User deleted successfully.";
	}

	public function changePassword(){
        
    } 
    public function datatable(Request $request){
		if(!$this->isAdmin()){
			dd("really sorry..");
		}
		
        $user = User::select([
            'user_id',
            'username',
            'password',
            'first_name',
            'last_name',
            'email',
            'group_detail'
        ])->join('m_group_user', 'm_group_user.group_user_id', '=', 'm_user.group_user_id');
        return Datatables::of($user) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->user_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->user_id.'" ></a></center>';  
                        })->make(true); 
    }
    public function datatableProject(Request $request){
         $project = Project::select([
            'project_id',
            'project_code',
            'pt_name',
            'project_name',
            'project_location',
            'project_location_group' 
        ]);
        return Datatables::of($project) 
                        ->addColumn('checkbox', '<input type="checkbox" name="item_id[]" value="{{$project_id}}" id="check_{{$project_id}}" class="minimal check_project">')->make(true); 
    } 
    
    public function exportFile(Request $request){    
        
        $exportType = $request['type_export'];  
        $creator = Auth::user()->email; 
        $listUser = DB::table('m_user as user')->select('user_id','username','first_name','last_name','email','group_detail')->join('m_group_user as groupUser', 'groupUser.group_user_id', '=', 'user.group_user_id')->get(); 
         
        if($exportType == "excel"){  
            $report = array();
                Excel::create('List User', function($excel) use($report,$creator,$listUser) {
                    $excel->setTitle('List User');  
                    $excel->setCreator($creator)
                          ->setCompany('Ciputra'); 
                    $excel->setDescription('User List Data');
                    $excel->sheet('Sheet 1', function($sheet) use($report,$creator,$listUser) {  
                        foreach ($listUser as $c) {   
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
            return view('master/userprintreport', compact(['listBank'])); 
        }
    } 
}
