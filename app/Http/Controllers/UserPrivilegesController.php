<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserPrivileges;
use App\GroupUser;
use App\Menu;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
class UserPrivilegesController extends Controller {

   
    
	public function index()
	{
        if(!$this->accessMenuAuthorization('User Privileges')){ 
             return view('errors.403');
        }
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'User Privileges');  
        $listUserPriviliges = UserPrivileges::all();    
        $listMenu = Menu::orderBy('name')->get();  
        $listGroupUser = GroupUser::all();
		return view('master/userPrivileges', compact('listUserPrivileges','listMenu','listGroupUser'));
        
	}
    public function create()
	{
		//
	} 
	public function store(Request $request)
	{
        $request['created_by']=Auth::user()->email; 
	    $input = $request->all();
        $this->validate($request,[
            'menu_id' => "required",  
            'group_user_id' => "required"     
        ]);
        
        $userPrivileges = UserPrivileges::create($input);
        return "User Privileges added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return UserPrivileges::find($id);
	}
 
	public function edit($id)
	{
		//
	}
 
	public function update(Request $request)
	{
        $request['updated_by']=Auth::user()->email; 
		$input = $request->all();
        $this->validate($request,[
            'menu_id' => "required",  
            'group_user_id' => "required"  
        ]);
        $id = $request->get('user_privileges_id');
        UserPrivileges::find($id)->update($input);   
        return "User Privileges updated successfully.";
	}
 
	public function destroy($userPrivilegesID)
	{
        UserPrivileges::find($userPrivilegesID)->delete();
        return "User Privileges deleted successfully.";
	}
    
    public function datatable(Request $request){
        $userPrivileges = DB::table('m_user_privileges AS userPrivileges')->select([
            'user_privileges_id',
            'userPrivileges.menu_id',
            'menu.name',
            'userPrivileges.group_user_id',
            'group_code',
            'group_detail',
            DB::raw(" 
            CASE 
                  WHEN view_data = 1 
                     THEN \"YES\" 
                  ELSE \"NO\"
            END as view_data"),
            DB::raw(" 
            CASE 
                  WHEN crud_access = 1 
                     THEN \"YES\" 
                  ELSE \"NO\"
            END as crud_access") 
        ])->join('m_menu AS menu', 'menu.menu_id', '=', 'userPrivileges.menu_id') 
            ->join('m_group_user AS groupUser', 'groupUser.group_user_id', '=', 'userPrivileges.group_user_id');
        return Datatables::of($userPrivileges) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->user_privileges_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->user_privileges_id.'" ></a></center>';  
                        })->make(true); 
    }
    
    public function exportExcel(){
        $userPrivileges = UserPrivileges::all();
            Excel::create('tes', function($excel) use($userPrivileges) {
                $excel->setTitle('Our new awesome title');  
                $excel->setTitle('Our new awesome title');  
                $excel->setCreator('tes')
                      ->setCompany('tes'); 
                $excel->setDescription('A demonstration to change the file properties');
                $excel->sheet('Sheet 1', function($sheet) use($userPrivileges) {
                    
                    $sheet->fromArray($userPrivileges, null, 'A2', true);
                    
                    $sheet->setFontFamily('Comic Sans MS'); 
                    $sheet->row(1, function($row) { 
                        $row->setBackground('#000000'); 
                    }); 
                    $sheet->row(2, array(
                        'Example Heading'
                    )); 
                    $sheet->setStyle(array(
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'bold'      =>  true
                        )
                    ));
                    
                });
            })->export('xls');
        return true;
    }
    //import
    //$results = Excel::load('app/example.csv')->get(); 
    

}
