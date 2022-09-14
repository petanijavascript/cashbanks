<?php namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bank;
use Illuminate\Http\Request;
use Datatables;
use Auth;
use DB;
use Mail; 
class BankController extends Controller {

   
    
	public function index()
	{
        if(!$this->accessMenuAuthorization('Bank')){ 
             return view('errors.403');
        }
        session()->set('activeParentMenu', 'Master Data');  
        session()->set('activeChildMenu', 'Bank');  
        $listBank = Bank::all();    
		$isAdmin = $this->isAdmin();
		return view('master/bank', compact('isAdmin','listBank'));
        
	}
    public function create()
	{
		//
	} 
	public function store(Request $request)
	{ 
        if($this->isAdmin()){
            $request['created_by']=Auth::user()->email; 
            $input = $request->all();
            $this->validate($request,[
                'bank_name' => "required|unique:m_bank"   
            ]);

            $bank = Bank::create($input);
            return "Bank added successfully.";
        } else{
            //send email to notification
            $data = [ 'user'=>Auth::user()->email,'bank'=>$request['bank_name']];
            Mail::send('emails.reqbank', $data, function ($mail) use($data)
            {  
            //   $mail->from("sh2mailsender@ciputra.com", $data['user']);
              $mail->from("sh2mailsender@ciputra.co.id", 'Mailsender SH2');
              $mail->to('arman.djohan@ciputra.com'); 
              $mail->subject('Req master bank'); 
              $mail->replyTo($data['user'], 'User'); 
            });

            Mail::send('emails.reqbank', $data, function ($mail) use($data)
            {  
            //   $mail->from("sh2mailsender@ciputra.com", $data['user']);
              $mail->from("sh2mailsender@ciputra.co.id");
              $mail->to('fujhi.suryadi@ciputra.com'); 
              $mail->subject('Req master bank'); 
              $mail->replyTo($data['user'], 'User'); 
            });
			
            return "Bank will be added after admin approved.";
        } 
	}
 
	public function show(Request $request)
	{
        $id = $request->get('id');
		return Bank::find($id);
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
            'bank_name' => "required" 
        ]);
        $id = $request->get('bank_id');
        Bank::find($id)->update($input); 
        return "Bank updated successfully.";  
	}
 
	public function destroy($bankID)      
	{
        Bank::find($bankID)->delete();
        return "Bank deleted successfully."; 
	}
    
    public function datatable(Request $request){
        $bank = Bank::select([
            'bank_id', 
            'bank_name',
            'description',
            'created_by'
        ]);
        return Datatables::of($bank) 
                        ->addColumn('action_update', function($data){
                            if($this->isAdmin()){ 
                                return '<center><a class="btn_show fa fa-edit" data-toggle="modal" href="#edit_modal" data-id="'.$data->bank_id.'"></a></center>';
                            }
                        })
                        ->addColumn('action_delete', function($data){
                            if($this->isAdmin()){ 
                                return '<center><a class="btn_delete fa fa-trash" data-toggle="modal" href="#confirm-dialog" data-id="'.$data->bank_id.'" ></a></center>';  
                            }
                        })->make(true); 
    }
    
public function exportFile(Request $request){    
        
        $exportType = $request['type_export'];  
        $creator = Auth::user()->email; 
        $listBank = DB::table('m_bank as bank')->select('bank_name','description')->get(); 
         
        if($exportType == "excel"){  
            $report = array();
                Excel::create('List Bank', function($excel) use($report,$creator,$listBank) {
                    $excel->setTitle('List Bank');  
                    $excel->setCreator($creator)
                          ->setCompany('Ciputra'); 
                    $excel->setDescription('Bank List Data');
                    $excel->sheet('Sheet 1', function($sheet) use($report,$creator,$listBank) {  
                        foreach ($listBank as $c) {   
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
            return view('master/bankprintreport', compact(['listProject'])); 
        }
    } 

}
