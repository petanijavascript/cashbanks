<html> 
<style>
    #container{
        padding:40px; 
    }
    .img{
        padding:20px;
        text-align: center;
        background:#2c3e50;
    }
    table{
        border-spacing: 30px;
        border-collapse: collapse;
        font-size:14px;
    }
    table thead th:first-child{ text-align: center; }
    table thead th{ text-align: right; padding-left: 20px;}
    table tr td:first-child { text-align: left; }
    table tr td{  
        padding-left: 30px;
        padding-bottom: 2px;
        text-align: right; 
        line-height: 20px; 
        min-width: 130px;
        white-space: nowrap;
    }
    table tfooter tr td{
        font-weight: bold;
    }
</style>
<div id="container"> 
    <div class="img">
        <img src="{{asset('global/img/logo-header.png')}}" alt="logo" height="100px"/>
    </div>
    <p>Dear Bapak/Ibu,</p><p></p><p></p><p></p>
    <p>Berikut saya kirimkan  laporan saldo Kas dan Bank @if(trim($pt)!="") {{$pt}}, @endif {{$project}}.</p><p></p><p></p> 
    <p>Per minggu ke {{$start_week}} @if($start_week != $end_week) - {{$end_week}} @endif pada bulan {{$month}} {{$year}}  </p> 
    <table>
        <tbody>
            @if($total_closing_balance_cashbank != 0)
            <tr>
                <td style="min-width:200px">Total Saldo Cash :</td><td>{{$total_closing_balance_cashbank}}</td>
            </tr>
			@endif
            @if($total_closing_balance_bank_operational != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Bank Operational :</td><td>{{$total_closing_balance_bank_operational}}</td>
                </tr>
            @endif
            @if($total_closing_balance_bank_operational_jo != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Bank Operational - JO :</td><td>{{$total_closing_balance_bank_operational_jo}}</td>
                </tr>
            @endif
            @if($total_closing_balance_rekber_jo != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Rekening Bersama - JO :</td><td>{{$total_closing_balance_rekber_jo}}</td>
                </tr>
            @endif
            @if($total_closing_balance_bank_dk != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Bank Dana Kebersamaan :</td><td>{{$total_closing_balance_bank_dk}}</td>
                </tr>
            @endif
            @if($total_closing_balance_bank_loan != 0)
                <tr>
                    <td style="min-width:200px">Total Bank Loan :</td><td>{{$total_closing_balance_bank_loan}}</td>
                </tr>
            @endif
            @if($total_closing_balance_deposit != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Deposito :</td><td>{{$total_closing_balance_deposit}}</td>
                </tr>
            @endif
            @if($total_closing_balance_deposit_dk != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Deposito Dana Kebersamaan :</td><td>{{$total_closing_balance_deposit_dk}}</td>
                </tr>
            @endif
            @if($total_closing_balance_deposit_doc != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Deposito On Call :</td><td>{{$total_closing_balance_deposit_doc}}</td>
                </tr>
            @endif
            @if($total_closing_balance_escrow != 0)
                <tr>
                    <td style="min-width:200px">Total Saldo Escrow :</td><td>{{$total_closing_balance_escrow}}</td>
                </tr>
            @endif
			<tr><td colspan="2"><hr></td></tr>
        </tbody>
    </table>
         
	
	@if($total_closing_balance_cashbank != 0)	 
    <p><strong>Cash</strong></p>
    <table>
        <thead>
            <th>Bank Account</th>
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_cashbank as $c) 
                <tr>
                    <td>{{$c->bank_account_report}}</td>
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr> 
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_cashbank}} </td>
                <td>{{$total_in_cashbank}} </td>
                <td>{{$total_out_cashbank}} </td>
                <td>{{$total_closing_balance_cashbank}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table> 
    @endif 
     
   
    
    @if($total_closing_balance_bank_operational != 0) 
    <p><strong>Bank Operational</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_bank_operational as $c)  
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr>  
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_bank_operational}} </td>
                <td>{{$total_in_bank_operational}} </td>
                <td>{{$total_out_bank_operational}} </td>
                <td>{{$total_closing_balance_bank_operational}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
	
    
    @if($total_closing_balance_bank_operational_jo != 0) 
    <p><strong>Bank Operational - JO</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_bank_operational_jo as $c)  
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr>  
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_bank_operational_jo}} </td>
                <td>{{$total_in_bank_operational_jo}} </td>
                <td>{{$total_out_bank_operational_jo}} </td>
                <td>{{$total_closing_balance_bank_operational_jo}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
	
    @if($total_closing_balance_rekber_jo != 0) 
    <p><strong>Rekening Bersama - JO</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_rekber_jo as $c)  
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr>  
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_rekber_jo}} </td>
                <td>{{$total_in_rekber_jo}} </td>
                <td>{{$total_out_rekber_jo}} </td>
                <td>{{$total_closing_balance_rekber_jo}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
    @endif
	
    
    @if($total_closing_balance_bank_dk != 0)  
    <p><strong>Bank Dana Kebersamaan</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_bank_dk as $c) 
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr> 
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_bank_dk}} </td>
                <td>{{$total_in_bank_dk}} </td>
                <td>{{$total_out_bank_dk}} </td>
                <td>{{$total_closing_balance_bank_dk}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
    
	
	@if($total_closing_balance_bank_loan != 0) 
    <p><strong>Bank Loan</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_bank_loan as $c) 
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr> 
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_bank_loan}} </td>
                <td>{{$total_in_bank_loan}} </td>
                <td>{{$total_out_bank_loan}} </td>
                <td>{{$total_closing_balance_bank_loan}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
    
    
	 @if($total_closing_balance_deposit != 0) 
    <p><strong>Deposito</strong></p>
    <table>
        <thead>
            <th>Bank Account</th>
            <th>Percent Deposit</th>
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_deposit as $c) 
                @if($c->deposit_type=="deposit" || $c->deposit_type=="deposit-doc")
                <tr>
                    <td>{{$c->bank_account}}</td> 
                    <td>{{$c->percent_deposit}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr> 
                @endif
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td></td>
                <td>{{$total_opening_balance_deposit}} </td>
                <td>{{$total_in_deposit}} </td>
                <td>{{$total_out_deposit}} </td>
                <td>{{$total_closing_balance_deposit}} </td>
            </tr>
            <tr>
                <td colspan="6"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
    
    
	@if($total_closing_balance_deposit_dk != 0) 
    <p><strong>Deposito Dana Kebersamaan</strong></p>
    <table>
        <thead>
            <th>Bank Account</th>
            <th>Percent Deposit</th>
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_deposit_dk as $c)  
                <tr>
                    <td>{{$c->bank_account}}</td> 
                    <td>{{$c->percent_deposit}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr>  
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td></td>
                <td>{{$total_opening_balance_deposit_dk}} </td>
                <td>{{$total_in_deposit_dk}} </td>
                <td>{{$total_out_deposit_dk}} </td>
                <td>{{$total_closing_balance_deposit_dk}} </td>
            </tr>
            <tr>
                <td colspan="6"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
	
    
	@if($total_closing_balance_deposit_doc != 0) 
    <p><strong>Deposito On Call</strong></p>
    <table>
        <thead>
            <th>Bank Account</th>
            <th>Percent Deposit</th>
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_deposit_doc as $c)  
                <tr>
                    <td>{{$c->bank_account}}</td> 
                    <td>{{$c->percent_deposit}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr>  
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td></td>
                <td>{{$total_opening_balance_deposit_doc}} </td>
                <td>{{$total_in_deposit_doc}} </td>
                <td>{{$total_out_deposit_doc}} </td>
                <td>{{$total_closing_balance_deposit_doc}} </td>
            </tr>
            <tr>
                <td colspan="6"><hr></td>
            </tr>
        </tfooter>
    </table> 
	@endif
    
    
	 @if($total_closing_balance_escrow != 0) 
    <p><strong>Escrow</strong></p>
    <table>
        <thead>
            <th>Bank Account</th> 
            <th>Opening Balance</th>
            <th>IN</th>
            <th>OUT</th>
            <th>Closing Balance</th>
        </thead>
        <tbody>
            @foreach($list_escrow as $c) 
                <tr>
                    <td>{{$c->bank_account_report}}</td> 
                    <td>{{number_format($c->opening_balance,0,",",".")}}</td>
                    <td>{{number_format($c->in_,0,",",".")}}</td>
                    <td>{{number_format($c->out_,0,",",".")}}</td>
                    <td>{{number_format($c->closing_balance,0,",",".")}}</td>
                </tr> 
            @endforeach  
            <tr>
                <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
            </tr>                        
        </tbody>
        <tfooter> 
            <tr>
                <td>Total Saldo</td>
                <td>{{$total_opening_balance_escrow}} </td>
                <td>{{$total_in_escrow}} </td>
                <td>{{$total_out_escrow}} </td>
                <td>{{$total_closing_balance_escrow}} </td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
        </tfooter>
    </table>
	@endif
    
<p><pre> 
note:
<p></p>
<p>{{$notes}}</p>
<p></p>
</pre>
</p>


@if($total_closing_balance_cashbank != 0)
	<p>
	Untuk detail saldo Kas, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/cashbank?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&type_export=excel" target="_blank">disini</a>. 
	</p>
@endif
@if($total_closing_balance_bank_operational != 0)        
	<p>
	Untuk detail saldo Bank Operational, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/bankoperational?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&operational_type=bank_operational&type_export=excel">disini</a>.
	</p>
@endif
@if($total_closing_balance_bank_operational_jo != 0)      
	<p>
	Untuk detail saldo Bank Operational-JO, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/bankoperational?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&operational_type=bank_operational_jo&type_export=excel">disini</a>.
	</p> 
@endif   
@if($total_closing_balance_rekber_jo != 0) 
	<p>
	Untuk detail saldo Rekber-JO, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/bankoperational?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&operational_type=rekber_jo&type_export=excel">disini</a>.
	</p> 
@endif	
@if($total_closing_balance_bank_dk != 0) 	
	<p>
	Untuk detail saldo Bank Dana Kebersamaan, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/bankdk?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&type_export=excel">disini</a>.
	</p> 
@endif	
@if($total_closing_balance_bank_loan != 0) 	
	<p>
	Untuk detail saldo Bank Loan, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/bankloan?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&type_export=excel">disini</a>.
	</p> 
@endif
@if($total_closing_balance_deposit != 0) 
	<p>
	Untuk detail saldo Deposito, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/deposit?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&deposit_type=deposit&type_export=excel">disini</a>.
	</p> 
@endif
@if($total_closing_balance_deposit_dk != 0) 
	<p>
	Untuk detail saldo Deposito DK, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/deposit?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&deposit_type=deposit_dk&type_export=excel">disini</a>.
	</p> 
@endif
@if($total_closing_balance_deposit_doc != 0) 
	<p>
	Untuk detail saldo Deposito On Call, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/deposit?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&deposit_type=deposit_doc&type_export=excel">disini</a>.
	</p> 
@endif		
@if($total_closing_balance_escrow != 0)   
	<p>
	Untuk detail saldo Escrow, silahkan klik <a href="http://cashbank.ciputragroup.com/cashbank/public/export/excel/escrow?project={{$project_id}}&year={{$year}}&month={{$month_num}}&start_week={{$start_week}}&end_week={{$end_week}}&type_export=excel">disini</a>.
	</p> 
@endif    
<p>   
Terima kasih,
{{$user_fullname}}
</p> 

<div class="footer">
    <hr> 
    Ciputra Group</br></br>
    I N T E G R I T Y | P R O F E S S I O N A L I S M | E N T R E P R E N E U R S H I P</br></br>
    Ciputra World Jakarta 1</br>
    Jl. Prof. Dr. Satrio Kav 3-5 Jakarta 12940</br>  
</div>


</div>
</html>