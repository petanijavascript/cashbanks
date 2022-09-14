<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
class ProjectController extends Controller {

   
    
	public function index()
	{
        if(!$this->accessMenuAuthorization('Project')){ 
             return view('errors.403');
        }
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Project');  
        $listProject = Project::all();    
		return view('master/project', compact('listProject'));
        
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
            "project_location" => "required",
            "project_location_group" => "required"    
        ]);
        
        $project = Project::create($input);
        return "Project added successfully.";
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
            "project_location" => "required",
            "project_location_group" => "required"
        ]);
        $id = $request->get('project_id');
        Project::find($id)->update($input);   
        return "Project updated successfully.";
	}
 
	public function destroy($projectID)
	{
        Project::find($projectID)->delete();
        return "Project deleted successfully.";
	}
    
    public function datatable(Request $request){
        $project = Project::select([
            'project_id',
            'project_code',
            'pt_name',
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
    
    
    public function exportFile(Request $request){    
        
        $exportType = $request['type_export'];  
        $creator = Auth::user()->email; 
        $listProject = DB::table('m_project as project')->select('project_code','pt_name','project_name','project_location')->get(); 
         
        if($exportType == "excel"){  
            $report = array();
                Excel::create('List Project', function($excel) use($report,$creator,$listProject) {
                    $excel->setTitle('List Project');  
                    $excel->setCreator($creator)
                          ->setCompany('Ciputra'); 
                    $excel->setDescription('Project List Data');
                    $excel->sheet('Sheet 1', function($sheet) use($report,$creator,$listProject) {  
                        foreach ($listProject as $c) {   
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
            return view('master/projectprintreport', compact(['listProject'])); 
        }
    } 
    //import
    //$results = Excel::load('app/example.csv')->get(); 
    

}
