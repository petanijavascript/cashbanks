<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Application; 
use Illuminate\Http\Request;
use Datatables; 
use Auth;

class ApplicationController extends Controller {  
 
	public function index()
	{    
        if(!$this->accessMenuAuthorization("Application")){ 
             return view('errors.403');
        }
        $listApplication = Application::all();
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Application'); 
		return view('master/application', compact('listApplication'));
	}
    public function create()
	{	//
	} 
	public function store(Request $request)
	{ 
        $request['created_by']=Auth::user()->email; 
		$input = $request->all();  
        $this->validate($request,[
            'name' => "required"  
        ]);  
       
        $application = Application::create($input);
        return "Application added successfully.";
       
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Application::find($id);
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
            'name' => "required" 
        ]);
        $id = $request->get('app_id');
        Application::find($id)->update($input);   
        return "Application updated successfully.";
	}
 
	public function destroy($appID)
	{   
        Application::find($appID)->delete();
        return "Application deleted successfully.";
	}
 
    public function datatable(Request $request){
        $application = Application::select([
            'app_id',
            'name',
            'description'
        ]);
        return Datatables::of($application) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->app_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->app_id.'" ></a></center>';  
                        })->make(true); 
    }
//          
//    public function exportExcel(){
//        $application = GroupUser::all();
//            Excel::create('tes', function($excel) use($application) {
//                $excel->setTitle('Our new awesome title');  
//                $excel->setTitle('Our new awesome title');  
//                $excel->setCreator('tes')
//                      ->setCompany('tes'); 
//                $excel->setDescription('A demonstration to change the file properties');
//                $excel->sheet('Sheet 1', function($sheet) use($application) {
//                    
//                    $sheet->fromArray($application, null, 'A2', true);
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
