<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\GroupUser;
use Illuminate\Http\Request;
use Datatables; 
use Auth;

class GroupUserController extends Controller {
 
	public function index()
	{   
        if(!$this->accessMenuAuthorization('Group User')){ 
             return view('errors.403');
        }
        $listGroupUser = GroupUser::orderBy('group_detail', 'asc')->get();  
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Group User'); 
		return view('master/groupuser', compact('listGroupUser'));
	}
    public function create()
	{	//
	} 
	public function store(Request $request)
	{ 
        $request['created_by']=Auth::user()->email; 
		$input = $request->all();  
        $this->validate($request,[
            'group_code' => "required",
            'group_detail' => "required"   
        ]);  
       
        $groupUser = GroupUser::create($input); 
        return "Group User added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return GroupUser::find($id);
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
            'group_code' => "required",
            "group_detail" => "required"
        ]);
        $id = $request->get('group_user_id');
        GroupUser::find($id)->update($input);   
        return "Group User updated successfully.";
	}
 
	public function destroy($groupUserID)
	{   
        GroupUser::find($groupUserID)->delete();
        return "GroupUser deleted successfully.";
	}
 
    public function datatable(Request $request){
		if(!$this->isAdmin()){
			dd("really sorry..");
		}
        $groupUser = GroupUser::select([
            'group_user_id',
            'group_code',
            'group_detail'
        ]);
        return Datatables::of($groupUser) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->group_user_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->group_user_id.'" ></a></center>';  
                        })->make(true); 
    }
    
    public function exportExcel(){
        $groupUser = GroupUser::all();
            Excel::create('tes', function($excel) use($groupUser) {
                $excel->setTitle('Our new awesome title');  
                $excel->setTitle('Our new awesome title');  
                $excel->setCreator('tes')
                      ->setCompany('tes'); 
                $excel->setDescription('A demonstration to change the file properties');
                $excel->sheet('Sheet 1', function($sheet) use($groupUser) {
                    
                    $sheet->fromArray($groupUser, null, 'A2', true);
                    
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


}
