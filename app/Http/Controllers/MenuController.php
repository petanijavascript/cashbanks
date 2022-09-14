<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu; 
use App\Application;
use Illuminate\Http\Request;
use Datatables; 
use Auth;

class MenuController extends Controller {
 
	public function index()
	{   
        if(!$this->accessMenuAuthorization('Menu')){ 
             return view('errors.403');
        }
        $listMenu = Menu::all();
        $listParentMenu = Menu::all()->where('parent_menu_id', null); 
        $listApplication = Application::all();  
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Menu'); 
		return view('master/menu', compact(['listMenu','listParentMenu','listApplication']));
	}
    public function create()
	{	//
	} 
	public function store(Request $request)
	{   
        if($request['child_no']===""){
            $request['child_no'] = null;
        } 
        if($request['parent_menu_id']===""){
            $request['parent_menu_id'] = null;
        }
        $request['created_by']=Auth::user()->email; 
		$input = $request->all();  
        $this->validate($request,[
            'name' => "required",
            'app_id' => "required"   
        ]);  
       
        $menu = Menu::create($input); 
        return "Menu added successfully.";
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Menu::find($id);
	}
 
	public function edit($id)
	{
		//
	}
 
	public function update(Request $request)
	{   
        $request['updated_by']=Auth::user()->email; 
        if($request['parent_menu_id']=="")
            $request['parent_menu_id']=null;
        if($request['child_no']=="")
            $request['child_no']=null;
		$input = $request->all();
        $this->validate($request,[
            'name' => "required",
            'app_id' => "required" 
        ]);
        $id = $request->get('menu_id');
        Menu::find($id)->update($input); 
        return "Menu updated successfully.";  
	}
 
	public function destroy($menuID)
	{   
        Menu::find($menuID)->delete();
        return "Menu deleted successfully.";
	}
 
    public function datatable(Request $request){
        $menu = Menu::select([
            'menu_id',
            'm_menu.name',
            'parent_menu_id',
            'child_no',
            'm_application.name AS application_name',
            'link_to',
            'icon'
        ])->join('m_application', 'm_application.app_id', '=', 'm_menu.app_id');
        return Datatables::of($menu) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->menu_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->menu_id.'" ></a></center>';  
                        })->make(true); 
    }
//    
//    public function exportExcel(){
//        $groupUser = GroupUser::all();
//            Excel::create('tes', function($excel) use($groupUser) {
//                $excel->setTitle('Our new awesome title');  
//                $excel->setTitle('Our new awesome title');  
//                $excel->setCreator('tes')
//                      ->setCompany('tes'); 
//                $excel->setDescription('A demonstration to change the file properties');
//                $excel->sheet('Sheet 1', function($sheet) use($groupUser) {
//                    
//                    $sheet->fromArray($groupUser, null, 'A2', true);
//                    
//                    $sheet->setFontFamily('Comic Sans MS'); 
//                    $sheet->row(1, function($row) { 
//                        $row->setBackground('#000000'); 
//                    }); 
//                    $sheet->row(2, array(
//                        'Example Heading'
//                    )); 
//                    $sheet->setStyle(array(
//                        'font' => array(
//                            'name'      =>  'Calibri',
//                            'size'      =>  12,
//                            'bold'      =>  true
//                        )
//                    ));
//                    
//                });
//            })->export('xls');
//        return true;
//    }


}
