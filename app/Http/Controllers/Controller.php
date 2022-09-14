<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth; 
use Mail; 
use View;
use Excel;
use DB;
use Illuminate\Http\Request; 
use App\GroupUser;  
use App\Project;  
use App\User;  
use App\LogTransaction; 
use App\Bank; 
use App\BankAccount; 

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     
    /*
        Created By  : RL
        Date        : 12/08/2016
        Detail      : User Menu Authorization  
    */
    public function accessMenuAuthorization($menuName){ 
        $listAuthMenu = session()->get('listMenu'); 
        for($i =0;$i<count($listAuthMenu);$i++){
            if($listAuthMenu[$i]['name'] === $menuName){ 
                return true;
            }
        }
        return false;
    }
    
    /*
        Created By  : RL
        Date        : 12/08/2016
        Detail      : List Project per user group
    */
    public function getListProjectSelectedUser(){
        //if admin , get all project for the list project, else only project that user has been set will be show
        $userID = Auth::user()->user_id; 
        $groupUserID = Auth::user()->group_user_id; 
        $groupUser = GroupUser::find($groupUserID);  
        if($groupUser->group_code === "ADMIN" || $groupUser->group_code === "DIR"){  
            //$listProject = Project::all(); 
            $listProject = Project::orderBy('pt_name', 'ASC')->orderBy('project_name', 'ASC')->get(); 
        } else{
            $listProject = session()->get('listProject');
        } 
        return $listProject;
    }
	
	public function getListProjectSelectedSummary(){
        //if admin , get all project for the list project, else only project that user has been set will be show
        $userID = Auth::user()->user_id; 
        $groupUserID = Auth::user()->group_user_id; 
        $groupUser = GroupUser::find($groupUserID);  
        if($groupUser->group_code === "ADMIN" || $groupUser->group_code === "DIR"){  
            //$listProject = Project::all(); 
            $listProject = Project::whereRaw(" project_name!='' AND project_id NOT IN (162,164,165,103,107,108,110,112,114,120,122,124,126,127,128,129,130,133,132,149,151,78,86)")->groupBy('project_name')->orderBy('project_name', 'ASC')->get();
            // $listProject = Project::whereRaw(" project_name!='' AND project_id IN (171)")->groupBy('project_name')->orderBy('project_name', 'ASC')->get(); 
        } else{
            $listProject = session()->get('listProject');
        } 
        return $listProject;
    }
    
	public function getListDepoBank($yearSelected,$monthSelected,$weekSelected,$projectSelected)
	{
        // $yearSelected = "";
        // if($request['yearSelected']){
            // $yearSelected = $request['yearSelected']; 
        // }
        // $monthSelected = "";
        // if($request['monthSelected']){
            // $monthSelected = $request['monthSelected']; 
        // }
        // $weekSelected = "";
        // if($request['weekSelected']){
            // $weekSelected = $request['weekSelected']; 
        // }
		$timeSelected = " 1 = 
                        CASE
                            WHEN a.year < ".$yearSelected."  THEN 1 
                            WHEN a.year = ".$yearSelected." THEN 
                                CASE 
                                    WHEN a.month < ".$monthSelected."  THEN 1 
                                    WHEN a.month = ".$monthSelected."  
                                        AND (a.week BETWEEN 1 AND ".$weekSelected.")  THEN 1  
                                    ELSE  0 
                                END 
                        END";
		$projectSelected = "";
        // if($projectSelected!="all88"){
            // $projectSelected = " AND a.project_id = ".$request['projectSelected']; 
        // } 	
        $depositSelected= " AND a.deposit_type = 'deposit'";
		$bankSelected= " AND b.bank_id = '4'";
		
		// $latestDepositRate = DB::table('t_deposit AS deposit')->select([ 
                        // 'bank_account_id as bankAccountID',
                        // 'percent_deposit as rate'
                     // ])->whereRaw('project_id ='.$projectSelectedID.' AND year ='.$latestYear.' AND month ='.$latestMonth.' AND week ='.$latestWeek)->get();
		$deposit = DB::table('t_deposit AS a')->select([
            'b.bank_id', 'd.bank_name',
			DB::raw('
            (   
                IFNULL(
                    (SELECT SUM(f.in)-SUM(f.out)
                    FROM t_deposit f 
                    WHERE f.project_id = a.project_id 
                    AND f.bank_account_id = a.bank_account_id    
                    AND 1 =  
                    CASE
                        WHEN f.year < a.year THEN 1
                        WHEN f.year = a.year THEN
                            CASE
                                WHEN f.month < a.month THEN 1
                                WHEN f.month = a.month AND f.week < a.week  THEN 1 
                                ELSE  0
                            END
                    END)
                ,0)+a.in-a.out
            ) 
            AS closing_balance'),
			DB::raw('SUM(IF(b.project_id=130,a.in-a.out,0)) as `BarsaCityYogya`'),
			DB::raw('SUM(IF(b.project_id=105,a.in-a.out,0)) as `Bizpark1Pulogadung`'),
			DB::raw('SUM(IF(b.project_id=106,a.in-a.out,0)) as `Bizpark2Penggilingan`'),
			DB::raw('SUM(IF(b.project_id=93,a.in-a.out,0)) as `Bizpark3Bekasi`'),
			DB::raw('SUM(IF(b.project_id=110,a.in-a.out,0)) as `BizparkBandung`'),
			DB::raw('SUM(IF(b.project_id=94,a.in-a.out,0)) as `BizparkPalembang`'),
			DB::raw('SUM(IF(b.project_id=121,a.in-a.out,0)) as `ByPassNgurahRai`'),
			DB::raw('SUM(IF(b.project_id=122,a.in-a.out,0)) as `CiputraGolf`'),
			DB::raw('SUM(IF(b.project_id=71,a.in-a.out,0)) as `CiputraWorldSurabaya`'),
			DB::raw('SUM(IF(b.project_id=74,a.in-a.out,0)) as `CitraGardenPekanBaru`'),
			DB::raw('SUM(IF(b.project_id=75,a.in-a.out,0)) as `CitraGrandSemarang`'),
			DB::raw('SUM(IF(b.project_id=72,a.in-a.out,0)) as `CitraHarmoniSidoarjo`'),
			DB::raw('SUM(IF(b.project_id=73 or b.project_id=143 or b.project_id=144,a.in-a.out,0)) as `CitraIndah`'),
			DB::raw('SUM(IF(b.project_id=96,a.in-a.out,0)) as `CitraGardenLampung`'),
			DB::raw('SUM(IF(b.project_id=95,a.in-a.out,0)) as `CitraGardenSidoarjo`'),
			DB::raw('SUM(IF(b.project_id=1,a.in-a.out,0)) as `CitragranCibubur`'),
			DB::raw('SUM(IF(b.project_id=126,a.in-a.out,0)) as `CitragranMutiara`'),
			DB::raw('SUM(IF(b.project_id=76,a.in-a.out,0)) as `CitraLandAmbon`'),
			DB::raw('SUM(IF(b.project_id=89,a.in-a.out,0)) as `CitraLandCibubur`'),
			DB::raw('SUM(IF(b.project_id=154,a.in-a.out,0)) as `CitraLandCityEastJakarta`'),
			DB::raw('SUM(IF(b.project_id=78 or b.project_id=120,a.in-a.out,0)) as `CitraLandDenpasar`'),
			DB::raw('SUM(IF(b.project_id=158,a.in-a.out,0)) as `CitraLandDriyorejo`'),
			DB::raw('SUM(IF(b.project_id=109,a.in-a.out,0)) as `CitraLandJayapura`'),
			DB::raw('SUM(IF(b.project_id=159,a.in-a.out,0)) as `CitraLandKedamean`'),
			DB::raw('SUM(IF(b.project_id=79,a.in-a.out,0)) as `CitraLandKendari`'),
			DB::raw('SUM(IF(b.project_id=140,a.in-a.out,0)) as `CitraLandLampung`'),
			DB::raw('SUM(IF(b.project_id=90,a.in-a.out,0)) as `CitraLandLosariMakassar`'),
			DB::raw('SUM(IF(b.project_id=80,a.in-a.out,0)) as `CitraLandManado`'),
			DB::raw('SUM(IF(b.project_id=149,a.in-a.out,0)) as `CitraLandPalembang`'),
			DB::raw('SUM(IF(b.project_id=97,a.in-a.out,0)) as `CitraLandPalu`'),
			DB::raw('SUM(IF(b.project_id=81,a.in-a.out,0)) as `CitraLandPekanBaru`'),
			DB::raw('SUM(IF(b.project_id=165,a.in-a.out,0)) as `CitraLandPuncakTidar`'),
			DB::raw('SUM(IF(b.project_id=163,a.in-a.out,0)) as `CitraLandSetiaBudi`'),
			DB::raw('SUM(IF(b.project_id=104,a.in-a.out,0)) as `CitraLandSurabaya`'),
			DB::raw('SUM(IF(b.project_id=91,a.in-a.out,0)) as `CitraLandTallasaCityMakassar`'),
			DB::raw('SUM(IF(b.project_id=92,a.in-a.out,0)) as `CitraLandUtaraSurabaya`'),
			DB::raw('SUM(IF(b.project_id=153,a.in-a.out,0)) as `CitraLandVittorio`'),
			DB::raw('SUM(IF(b.project_id=117,a.in-a.out,0)) as `CitraLandWinangunManado`'),
			DB::raw('SUM(IF(b.project_id=98,a.in-a.out,0)) as `CitraSunGardenSemarang`'),
			DB::raw('SUM(IF(b.project_id=82,a.in-a.out,0)) as `CitraSunGardenYogya`'),
			DB::raw('SUM(IF(b.project_id=99,a.in-a.out,0)) as `EstateCitraLandSurabaya`'),
			DB::raw('SUM(IF(b.project_id=139,a.in-a.out,0)) as `HotelCiputra(CSMH)`'),
			DB::raw('SUM(IF(b.project_id=141,a.in-a.out,0)) as `HotelCiputraCibubur`'),
			DB::raw('SUM(IF(b.project_id=147,a.in-a.out,0)) as `HotelCiputraWorldSurabaya`'),
			DB::raw('SUM(IF(b.project_id=155 or b.project_id=156,a.in-a.out,0)) as `KantorPusatJKT`'),
			DB::raw('SUM(IF(b.project_id=100,a.in-a.out,0)) as `KantorPusatSurabaya`'),
			DB::raw('SUM(IF(b.project_id=101,a.in-a.out,0)) as `MalCiputraCibubur`'),
			DB::raw('SUM(IF(b.project_id=84,a.in-a.out,0)) as `MallCiputraSerayaPekanBaru`'),
			DB::raw('SUM(IF(b.project_id=85,a.in-a.out,0)) as `MallCiputraWorldSurabaya`'),
			DB::raw('SUM(IF(b.project_id=146,a.in-a.out,0)) as `SekolahCiputra`'),
			DB::raw('SUM(IF(b.project_id=102,a.in-a.out,0)) as `TheGreenLakeSurabaya`'),
			DB::raw('SUM(IF(b.project_id=87,a.in-a.out,0)) as `TheTamanDayu`'),
			DB::raw('SUM(IF(b.project_id=145,a.in-a.out,0)) as `UniversitasCiputra`'),
			DB::raw('SUM(IF(b.project_id=129,a.in-a.out,0)) as `Waterpark`'),
			DB::raw('SUM(IF(b.project_id=119,a.in-a.out,0)) as `YayasanCitraBerkat`'),
			DB::raw('SUM(IF(b.project_id=118,a.in-a.out,0)) as `CitraLandKairagiManado`'),
			DB::raw('SUM(IF(b.project_id=169,a.in-a.out,0)) as `CitraLandHelvetia`'),
            DB::raw('SUM(IF(b.project_id=170,a.in-a.out,0)) as `CiputraWorldMakassar`'),
            DB::raw('SUM(IF(b.project_id=171,a.in-a.out,0)) as `UCMakassar`')
           
        ]) 

            ->leftJoin('m_bank_account as b', 'a.bank_account_id', '=', 'b.bank_account_id')
            ->join('m_project as c', 'a.project_id', '=', 'c.project_id')
			->join('m_bank as d', 'b.bank_id', '=', 'd.bank_id')
            // ->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected.$depositSelected)
			->whereRaw($projectSelected.$timeSelected)
            ->groupBy('d.bank_name')
            ->orderBy('d.bank_name','asc')->get();
			
		// $deposit = DB::table('t_deposit AS a')->select([
            // 'b.bank_id', 'd.bank_name','b.project_id','IF(b.project_id=130,1,0) AS test'
        // ])->leftJoin('m_bank_account as b', 'a.bank_account_id', '=', 'b.bank_account_id')
            // ->join('m_project as c', 'a.project_id', '=', 'c.project_id')
			// ->join('m_bank as d', 'b.bank_id', '=', 'd.bank_id')
            // // ->whereRaw($projectSelected.$yearSelected.$monthSelected.$weekSelected.$depositSelected)
			// ->whereRaw($projectSelected.$timeSelected)
            // ->groupBy('d.bank_name')
            // ->orderBy('d.bank_name','asc')->get();
			
		return $deposit;
    }
    /*
        Created By  : RL
        Date        : 14/02/2016
        Detail      : export data cashbank into html or excel
    */
     public function exportCashbankFile(Request $request,$transactionType){   
        $exportType     = $request['type_export'];
        $projectSelect  = $request['project'];
        $project        = Project::where('project_id',$projectSelect)->get(); 
        $projectName    = $project[0]->project_name;
        $yearSelect     = $request['year'];
        $monthSelect    = $request['month'];
        $startWeek      = $request['start_week'];
        $endWeek        = $request['end_week']; 
        
        if($endWeek<1 || $endWeek>5){
            $endWeek = $startWeek;
        }  
         
        $transaction;
        $path;
        if($transactionType == "cashbank"){
            $transaction = $this->getCashBank($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek);  
            $path = "app/cashbank/cashbankprintreport";
        } else if($transactionType == "deposit"){
            $transaction = $this->getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit'); 
            $path = "app/cashbank/depositprintreport";
        } else if($transactionType == "deposit_dk"){
            $transaction = $this->getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-dk'); 
            $path = "app/cashbank/depositprintreport";
        } else if($transactionType == "deposit_jo"){
            $transaction = $this->getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-jo'); 
            $path = "app/cashbank/depositprintreport";
        } else if($transactionType == "deposit_doc"){
            $transaction = $this->getDeposit($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-doc'); 
            $path = "app/cashbank/depositprintreport";
        } else if($transactionType == "escrow"){
            $transaction = $this->getEscrow($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek); 
            $path = "app/cashbank/escrowprintreport";
        } else if($transactionType == "bank_operational"){
            $transaction = $this->getBankOperational($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'operational'); 
            $path = "app/cashbank/bankoperationalprintreport";
        } else if($transactionType == "bank_operational_jo"){
            $transaction = $this->getBankOperational($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'operational-jo'); 
            $path = "app/cashbank/bankoperationalprintreport";
        } else if($transactionType == "rekber_jo"){
            $transaction = $this->getBankOperational($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'rekber-jo'); 
            $path = "app/cashbank/bankoperationalprintreport";
        } else if($transactionType == "reksadana"){
            $transaction = $this->getReksadana($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek, 'reksadana'); 
            $path = "app/cashbank/reksadanaprintreport";
        } else if($transactionType == "bank_loan"){
            $transaction = $this->getBankLoan($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek); 
            $path = "app/cashbank/bankloanprintreport";
        } else if($transactionType == "bank_dk"){
            $transaction = $this->getBankDK($projectSelect, $yearSelect, $monthSelect, $startWeek, $endWeek); 
            $path = "app/cashbank/bankdkprintreport";
        }
         
          
        if($exportType == "excel"){  
//            dd($transaction); 
            $monthSelect = date('F', mktime(0, 0, 0, $monthSelect));   
            
            
            $report = array();
                Excel::create('Report '.$transactionType, function($excel) use($report,$transaction,$transactionType,$projectName,$yearSelect,$monthSelect,$startWeek,$endWeek) {
                    $excel->setTitle('title');   
                    $excel->setCreator('Admin')
                          ->setCompany('Ciputra'); 
                    $excel->setDescription('A demonstration to change the file properties');
                    $excel->sheet('Sheet 1', function($sheet) use($report,$transaction,$transactionType,$projectName,$yearSelect,$monthSelect,$startWeek,$endWeek) {
                         
                        $totalOpeningBalance = 0;
                        $totalIn = 0;
                        $totalOut = 0;
                        $totalClosingBalance = 0;
                          
                        foreach ($transaction as $c) {  
                            $totalOpeningBalance += ($c->opening_balance); 
                            $totalIn += ($c->in_); 
                            $totalOut += ($c->out_); 
                            $totalClosingBalance += ($c->closing_balance); 
                            $c->opening_balance = number_format($c->opening_balance,0,",",".");
                            $c->in_ = number_format($c->in_,0,",",".");
                            $c->out_ = number_format($c->out_,0,",",".");
                            $c->closing_balance = number_format($c->closing_balance,0,",",".");
                            $report[] = (array)$c;
                        }    
//                        dd($report);
                        
                        
                        
                        $sheet->setFontFamily('Comic Sans MS');  
                        $sheet->row(1, array(
                            'Project :',$projectName
                        )); 
                        $sheet->row(2, array(
                            'Month :',$monthSelect." ".$yearSelect
                        )); 
                        $sheet->row(3, array(
                            'Week :',$startWeek." - ".$endWeek
                        ));  
                        $sheet->setStyle(array(
                            'font' => array(
                                'name'      =>  'Calibri',
                                'size'      =>  12 
                            )
                        ));
//                        // Set multiple column formats
//                        $sheet->setColumnFormat(array( 
//                            'C' => '0,00',
//                            'D' => '0,00',
//                            'E' => '0,00',
//                            'F' => '0,00',
//                        ));

                        $sheet->fromArray($report, null, 'B5', true)->setColumnFormat(array( 
                            'C' => '0,00',
                            'D' => '0,00',
                            'E' => '0,00',
                            'F' => '0,00',
                        ));
                        if($transactionType == "deposit"){
                            $sheet->row(count($transaction)+7, array(
                                '','Total :','',$totalOpeningBalance,$totalIn,$totalOut,$totalClosingBalance
                            ));
                        } else{
                            $sheet->row(count($transaction)+7, array(
                                '','Total :',$totalOpeningBalance,$totalIn,$totalOut,$totalClosingBalance
                            )); 
                        }
                         
                        
                        
                        $sheet->row(4, function($row) { 
                            $row->setBackground('#000000'); 
                        }); 
//                         $sheet->row(5, function($row) { 
//                            $row->setBorder('solid', 'solid', 'solid', 'solid');
//                        }); 
                        $sheet->cells("C4:C50", function($cells) { 
                            $cells->setAlignment('right'); 
                        });
                        $sheet->cells("D4:D50", function($cells) { 
                            $cells->setAlignment('right'); 
                        });
                        $sheet->cells("E4:E50", function($cells) { 
                            $cells->setAlignment('right'); 
                        });
                        $sheet->cells("F4:F50", function($cells) { 
                            $cells->setAlignment('right'); 
                        }); 
                    }); 
                })->export('xls');
//            ->store('xls')->export('xls');
            return true; 
        } else{    
            $totalOpeningBalance = 0;
            $totalIn = 0;
            $totalOut = 0;
            $totalClosingBalance = 0;

            foreach ($transaction as $c) {  
                $totalOpeningBalance += ($c->opening_balance); 
                $totalIn += ($c->in_); 
                $totalOut += ($c->out_); 
                $totalClosingBalance += ($c->closing_balance); 
                $c->opening_balance = number_format($c->opening_balance,0,",",".");
                $c->in_ = number_format($c->in_,0,",",".");
                $c->out_ = number_format($c->out_,0,",",".");
                $c->closing_balance = number_format($c->closing_balance,0,",","."); 
            }    
            $totalOpeningBalance = number_format($totalOpeningBalance,0,",",".");
            $totalIn = number_format($totalIn,0,",",".");
            $totalOut = number_format($totalOut,0,",",".");
            $totalClosingBalance = number_format($totalClosingBalance,0,",",".");    
            
            return view($path, compact(['transaction','projectName','yearSelect','monthSelect','startWeek','endWeek','totalOpeningBalance','totalIn','totalOut','totalClosingBalance'])); 
        }
         
    }
    //import
    //$results = Excel::load('app/example.csv')->get();  
    
    
    /*
        Created By  : RL
        Date        : 14/02/2016
        Detail      : Send report by email (cashbank app)
    */
    public function sendCashbankByEmail(Request $request){  
        // get request
        $projectIDSelected      = $request['project_id']; 
        $project                = Project::where('project_id',$projectIDSelected)->get(); 
        $ptName                 = $project[0]->pt_name; 
        $projectName            = $project[0]->project_name;
        $yearSelect             = $request['year'];;
        $monthSelect            = $request['month']; 
        $startWeek              = $request['start_week'];
        $endWeek                = $request['end_week'];
        if($endWeek == 0){
            $endWeek = $startWeek;
        }
        $mailTo=[];
        if($request['mail_to']!=""){
            $request['mail_to'] = trim($request['mail_to']);
            $mailTo = $request['mail_to'];
            //validation if there is user still using ;
            if(strpos($mailTo, ';')){
                $mailTo = explode(";",$mailTo);
            }else{
                $mailTo = explode(",",$mailTo);
            }  
        }
        $cc=[];
        if($request['cc']!=""){  
            $request['cc'] = trim($request['cc']);
            $cc = $request['cc'];
            //validation if there is user still using ;
            if(strpos($cc, ';')){
                $cc = explode(";",$cc);
            }else{
                $cc = explode(",",$cc);
            } 
        }
        $notes = $request['notes']; 
        $userEmail = Auth::user()->email;
        $userFullname = Auth::user()->first_name.Auth::user()->last_name;
        $isPreview = false;
        if($request['is_preview']){
            $isPreview=true; 
        } 
        
        //set Data 
        $listCashBank       = (new CashBankController)->getCashBank($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek);  
        $listDeposit        = (new DepositController)->getDeposit($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit');  
        $listDepositDK      = (new DepositController)->getDeposit($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-dk');
        $listDepositJO      = (new DepositController)->getDeposit($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-jo'); 
        $listDepositDOC     = (new DepositController)->getDeposit($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-doc');
        $listDepositDOCDK     = (new DepositController)->getDeposit($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'deposit-doc-dk'); 
        $listEscrow         = (new EscrowController)->getEscrow($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek);   
        $listBankOperational = (new BankOperationalController)->getBankOperational($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek,'operational');
        $listBankOperationalJO = (new BankOperationalController)->getBankOperational($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek,'operational-jo'); 
        $listRekberJO = (new BankOperationalController)->getBankOperational($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek,'rekber-jo');  
        $listReksadana      = (new ReksadanaController)->getReksadana($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek, 'reksadana');
        $listBankLoan   = (new BankLoanController)->getBankLoan($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek);  
        $listBankDK     = (new BankDKController)->getBankDK($projectIDSelected, $yearSelect, $monthSelect, $startWeek, $endWeek);  
         
         //dd($listDeposit);
        
        //t total cashbank
        $totalOpeningBalanceCashbank = 0;
        $totalInCashbank = 0;
        $totalOutCashbank = 0;
        $totalClosingBalanceCashbank = 0;
        
        $totalOpeningBalanceCashbankUSD = 0;
        $totalInCashbankUSD = 0;
        $totalOutCashbankUSD = 0;
        $totalClosingBalanceCashbankUSD = 0; 
        foreach ($listCashBank as $c) { 
            if($c->currency=='IDR'){
                $totalOpeningBalanceCashbank += ($c->opening_balance); 
                $totalInCashbank += ($c->in_); 
                $totalOutCashbank += ($c->out_); 
                $totalClosingBalanceCashbank += ($c->closing_balance); 
            }else{ 
                $totalOpeningBalanceCashbankUSD += ($c->opening_balance); 
                $totalInCashbankUSD += ($c->in_); 
                $totalOutCashbankUSD += ($c->out_); 
                $totalClosingBalanceCashbankUSD += ($c->closing_balance);
            }
        }   
        
        //set total deposit
        $totalOpeningBalanceDeposit = 0;
        $totalInDeposit = 0;
        $totalOutDeposit = 0;
        $totalClosingBalanceDeposit = 0;  
            $totalOpeningBalanceDepositUSD = 0;
            $totalInDepositUSD = 0;
            $totalOutDepositUSD = 0;
            $totalClosingBalanceDepositUSD = 0; 
        
        $totalOpeningBalanceDepositDK = 0;
        $totalInDepositDK = 0;
        $totalOutDepositDK = 0;
        $totalClosingBalanceDepositDK = 0; 
            $totalOpeningBalanceDepositDKUSD = 0;
            $totalInDepositDKUSD = 0;
            $totalOutDepositDKUSD = 0;
            $totalClosingBalanceDepositDKUSD = 0; 
        
        $totalOpeningBalanceDepositJO = 0;
        $totalInDepositJO = 0;
        $totalOutDepositJO = 0;
        $totalClosingBalanceDepositJO = 0; 
            $totalOpeningBalanceDepositJOUSD = 0;
            $totalInDepositJOUSD = 0;
            $totalOutDepositJOUSD = 0;
            $totalClosingBalanceDepositJOUSD = 0; 
        
        $totalOpeningBalanceDepositDOC = 0;
        $totalInDepositDOC = 0;
        $totalOutDepositDOC = 0;
        $totalClosingBalanceDepositDOC = 0; 
            $totalOpeningBalanceDepositDOCUSD = 0;
            $totalInDepositDOCUSD = 0;
            $totalOutDepositDOCUSD = 0;
            $totalClosingBalanceDepositDOCUSD = 0; 
        $hasTransactionDepositDOC = false;

        $totalOpeningBalanceDepositDOCDK = 0;
        $totalInDepositDOCDK = 0;
        $totalOutDepositDOCDK = 0;
        $totalClosingBalanceDepositDOCDK = 0; 
            $totalOpeningBalanceDepositDOCDKUSD = 0;
            $totalInDepositDOCDKUSD = 0;
            $totalOutDepositDOCDKUSD = 0;
            $totalClosingBalanceDepositDOCDKUSD = 0; 
        $hasTransactionDepositDOCDK = false;
        
        
        foreach ($listDeposit as $c) { 
            if($c->currency === 'IDR'){
                $totalOpeningBalanceDeposit += ($c->opening_balance); 
                $totalInDeposit += ($c->in_); 
                $totalOutDeposit += ($c->out_); 
                $totalClosingBalanceDeposit += ($c->closing_balance); 
            }else{ 
                $totalOpeningBalanceDepositUSD += ($c->opening_balance); 
                $totalInDepositUSD += ($c->in_); 
                $totalOutDepositUSD += ($c->out_); 
                $totalClosingBalanceDepositUSD += ($c->closing_balance); 
            }
        } 
        foreach ($listDepositDK as $c) {  
            if($c->currency==='IDR'){
                $totalOpeningBalanceDepositDK += ($c->opening_balance); 
                $totalInDepositDK += ($c->in_); 
                $totalOutDepositDK += ($c->out_); 
                $totalClosingBalanceDepositDK += ($c->closing_balance); 
            }else{
                $totalOpeningBalanceDepositDKUSD += ($c->opening_balance); 
                $totalInDepositDKUSD += ($c->in_); 
                $totalOutDepositDKUSD += ($c->out_); 
                $totalClosingBalanceDepositDKUSD += ($c->closing_balance); 
            }
        } 
        foreach ($listDepositJO as $c) {  
            if($c->currency==='IDR'){
                $totalOpeningBalanceDepositJO += ($c->opening_balance); 
                $totalInDepositJO += ($c->in_); 
                $totalOutDepositJO += ($c->out_); 
                $totalClosingBalanceDepositJO += ($c->closing_balance); 
            }else{
                $totalOpeningBalanceDepositJOUSD += ($c->opening_balance); 
                $totalInDepositJOUSD += ($c->in_); 
                $totalOutDepositJOUSD += ($c->out_); 
                $totalClosingBalanceDepositJOUSD += ($c->closing_balance); 
            }
        } 
        foreach ($listDepositDOC as $c) {   
            if($c->currency==='IDR'){
                $totalOpeningBalanceDepositDOC += ($c->opening_balance); 
                $totalInDepositDOC += ($c->in_); 
                $totalOutDepositDOC += ($c->out_); 
                $totalClosingBalanceDepositDOC += ($c->closing_balance); 
                if($c->in_ !=0 or $c->out_ !=0){
                    $hasTransactionDepositDOC = true;
                }   
            }else{
                $totalOpeningBalanceDepositDOCUSD += ($c->opening_balance); 
                $totalInDepositDOCUSD += ($c->in_); 
                $totalOutDepositDOCUSD += ($c->out_); 
                $totalClosingBalanceDepositDOCUSD += ($c->closing_balance); 
                if($c->in_ !=0 or $c->out_ !=0){
                    $hasTransactionDepositDOC = true;
                }
            }
        }

        foreach ($listDepositDOCDK as $c) {   
            if($c->currency==='IDR'){
                $totalOpeningBalanceDepositDOCDK += ($c->opening_balance); 
                $totalInDepositDOCDK += ($c->in_); 
                $totalOutDepositDOCDK += ($c->out_); 
                $totalClosingBalanceDepositDOCDK += ($c->closing_balance); 
                if($c->in_ !=0 or $c->out_ !=0){
                    $hasTransactionDepositDOCDK = true;
                }   
            }else{
                $totalOpeningBalanceDepositDOCDKUSD += ($c->opening_balance); 
                $totalInDepositDOCDKUSD += ($c->in_); 
                $totalOutDepositDOCDKUSD += ($c->out_); 
                $totalClosingBalanceDepositDOCDKUSD += ($c->closing_balance); 
                if($c->in_ !=0 or $c->out_ !=0){
                    $hasTransactionDepositDOCDK = true;
                }
            }
        } 
         
        //set total Escrow
        $totalOpeningBalanceEscrow = 0;
        $totalInEscrow = 0;
        $totalOutEscrow = 0;
        $totalClosingBalanceEscrow = 0; 
        foreach ($listEscrow as $c) { 
            $totalOpeningBalanceEscrow += ($c->opening_balance); 
            $totalInEscrow += ($c->in_); 
            $totalOutEscrow += ($c->out_); 
            $totalClosingBalanceEscrow += ($c->closing_balance); 
        } 
         
        //set total Bank Operational
        $totalOpeningBalanceBankOperational = 0;
        $totalInBankOperational = 0;
        $totalOutBankOperational = 0;
        $totalClosingBalanceBankOperational = 0;   
            $totalOpeningBalanceBankOperationalUSD = 0;
            $totalInBankOperationalUSD = 0;
            $totalOutBankOperationalUSD = 0;
            $totalClosingBalanceBankOperationalUSD = 0;  
        
        //set total Bank Operational - JO
        $totalOpeningBalanceBankOperationalJO = 0;
        $totalInBankOperationalJO = 0;
        $totalOutBankOperationalJO = 0;
        $totalClosingBalanceBankOperationalJO = 0; 
            $totalOpeningBalanceBankOperationalJOUSD = 0;
            $totalInBankOperationalJOUSD = 0;
            $totalOutBankOperationalJOUSD = 0;
            $totalClosingBalanceBankOperationalJOUSD = 0;
        
        //set total REKBER - JO
        $totalOpeningBalanceRekberJO = 0;
        $totalInRekberJO = 0;
        $totalOutRekberJO = 0;
        $totalClosingBalanceRekberJO = 0;  
            $totalOpeningBalanceRekberJOUSD = 0;
            $totalInRekberJOUSD = 0;
            $totalOutRekberJOUSD = 0;
            $totalClosingBalanceRekberJOUSD = 0; 
        
         //set total Reksadana
         $totalOpeningBalanceReksadana = 0;
         $totalInReksadana = 0;
         $totalOutReksadana = 0;
         $totalClosingBalanceReksadana = 0;   
             $totalOpeningBalanceReksadanaUSD = 0;
             $totalInReksadanaUSD = 0;
             $totalOutReksadanaUSD = 0;
             $totalClosingBalanceReksadanaUSD = 0;
        
        foreach ($listBankOperational as $c) {  
            if($c->currency === 'IDR'){
                $totalOpeningBalanceBankOperational += ($c->opening_balance); 
                $totalInBankOperational += ($c->in_); 
                $totalOutBankOperational += ($c->out_); 
                $totalClosingBalanceBankOperational += ($c->closing_balance);
            }else{ 
                $totalOpeningBalanceBankOperationalUSD += ($c->opening_balance); 
                $totalInBankOperationalUSD += ($c->in_); 
                $totalOutBankOperationalUSD += ($c->out_); 
                $totalClosingBalanceBankOperationalUSD += ($c->closing_balance); 
            }  
        } 
        foreach ($listBankOperationalJO as $c) {     
            if($c->currency === 'IDR'){
                $totalOpeningBalanceBankOperationalJO += ($c->opening_balance); 
                $totalInBankOperationalJO += ($c->in_); 
                $totalOutBankOperationalJO += ($c->out_); 
                $totalClosingBalanceBankOperationalJO += ($c->closing_balance); 
            }else{ 
                $totalOpeningBalanceBankOperationalJOUSD += ($c->opening_balance); 
                $totalInBankOperationalJOUSD += ($c->in_); 
                $totalOutBankOperationalJOUSD += ($c->out_); 
                $totalClosingBalanceBankOperationalJOUSD += ($c->closing_balance);  
            }   
        } 
        foreach ($listRekberJO as $c) {    
        if($c->currency === 'IDR'){
                $totalOpeningBalanceRekberJO += ($c->opening_balance); 
                $totalInRekberJO += ($c->in_); 
                $totalOutRekberJO += ($c->out_); 
                $totalClosingBalanceRekberJO += ($c->closing_balance); 
            }else{ 
                $totalOpeningBalanceRekberJOUSD += ($c->opening_balance); 
                $totalInRekberJOUSD += ($c->in_); 
                $totalOutRekberJOUSD += ($c->out_); 
                $totalClosingBalanceRekberJOUSD += ($c->closing_balance);   
            }  
             
        }
        foreach ($listReksadana as $c) {  
            if($c->currency === 'IDR'){
                $totalOpeningBalanceReksadana += ($c->opening_balance); 
                $totalInReksadana += ($c->in_); 
                $totalOutReksadana += ($c->out_); 
                $totalClosingBalanceReksadana += ($c->closing_balance);
            }else{ 
                $totalOpeningBalanceReksadanaUSD += ($c->opening_balance); 
                $totalInReksadanaUSD += ($c->in_); 
                $totalOutReksadanaUSD += ($c->out_); 
                $totalClosingBalanceReksadanaUSD += ($c->closing_balance); 
            }  
        }   
         
        //set total BankLoan
        $totalOpeningBalanceBankLoan = 0;
        $totalInBankLoan = 0;
        $totalOutBankLoan = 0;
        $totalClosingBalanceBankLoan = 0; 
        foreach ($listBankLoan as $c) { 
            $totalOpeningBalanceBankLoan += ($c->opening_balance); 
            $totalInBankLoan += ($c->in_); 
            $totalOutBankLoan += ($c->out_); 
            $totalClosingBalanceBankLoan += ($c->closing_balance); 
        } 
         
        //set total BankDK
        $totalOpeningBalanceBankDK = 0;
        $totalInBankDK = 0;
        $totalOutBankDK = 0;
        $totalClosingBalanceBankDK = 0; 
        foreach ($listBankDK as $c) { 
            $totalOpeningBalanceBankDK += ($c->opening_balance); 
            $totalInBankDK += ($c->in_); 
            $totalOutBankDK += ($c->out_); 
            $totalClosingBalanceBankDK += ($c->closing_balance); 
        }  
        

        $data = [  
            'mail_to' => $mailTo,
            'cc' => $cc,
            'user_email' => $userEmail,
            'user_fullname' => $userFullname,
            'project_id' => $projectIDSelected,
            'year' => $yearSelect,
            'month_num' => $monthSelect,
            'month' => date('F', mktime(0, 0, 0, $monthSelect, 10)),
            'start_week' => $startWeek,
            'end_week' => $endWeek,
            'pt' => $ptName, 
            'project' => $projectName,   
            'is_preview' => $isPreview,  
            
            'list_cashbank' => $listCashBank,     
            'total_opening_balance_cashbank' => number_format($totalOpeningBalanceCashbank,0,",","."),
            'total_in_cashbank' => number_format($totalInCashbank,0,",","."),
            'total_out_cashbank' => number_format($totalOutCashbank,0,",","."),
            'total_closing_balance_cashbank' => number_format($totalClosingBalanceCashbank,0,",","."),
                'total_opening_balance_cashbank_usd' => number_format($totalOpeningBalanceCashbankUSD,0,",","."),
                'total_in_cashbank_usd' => number_format($totalInCashbankUSD,0,",","."),
                'total_out_cashbank_usd' => number_format($totalOutCashbankUSD,0,",","."),
                'total_closing_balance_cashbank_usd' => number_format($totalClosingBalanceCashbankUSD,0,",","."),
            
            'list_deposit' => $listDeposit,  
            'total_opening_balance_deposit' => number_format($totalOpeningBalanceDeposit,0,",","."),
            'total_in_deposit' => number_format($totalInDeposit,0,",","."),
            'total_out_deposit' => number_format($totalOutDeposit,0,",","."),
            'total_closing_balance_deposit' => number_format($totalClosingBalanceDeposit,0,",","."),
                'total_opening_balance_deposit_usd' => number_format($totalOpeningBalanceDepositUSD,0,",","."),
                'total_in_deposit_usd' => number_format($totalInDepositUSD,0,",","."),
                'total_out_deposit_usd' => number_format($totalOutDepositUSD,0,",","."),
                'total_closing_balance_deposit_usd' => number_format($totalClosingBalanceDepositUSD,0,",","."),
             
            'list_deposit_dk' => $listDepositDK,  
            'total_opening_balance_deposit_dk' => number_format($totalOpeningBalanceDepositDK,0,",","."),
            'total_in_deposit_dk' => number_format($totalInDepositDK,0,",","."),
            'total_out_deposit_dk' => number_format($totalOutDepositDK,0,",","."),
            'total_closing_balance_deposit_dk' => number_format($totalClosingBalanceDepositDK,0,",","."),
                'total_opening_balance_deposit_dk_usd' => number_format($totalOpeningBalanceDepositDKUSD,0,",","."),
                'total_in_deposit_dk_usd' => number_format($totalInDepositDKUSD,0,",","."),
                'total_out_deposit_dk_usd' => number_format($totalOutDepositDKUSD,0,",","."),
                'total_closing_balance_deposit_dk_usd' => number_format($totalClosingBalanceDepositDKUSD,0,",","."),
             
            'list_deposit_jo' => $listDepositJO,  
            'total_opening_balance_deposit_jo' => number_format($totalOpeningBalanceDepositJO,0,",","."),
            'total_in_deposit_jo' => number_format($totalInDepositJO,0,",","."),
            'total_out_deposit_jo' => number_format($totalOutDepositJO,0,",","."),
            'total_closing_balance_deposit_jo' => number_format($totalClosingBalanceDepositJO,0,",","."),
                'total_opening_balance_deposit_jo_usd' => number_format($totalOpeningBalanceDepositJOUSD,0,",","."),
                'total_in_deposit_jo_usd' => number_format($totalInDepositJOUSD,0,",","."),
                'total_out_deposit_jo_usd' => number_format($totalOutDepositJOUSD,0,",","."),
                'total_closing_balance_deposit_jo_usd' => number_format($totalClosingBalanceDepositJOUSD,0,",","."),
             
            'list_deposit_doc' => $listDepositDOC,  
            'total_opening_balance_deposit_doc' => number_format($totalOpeningBalanceDepositDOC,0,",","."),
            'total_in_deposit_doc' => number_format($totalInDepositDOC,0,",","."),
            'total_out_deposit_doc' => number_format($totalOutDepositDOC,0,",","."),
            'total_closing_balance_deposit_doc' => number_format($totalClosingBalanceDepositDOC,0,",","."),
            'hasTransactionDepositDOC'=> $hasTransactionDepositDOC,
                'total_opening_balance_deposit_doc_usd' => number_format($totalOpeningBalanceDepositDOCUSD,0,",","."),
                'total_in_deposit_doc_usd' => number_format($totalInDepositDOCUSD,0,",","."),
                'total_out_deposit_doc_usd' => number_format($totalOutDepositDOCUSD,0,",","."),
                'total_closing_balance_deposit_doc_usd' => number_format($totalClosingBalanceDepositDOCUSD,0,",","."),

            'list_deposit_doc_dk' => $listDepositDOCDK,  
            'total_opening_balance_deposit_doc_dk' => number_format($totalOpeningBalanceDepositDOCDK,0,",","."),
            'total_in_deposit_doc_dk' => number_format($totalInDepositDOCDK,0,",","."),
            'total_out_deposit_doc_dk' => number_format($totalOutDepositDOCDK,0,",","."),
            'total_closing_balance_deposit_doc_dk' => number_format($totalClosingBalanceDepositDOCDK,0,",","."),
            'hasTransactionDepositDOCDK'=> $hasTransactionDepositDOCDK,
                'total_opening_balance_deposit_doc_dk_usd' => number_format($totalOpeningBalanceDepositDOCDKUSD,0,",","."),
                'total_in_deposit_doc_dk_usd' => number_format($totalInDepositDOCDKUSD,0,",","."),
                'total_out_deposit_doc_dk_usd' => number_format($totalOutDepositDOCDKUSD,0,",","."),
                'total_closing_balance_deposit_doc_dk_usd' => number_format($totalClosingBalanceDepositDOCDKUSD,0,",","."), 
            
            'list_escrow' => $listEscrow,  
            'total_opening_balance_escrow' => number_format($totalOpeningBalanceEscrow,0,",","."),
            'total_in_escrow' => number_format($totalInEscrow,0,",","."),
            'total_out_escrow' => number_format($totalOutEscrow,0,",","."),
            'total_closing_balance_escrow' => number_format($totalClosingBalanceEscrow,0,",","."),
            
            'list_bank_operational' => $listBankOperational,  
            'total_opening_balance_bank_operational' => number_format($totalOpeningBalanceBankOperational,0,",","."),
            'total_in_bank_operational' => number_format($totalInBankOperational,0,",","."),
            'total_out_bank_operational' => number_format($totalOutBankOperational,0,",","."),
            'total_closing_balance_bank_operational' => number_format($totalClosingBalanceBankOperational,0,",","."),  
                'total_opening_balance_bank_operational_usd' => number_format($totalOpeningBalanceBankOperationalUSD,0,",","."),
                'total_in_bank_operational_usd' => number_format($totalInBankOperationalUSD,0,",","."),
                'total_out_bank_operational_usd' => number_format($totalOutBankOperationalUSD,0,",","."),
                'total_closing_balance_bank_operational_usd' => number_format($totalClosingBalanceBankOperationalUSD,0,",","."),
             
            'list_bank_operational_jo' => $listBankOperationalJO,  
            'total_opening_balance_bank_operational_jo' => number_format($totalOpeningBalanceBankOperationalJO,0,",","."),
            'total_in_bank_operational_jo' => number_format($totalInBankOperationalJO,0,",","."),
            'total_out_bank_operational_jo' => number_format($totalOutBankOperationalJO,0,",","."),
            'total_closing_balance_bank_operational_jo' => number_format($totalClosingBalanceBankOperationalJO,0,",","."),  
                'total_opening_balance_bank_operational_jo_usd' => number_format($totalOpeningBalanceBankOperationalJOUSD,0,",","."),
                'total_in_bank_operational_jo_usd' => number_format($totalInBankOperationalJOUSD,0,",","."),
                'total_out_bank_operational_jo_usd' => number_format($totalOutBankOperationalJOUSD,0,",","."),
                'total_closing_balance_bank_operational_jo_usd' => number_format($totalClosingBalanceBankOperationalJOUSD,0,",","."), 
            
            'list_rekber_jo' => $listRekberJO,   
            'total_opening_balance_rekber_jo' => number_format($totalOpeningBalanceRekberJO,0,",","."),
            'total_in_rekber_jo' => number_format($totalInRekberJO,0,",","."),
            'total_out_rekber_jo' => number_format($totalOutRekberJO,0,",","."),
            'total_closing_balance_rekber_jo' => number_format($totalClosingBalanceRekberJO,0,",","."),  
                'total_opening_balance_rekber_jo_usd' => number_format($totalOpeningBalanceRekberJOUSD,0,",","."),
                'total_in_rekber_jo_usd' => number_format($totalInRekberJOUSD,0,",","."),
                'total_out_rekber_jo_usd' => number_format($totalOutRekberJOUSD,0,",","."),
                'total_closing_balance_rekber_jo_usd' => number_format($totalClosingBalanceRekberJOUSD,0,",","."), 
            
            'list_reksadana' => $listReksadana,  
            'total_opening_balance_reksadana' => number_format($totalOpeningBalanceReksadana,0,",","."),
            'total_in_reksadana' => number_format($totalInReksadana,0,",","."),
            'total_out_reksadana' => number_format($totalOutReksadana,0,",","."),
            'total_closing_balance_reksadana' => number_format($totalClosingBalanceReksadana,0,",","."),  
                'total_opening_balance_reksadana_usd' => number_format($totalOpeningBalanceReksadanaUSD,0,",","."),
                'total_in_reksadana_usd' => number_format($totalInReksadanaUSD,0,",","."),
                'total_out_reksadana_usd' => number_format($totalOutReksadanaUSD,0,",","."),
                'total_closing_balance_reksadana_usd' => number_format($totalClosingBalanceReksadanaUSD,0,",","."),

            'list_bank_loan' => $listBankLoan,  
            'total_opening_balance_bank_loan' => number_format($totalOpeningBalanceBankLoan,0,",","."),
            'total_in_bank_loan' => number_format($totalInBankLoan,0,",","."),
            'total_out_bank_loan' => number_format($totalOutBankLoan,0,",","."),
            'total_closing_balance_bank_loan' => number_format($totalClosingBalanceBankLoan,0,",","."),
            
            'list_bank_dk' => $listBankDK,  
            'total_opening_balance_bank_dk' => number_format($totalOpeningBalanceBankDK,0,",","."),
            'total_in_bank_dk' => number_format($totalInBankDK,0,",","."),
            'total_out_bank_dk' => number_format($totalOutBankDK,0,",","."),
            'total_closing_balance_bank_dk' => number_format($totalClosingBalanceBankDK,0,",","."),
            
            
            'notes' => $notes
        ]; 
        Mail::send('emails.allcashbankreport', $data, function ($mail) use($data)
        {  
        //   $mail->from("sh2mailsender@ciputra.com", $data['user_fullname']);
          $mail->from("sh2mailsender@ciputra.co.id", 'Mailsender SH2');
          $mail->to($data['mail_to']);
          if(count($data['cc'])>0){
            foreach($data['cc'] as $c){
                $mail->cc($c, $c); 
            } 
          }
          
          $mail->subject('CashBank Report :'.$data["pt"].' '.$data["project"]);
          $mail->replyTo($data['user_email'], 'Admin CashBank Ciputra');
//            $message->attach($pathToFile, array $options = []); 
//            // Attach a file from a raw $data string...
//            $message->attachData($data, "test", 'hgf');
        });
         
        
        //send to RIEKY
        // Mail::send('emails.allcashbankreport', $data, function ($mail) use($data)
        // {  
        //   $mail->from("sh2mailsender@ciputra.com", $data['user_fullname']);
        //   $mail->to('arman.djohan@ciputra.com'); 
        //   $mail->subject('CashBank Report :'.$data["pt"].' '.$data["project"]);
        //   $mail->replyTo($data['user_email'], 'Admin CashBank Ciputra'); 
        // });

        // Mail::send('emails.allcashbankreport', $data, function ($mail) use($data)
        // {  
        //   $mail->from("sh2mailsender@ciputra.com", $data['user_fullname']);
        //   $mail->to('fujhi.suryadi@ciputra.com'); 
        //   $mail->subject('CashBank Report :'.$data["pt"].' '.$data["project"]);
        //   $mail->replyTo($data['user_email'], 'Admin CashBank Ciputra'); 
        // });
        //Make Log 
        $detail = "Report ".date('F', mktime(0, 0, 0, $monthSelect, 10))." (".$startWeek."-".$endWeek.") "." ".$yearSelect;  
        $allMail = "";
        foreach($mailTo as $m){
            $allMail .= $m.",";
        }
        $detail = $detail." : ".$allMail." CC: ";
        foreach($cc as $c){  
            $detail = $detail.",".$c;
        } 
        
        $reportYear=$yearSelect;
        $reportMonth=$monthSelect;
        $reportWeek=($startWeek>$endWeek)?$startWeek:$endWeek;
 
        $nowMonthString     = date("F");  
        $listDatez          = array();
        $dateBegin          = $reportYear.'-'.$reportMonth.'-01';
        $dateEnd            = $reportYear.'-'.$reportMonth.'-' . date('t', strtotime($dateBegin)); //get end date of month
        while(strtotime($dateBegin) <= strtotime($dateEnd)) { 
            $day_name   = date('l', strtotime($dateBegin));
            $datez      = date("Y-m-d", strtotime($dateBegin));
            $dateBegin  = date("Y-m-d", strtotime("+1 day", strtotime($dateBegin)));
            if($day_name=="Friday"){
                array_push($listDatez, date("Y-m-d",strtotime("+3 day", strtotime($datez))));
            } 
        }  
        //dd($listDatez);
        $reportTargetDate = $listDatez[$reportWeek-1];
        $reportSendDate=date("Y-m-d");
        $this->setLogs($projectIDSelected,"send report email", $detail, 0, $reportYear, $reportMonth, $reportWeek, $reportTargetDate, $reportSendDate);
    }
    
    
    /*
        Created By  : RL
        Date        : 27/02/2017
        Detail      : Create Log
    */
    public function setLog($projectID, $activityType, $detail, $trID){
         
        $data = array(); 
        $data['username'] = Auth::user()->email;  
        $data['project_id'] = $projectID; 
        $data['activity_type'] = $activityType;
        $data['detail'] = $detail;
        $data['tr_id'] = $trID; 
        $data['created_by']=Auth::user()->email;
        LogTransaction::insert($data);   
    }
    
     /*
        Created By  : RL
        Date        : 27/02/2017
        Detail      : Create Log
    */
    public function setLogs($projectID, $activityType, $detail, $trID, $reportYear, $reportMonth, $reportWeek, $reportTargetDate, $reportSendDate){
         
        $data = array(); 
        $data['username'] = Auth::user()->email;  
        $data['project_id'] = $projectID; 
        $data['activity_type'] = $activityType;
        $data['detail'] = $detail;
        $data['tr_id'] = $trID; 
        $data['report_year'] = $reportYear; 
        $data['report_month'] = $reportMonth; 
        $data['report_week'] = $reportWeek; 
        $data['report_target_date'] = $reportTargetDate; 
        $data['report_send_date'] = $reportSendDate; 
        $data['created_by']=Auth::user()->email;
        LogTransaction::insert($data);   
    }
    
     /*
        Created By  : RL
        Date        : 05/04/2017
        Detail      : Get List bank html acount per project and transaction
    */
    public function getListBankAccountHTML($projectSelectedID, $trType){ 

        $listBank        = Bank::all();
        $listBankAccount = BankAccount::where([['project_id','=',$projectSelectedID],['transaction_type','=', $trType]])->orderBy('account_no')->get();
        $htmlText=""; 
        foreach($listBank as $bank){
            foreach($listBankAccount as $bankAccount){ 
                if($bank->bank_id === $bankAccount->bank_id){
                    $htmlText .= '
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input"> 
                                <label>'.
                                    $bank->bank_name.'&nbsp&nbsp'.$bankAccount->account_no.'&nbsp'.$bankAccount->account_detail.'&nbsp('.$bankAccount->currency.')
                                </label> 
                                <input type="hidden" name="bank_name_'.$bankAccount->bank_account_id.'" value="'.$bank->bank_name.'" class="form-control"> 
                                <label>Bank Account</label> 
                            </div>  
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_in" name="in_'.$bankAccount->bank_account_id.'"  placeholder="Enter In">
                                <label>In</label>
                                <span class="help-block">ex: 10000000</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_out" name="out_'.$bankAccount->bank_account_id.'"  placeholder="Enter Out">
                                <label>Out</label>
                                <span class="help-block">ex: 10000000</span>
                            </div> 
                        </div>
                    </div>';
                }
            } 
        }       
        $arrReturn = array(
            "listBank"          =>$listBank,
            "listBankAccount"   =>$listBankAccount,
            "htmlText"          =>$htmlText
        );
        return $arrReturn;
    }
    /*
        Created By  : RL
        Date        : 03/07/2017
        Detail      : Get List bank html acount per project and transaction for deposit only
    */
    public function getListBankAccountHTMLDeposit($projectSelectedID, $trType, $year, $month, $week){    
        //check latest record
        $result = DB::table('t_deposit AS deposit')->select([ 
            'year',
            'month',
            'week'
          ])->whereRaw('project_id ='.$projectSelectedID.' AND (year < '.$year.' or (year = '.$year.' AND (month < '.$month.' OR (month = '.$month.' AND week <='.$week.' ))))')
            ->groupBy('year','month','week')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('week', 'desc')
            ->take(1)
            ->get();  
        
        $latestDepositRate = null;
        if($result != null){
            $latestYear  = $result[0]->year;
            $latestMonth = $result[0]->month;
            $latestWeek  = $result[0]->week;

            //get value Rate Before
            $latestDepositRate = DB::table('t_deposit AS deposit')->select([ 
                        'bank_account_id as bankAccountID',
                        'percent_deposit as rate'
                     ])->whereRaw('project_id ='.$projectSelectedID.' AND year ='.$latestYear.' AND month ='.$latestMonth.' AND week ='.$latestWeek)->get();

        }
        
        $listBank        = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::where([['project_id','=',$projectSelectedID],['transaction_type','=', $trType]])->orderBy('account_no')->get();
        $htmlText        = ""; 
        
        foreach($listBank as $bank){
            foreach($listBankAccount as $bankAccount){ 
                if($bank->bank_id === $bankAccount->bank_id){
                    $htmlText .= '
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input"> 
                                <label>'.
                                    $bank->bank_name.'&nbsp&nbsp'.$bankAccount->account_no.'&nbsp'.$bankAccount->account_detail.'&nbsp('.$bankAccount->currency.')
                                </label> 
                                <input type="hidden" name="bank_name_'.$bankAccount->bank_account_id.'" value="'.$bank->bank_name.'" class="form-control"> 
                                <label>Bank Account</label> 
                            </div>  
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group form-md-line-input">
                                <div class="input-group right-addon">'; 
                                    $foundBankAccount = 0;  
                                    if($latestDepositRate != null){
                                        foreach($latestDepositRate as $rate){
                                            if($rate->bankAccountID == $bankAccount->bank_account_id){
                                                $foundBankAccount=1; 
                                                $htmlText .= '<input type="text" class="form-control create_in" name="percent_deposit_'.$bankAccount->bank_account_id.'"  placeholder="Enter Percent" value="'.$rate->rate.'">';
                                            }
                                        }
                                    }
                                    if($foundBankAccount == 0){
                                        $htmlText .= '<input type="text" class="form-control create_in" name="percent_deposit_'.$bankAccount->bank_account_id.'"  placeholder="Enter Percent">'; 
                                    }
                                    $htmlText .= '
                                    <label for="form_control_1">Percent Deposit</label>
                                    <span class="help-block">ex: 5 </span>
                                    <span class="input-group-addon">%</span>
                                </div> 
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_in" name="in_'.$bankAccount->bank_account_id.'"  placeholder="Enter In">
                                <label>In</label>
                                <span class="help-block">ex: 10000000</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_out" name="out_'.$bankAccount->bank_account_id.'"  placeholder="Enter Out">
                                <label>Out</label>
                                <span class="help-block">ex: 10000000</span>
                            </div> 
                        </div>
                    </div>';
                }
            }
        }       
        $arrReturn = array(
            "listBank"          =>$listBank,
            "listBankAccount"   =>$listBankAccount,
            "htmlText"          =>$htmlText
        );
        return $arrReturn;
    }

    /*
        Created By  : Fujhi
        Date        : 01/10/2021
        Detail      : Get List bank html acount per project and transaction for deposit only
    */
    public function getListBankAccountHTMLReksadana($projectSelectedID, $trType, $year, $month, $week){    
        //check latest record
        $result = DB::table('t_reksadana AS reksadana')->select([ 
            'year',
            'month',
            'week'
          ])->whereRaw('project_id ='.$projectSelectedID.' AND (year < '.$year.' or (year = '.$year.' AND (month < '.$month.' OR (month = '.$month.' AND week <='.$week.' ))))')
            ->groupBy('year','month','week')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('week', 'desc')
            ->take(1)
            ->get();  
        
        $latestReksadanaRate = null;
        if($result != null){
            $latestYear  = $result[0]->year;
            $latestMonth = $result[0]->month;
            $latestWeek  = $result[0]->week;

            //get value Rate Before
            $latestReksadanaRate = DB::table('t_reksadana AS reksadana')->select([ 
                        'bank_account_id as bankAccountID',
                        'percent_reksadana as rate'
                     ])->whereRaw('project_id ='.$projectSelectedID.' AND year ='.$latestYear.' AND month ='.$latestMonth.' AND week ='.$latestWeek)->get();

        }
        
        $listBank        = Bank::orderBy('bank_name')->get();
        $listBankAccount = BankAccount::where([['project_id','=',$projectSelectedID],['transaction_type','=', $trType]])->orderBy('account_no')->get();
        $htmlText        = ""; 
        
        foreach($listBank as $bank){
            foreach($listBankAccount as $bankAccount){ 
                if($bank->bank_id === $bankAccount->bank_id){
                    $htmlText .= '
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input"> 
                                <label>'.
                                    $bank->bank_name.'&nbsp&nbsp'.$bankAccount->account_no.'&nbsp'.$bankAccount->account_detail.'&nbsp('.$bankAccount->currency.')
                                </label> 
                                <input type="hidden" name="bank_name_'.$bankAccount->bank_account_id.'" value="'.$bank->bank_name.'" class="form-control"> 
                                <label>Bank Account</label> 
                            </div>  
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group form-md-line-input">
                                <div class="input-group right-addon">'; 
                                    $foundBankAccount = 0;  
                                    if($latestReksadanaRate != null){
                                        foreach($latestReksadanaRate as $rate){
                                            if($rate->bankAccountID == $bankAccount->bank_account_id){
                                                $foundBankAccount=1; 
                                                $htmlText .= '<input type="text" class="form-control create_in" name="percent_reksadana_'.$bankAccount->bank_account_id.'"  placeholder="Enter Percent" value="'.$rate->rate.'">';
                                            }
                                        }
                                    }
                                    if($foundBankAccount == 0){
                                        $htmlText .= '<input type="text" class="form-control create_in" name="percent_reksadana_'.$bankAccount->bank_account_id.'"  placeholder="Enter Percent">'; 
                                    }
                                    $htmlText .= '
                                    <label for="form_control_1">Percent Deposit</label>
                                    <span class="help-block">ex: 5 </span>
                                    <span class="input-group-addon">%</span>
                                </div> 
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_in" name="in_'.$bankAccount->bank_account_id.'"  placeholder="Enter In">
                                <label>In</label>
                                <span class="help-block">ex: 10000000</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control create_out" name="out_'.$bankAccount->bank_account_id.'"  placeholder="Enter Out">
                                <label>Out</label>
                                <span class="help-block">ex: 10000000</span>
                            </div> 
                        </div>
                    </div>';
                }
            }
        }       
        $arrReturn = array(
            "listBank"          =>$listBank,
            "listBankAccount"   =>$listBankAccount,
            "htmlText"          =>$htmlText
        );
        return $arrReturn;
    }

    public function isAdmin(){
        $groupUserID = Auth::user()->group_user_id; 
        $groupUser = GroupUser::find($groupUserID);  
        return ($groupUser->group_code === "ADMIN");
    }  
    
    /*
        Created By  : RL
        Date        : 16/05/2017
        Detail      : Get total value in transaction
    */
    public function getTotalValue($transaction, $project, $year, $month, $week){ 
         $checkEmptyRecord = DB::table($transaction.' AS transaction')->select( 
                            DB::raw('1 AS checkEmpty')
                         )->whereRaw('project_id ='.$project.' AND year ='.$year.' AND month ='.$month.' AND week ='.$week)->get();
		
		// $checkEmptyRecord = DB::table($transaction.' AS transaction')->count();
		
        // if($checkEmptyRecord==null){
			// //$result = DB::table($transaction.' AS transaction')->select([ 
             // //   DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalBefore'),
             // //   DB::raw('0 AS totalIn'),
             // //   DB::raw('0 AS totalOut'),
             // //   DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalAfter'), 
             // //])->whereRaw('project_id ='.$project.' AND year <='.$year.' AND (month < '.$month.' OR (month ='.$month.' AND week <='.$week.'))')->get();
             
             // // $result = DB::table($transaction.' AS transaction')->select([ 
                // // DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalBefore'),
                // // DB::raw('FORMAT(SUM(IF(transaction.year='.$year.' and transaction.month='.$month.' and transaction.week='.$week.',transaction.in, 0.00)),2) AS totalIn'),
                // // DB::raw('FORMAT(SUM(IF(transaction.year='.$year.' and transaction.month='.$month.' and transaction.week='.$week.',transaction.out, 0.00)),2) AS totalOut'),
                // // DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalAfter'), 
             // // ])->whereRaw('project_id ='.$project.' AND 
             // // (
             // // (year <'.$year.') OR
             // // (year = '.$year.' AND month < '.$month.') OR
             // // (year = '.$year.' AND month ='.$month.' AND week <='.$week.')
             // // )')->get();
			 
			 // $result = DB::table($transaction.' AS transaction')->select([ 
                // DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalBefore'),
                // DB::raw('"TEST" AS totalIn'),
                // DB::raw('0 AS totalOut'),
                // DB::raw('FORMAT(IFNULL(SUM(transaction.in)-SUM(transaction.out) ,0.00),2) AS totalAfter'), 
             // ])
			 // ->join('m_bank_account as c', 'transaction.bank_account_id', '=', 'c.bank_account_id')
			 // ->whereRaw('c.aktif=1 
			 // AND transaction.project_id ='.$project.' AND 
             // (
             // (transaction.`year` <'.$year.') OR
             // (transaction.`year` = '.$year.' AND transaction.`month` < '.$month.') OR
             // (transaction.`year` = '.$year.' AND transaction.`month` ='.$month.' AND transaction.`week` <='.$week.')
             // )
			 // ')->get();
		// }
		// else
		// {
	
            $result = DB::table($transaction.' AS transaction')->select([ 
                DB::raw('
                FORMAT(
                    IFNULL(
                        (SELECT SUM(a.in)-SUM(a.out) 
                        FROM '.$transaction.' a 
                        JOIN m_bank_account as b
						ON a.bank_account_id=b.bank_account_id
                        WHERE a.project_id = transaction.project_id
						AND b.aktif=1
                        AND 1 = 
                        CASE
                            WHEN a.year < transaction.year THEN 1
                            WHEN a.year = transaction.year THEN
                                CASE
                                    WHEN a.month < transaction.month THEN 1
                                    WHEN a.month = transaction.month AND a.week < transaction.week  THEN 1 
                                    ELSE  0
                                END
                        END)
                    ,0.00)
                ,2)
                AS totalBefore'),
                DB::raw('FORMAT(IFNULL(SUM(transaction.in),0),2) AS totalIn'),
                DB::raw('FORMAT(IFNULL(SUM(transaction.out),0),2) AS totalOut'),
                DB::raw(' 
                FORMAT(
                    IFNULL(
                        (SELECT SUM(a.in)-SUM(a.out)
                        FROM '.$transaction.' a 
                        JOIN m_bank_account as b
						ON a.bank_account_id=b.bank_account_id
                        WHERE a.project_id = transaction.project_id
						AND b.aktif=1 
						AND 1 =
                        CASE
                            WHEN a.year < transaction.year THEN 1
                            WHEN a.year = transaction.year THEN
                                CASE
                                    WHEN a.month < transaction.month THEN 1
                                    WHEN a.month = transaction.month AND a.week <=  transaction.week  THEN 1 
                                    ELSE  0
                                END
                        END)
                    ,0.00)   
                ,2)
                AS totalAfter'), 
             ])
			 ->join('m_bank_account as c', 'transaction.bank_account_id', '=', 'c.bank_account_id')
			 ->whereRaw('c.aktif=1 AND transaction.project_id ='.$project.' AND transaction.year ='.$year.' AND transaction.month ='.$month.' AND transaction.week ='.$week)->get();
        // }
		
        return $result; 
    }  
}


