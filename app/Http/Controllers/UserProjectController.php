<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserProject;
use Illuminate\Http\Request;
use Datatables;
use Auth;
class UserProjectController extends Controller {

   
    
	public function index()
	{
        if(!$this->accessMenuAuthorization('User Project')){ 
             return view('errors.403');
        }
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'User Project');  
        $listUserProject = UserProject::all();    
		return view('master/userproject', compact('listUserProject'));
        
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
            'project_name' => "required",
            "project_location" => "required",
            "project_location_group" => "required"    
        ]);
        
        $project = Project::create($input);
        return 'tess';
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Project::find($id);
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
            'project_name' => "required",
            "project_location" => "required",
            "project_location_group" => "required"
        ]);
        $id = $request->get('project_id');
        Project::find($id)->update($input);   
	}
 
	public function destroy($projectID)
	{
        Project::find($projectID)->delete();
	}
    
    public function datatable(Request $request){
        $project = Project::select([
            'project_id',
            'project_code',
            'project_name',
            'project_location',
            'project_location_group' 
        ]);
        return Datatables::of($project) 
                        ->addColumn('action_update', function($data){
                            return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->project_id.'"></a></center>';
                        })
                        ->addColumn('action_delete', function($data){
                            return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->project_id.'" ></a></center>';  
                        })->make(true); 
    }
    
    public function exportExcel(){
        $project = Project::all();
            Excel::create('tes', function($excel) use($project) {
                $excel->setTitle('Our new awesome title');  
                $excel->setTitle('Our new awesome title');  
                $excel->setCreator('tes')
                      ->setCompany('tes'); 
                $excel->setDescription('A demonstration to change the file properties');
                $excel->sheet('Sheet 1', function($sheet) use($project) {
                    
                    $sheet->fromArray($project, null, 'A2', true);
                    
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
