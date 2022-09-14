@extends('layouts.index') 
@show

@section('style')
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css"/>
	<style>
.zui-table {
    border: none;
    border-right: solid 1px #DDEFEF;
    border-collapse: separate;
    border-spacing: 0;
    font: normal 13px Arial, sans-serif;
	
}
.zui-table thead th {
    background-color: #DDEFEF;
    border: none;
    color: #336B6B;
    padding: 10px;
	width: 150px;
    text-align: left;
    text-shadow: 1px 1px 1px #fff;
    white-space: nowrap;
}
.zui-table tbody td {
	background-color: white;
	border: solid 1px #DDEFEF;
    border-bottom: solid 1px #DDEFEF;
    color: #333;
    padding: 15px;
    text-shadow: 1px 1px 1px #fff;
	word-wrap:break-word;
	width: 150px;
	text-align: right;
    /*white-space: nowrap;*/
}
.zui-wrapper {
    position: relative;
}
.zui-scroller {
    margin-left: 295px;
    overflow-x: scroll;
    overflow-y: visible;
    padding-bottom: 5px;
    width: 75%;
}
.zui-table .zui-sticky-col {
    border-left: solid 1px #DDEFEF;
    left: 0;
    position: absolute;
    top: auto;
	text-align: left;
}
.zui-table .zui-sticky-col2 {
    border-right: solid 1px #DDEFEF;
    left: 0;
	margin-left: 145px;
    position: absolute;
    top: auto;
}
	</style>
@endsection
@section('page-bar') 
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a> 
        </li> 
    </ul>
</div>
<h3 class="page-title"></h3>
<!-- END PAGE HEADER--> 
@endsection
    
@section('content') 
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="7800">Rp.{{$totalCashbank}}</span> </strong>
					</h4>
					<small>Total Cashbank Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">100% progress</span>
					</span>
				</div> 
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">	
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="1349">Rp.{{$totalDeposit}}</span></strong>
					</h4>
					<small>Total Deposit Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">100% change</span>
					</span>
				</div> 
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="7800">Rp.{{$totalEscrow}}</span> </strong>
					</h4>
					<small>Total Escrow Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">76% progress</span>
					</span>
				</div> 
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="7800">Rp.{{$totalBankOperational}}</span> </strong>
					</h4>
					<small>Total B.Operational Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">76% progress</span>
					</span>
				</div> 
			</div>
		</div> 
	</div> 
</div> 

 
<div class="row">  
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="7800">Rp.{{$totalBankLoan}}</span> </strong>
					</h4>
					<small>Total Bank Loan Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">76% progress</span>
					</span>
				</div> 
			</div>
		</div> 
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat2 ">
			<div class="display">
				<div class="number">
					<h4 class="font-green-sharp">
						<strong><span data-counter="counterup" data-value="7800">Rp.{{$totalBankDK}}</span> </strong>
					</h4>
					<small>Total Bank Dana Kebersamaan Balance</small>
				</div>
				<div class="icon">
					<i class="icon-pie-chart"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="progress">
					<span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
						<span class="sr-only">76% progress</span>
					</span>
				</div> 
			</div>
		</div> 
	</div>
</div>
@if((Auth::user()->email=='fujhi.suryadi@ciputra.com')or(Auth::user()->email=='harun@ciputra.com')or(Auth::user()->email=='nanik@ciputra.com')or(Auth::user()->email=='sutoto@ciputra.com'))
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="dashboard-stat2 ">
			<div class="row">
					<div class="col-md-12">
						<div class="btn-group pull-right" style="margin:5px 3px;">
							<div class="btn-group pull-right">Bank Name :
								<select class="table-group-action-input form-control input-inline input-sm" name="view_bank_selected">
									@foreach($listBank as $bank)
										<option value="{{$bank->bank_id}}">{{$bank->bank_name}}</option>
									@endforeach
								</select>
							</div>							
						</div>  
						<div class="btn-group pull-right" style="margin:5px 3px;">
							<div class="btn-group pull-right">Project : 
								<select class="table-group-action-input form-control input-inline input-sm" id="view_project_selected">
										<option value="all88">All Project</option>											
									@foreach($listProject as $p)
										<option value="{{$p->project_id}}">{{$p->project_name}}</option> 
									@endforeach 
								</select>  
							</div>
						</div>
					</div>
                    <div class="col-md-12">
						<div class="btn-group pull-right" style="margin:5px 3px;">
							<select class="table-group-action-input form-control input-inline input-sm" id="view_week_selected"> 
								<?php $week=1; ?>
									@foreach($listWeek as $w)
										<option value="{{$week}}" @if($week == $nowWeekNumber) {{'selected="selected"'}} @endif>Week {{$week++}}&nbsp({{$w}}&nbsp{{$nowMonthString}})</option>  
                                    @endforeach
                            </select>  
						</div> 
                    <div class="btn-group pull-right" style="margin:5px 3px;">
                        <select class="table-group-action-input form-control input-inline  input-sm" id="view_month_selected"> 
                            @for($m=1; $m<=12; $m++) 
                                <?php  
									$monthString = date('F', mktime(0,0,0,$m, 1, date('Y'))); 
								?>
                            <option value="{{$m}}" @if($m == $nowMonthNumber) {{'selected="selected"'}} @endif>{{$monthString}}</option>  
							@endfor 
						</select> 
					</div>
                    <div class="btn-group pull-right" style="margin:5px 3px;">
                        <select class="table-group-action-input form-control input-inline input-sm" id="view_year_selected"> 
                            <option value="2020">Year : 2020</option>
							<option value="2019">Year : 2019</option> 
                            <option value="2018">Year : 2018</option> 
							<option value="2017">Year : 2017</option> 
                            <option value="2016">Year : 2016</option> 
                            <option value="2015">Year : 2015</option> 
                            <option value="2014">Year : 2014</option>  
                        </select>  
					</div> 
				</div>
            </div>
			<div class="zui-wrapper">
			<div class="zui-scroller">
				<table class="zui-table" id="list_deposit">
					<thead>
						<tr>  
							<th class="zui-sticky-col">Bank Name</th> 
							<th class="zui-sticky-col2">Closing Balance</th> 
							@foreach($listProject as $p)
                            <th>{{$p->project_name}}</th> 
							@endforeach 
						</tr>
				   </thead>
				   	<tbody>
				   <?php
				   $array = json_decode(json_encode($listDeposit),true);

				      foreach($array as $k=>$val)
				   {
					   $closing=number_format($val['closing_balance'], 2, ".", ",");
					   
						echo "
						<tr>
							<td class='zui-sticky-col'>$val[bank_name]</td>
							<td class='zui-sticky-col2'>$closing</td>";
						foreach($listProject as $p=>$value)
						{
							$namae = preg_replace('/\s+/', '', $value['project_name']);
							$balance=number_format($val[$namae], 2, ".", ",");
							
							echo"
				 			<td>$balance</td>"; 
				 		}
						echo 
						"</tr>";
				   }
				   ?>
				   </tbody>
				</table>
			</div>
			</div>
		</div> 
	</div>
</div>
@endif	
<div class="row"> 
    <div class="col-md-12 col-sm-12">
        <div class="portlet light " style="height:75vh;">
            <img class="logo-main img-responsive" src="{{asset('global/img/logo.png')}}" height="230px;" style="display:none"/  > 
        </div>
    </div>
</div> 

<!--
<div class="row">  
	<div class="col-lg-6 col-xs-12 col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption ">
					<span class="caption-subject font-dark bold uppercase">Cashbank</span>
					<span class="caption-helper">distance stats...</span>
				</div> 
			</div>
			<div class="portlet-body">
				<div id="dashboard_amchart_1" class="CSSAnimationChart"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-xs-12 col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption ">
					<span class="caption-subject font-dark bold uppercase">Deposit</span>
					<span class="caption-helper">distance stats...</span>
				</div> 
			</div>
			<div class="portlet-body">
				<div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
			</div>
		</div>
	</div>
</div>
-->
@if (session('status'))
    <div class="alert alert-{{ session('status') }}" style="margin-top:100px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
         <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {{ session('message') }}
    </div>
@endif
@endsection

@section('script-js') 
<script>
    $(function(){ 
        $(".logo-main").fadeIn(1000);
    }); 
     
	 $('#view_year_selected,#view_project_selected').change(function (e) {
			var projectSelected     = $("#view_project_selected").val();   	
            var monthNameSelected   = $("#view_month_selected option:selected").text();  
            var yearSelected        = $("#view_year_selected").val();   
            var monthSelected       = $("#view_month_selected").val();    
            var arrWeek             = getWeekOfMonth(yearSelected, monthNameSelected);
            //change list week depends on month
            $("#view_week_selected option").remove();
            for(var i=0;i<arrWeek.length;i++){
                $("#view_week_selected").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
            } 
			var weekSelected = $("#view_week_selected").val(); 
            $(".week_request_label").text(weekSelected);
            $(".week_request").val(weekSelected); 
            grid.getDataTable().ajax.reload(null, false); 
			
            //set request year and project
            $("#select_project_add").val($("#view_project_selected").val()); 
            $(".year_request_label").text($("#view_year_selected").val());
            $(".year_request").val($("#view_year_selected").val());
            
            //set same project to modal export and send email   
            // $("#project_selected_export").val(projectSelected);
            // $("#year_selected_export").val(yearSelected);
            // $("#month_selected_export").val(monthSelected);
            // $("#week_selected_export").val(weekSelected);
            
            // $("#project_selected_mail").val(projectSelected);
            // $("#year_selected_mail").val(yearSelected);
            // $("#month_selected_mail").val(monthSelected);
            // $("#week_selected_mail").val(weekSelected);
        });
        $('#view_month_selected').change(function (e) {  
            var monthSelected = $("#view_month_selected").val();
            if (monthSelected == 0){
                $(".month_request_label").text("{{$nowMonthString}}");
                $(".month_request").val({{$nowMonthNumber}}); 
            }
            else {
                $(".month_request_label").text($("#view_month_selected").find(":selected").text()); 
                $(".month_request").val(monthSelected); 
            } 
            var monthNameSelected   = $("#view_month_selected option:selected").text();  
            var yearSelected        = $("#view_year_selected").val();  
            var arrWeek             = getWeekOfMonth(yearSelected, monthNameSelected);
            //change list week depends on month
            $("#view_week_selected option").remove();
            for(var i=0;i<arrWeek.length;i++){
                $("#view_week_selected").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
            } 
			//set for week
            var weekSelected = $("#view_week_selected").val(); 
            $(".week_request_label").text(weekSelected);
            $(".week_request").val(weekSelected); 
            
            //set for export data and mail selected 
            $("#month_selected_export").val(monthSelected); 
            $("#week_selected_export").val(weekSelected); 
            $("#month_selected_mail").val(monthSelected); 
            $("#week_selected_mail").val(weekSelected); 
            
            grid.getDataTable().ajax.reload(null, false);
        });
        $('#view_week_selected').change(function (e) {   
            grid.getDataTable().ajax.reload(null, false);
            var weekSelected = $("#view_week_selected").val(); 
            $(".week_request_label").text(weekSelected);
            $(".week_request").val(weekSelected); 
            //set for export data and mail selected 
            $("#week_selected_export").val(weekSelected); 
            $("#week_selected_mail").val(weekSelected);
        });
		 //on change for total value
        $('#view_project_selected,#view_year_selected,#view_month_selected,#view_week_selected').change(function (e) {  
             var projectSelectedID = $("#view_project_selected").val();  
             var yearSelected      = $("#view_year_selected").val();  
             var monthSelected     = $("#view_month_selected").val();  
             var weekSelected      = $("#view_week_selected").val();  
             $.ajax({
                   'url'  : "{{ url('/deposit/gettotalvalue')}}"+"/"+projectSelectedID+"/"+yearSelected+"/"+monthSelected+"/"+weekSelected,
                   'type' : 'GET',
                   'success' : function(result, textStatus, xhr){   
                         $("#total_balance_before").text(result[0]['totalBefore']);
                         $("#total_in").text(result[0]['totalIn']);
                         $("#total_out").text(result[0]['totalOut']);
                         $("#total_balance_after").text(result[0]['totalAfter']);
                   }
             });
        });
		@if(count($listProject)>1)
            // on project select then doing ajax to get list account bank for add
            $('#view_project_selected').change(function (e) {  
                 var projectSelected = $("#view_project_selected").val();   
                 var monthSelected   = {{$nowMonthNumber}};
                 var yearSelected    = {{$nowYear}};
                 var weekSelected    = 1; 
				  
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                 $.ajax({
                       'url'  : "{{ url('/deposit/listbankaccount') }}",
                       'type' : 'POST',
                       'data' :  {
                           projectSelected, 
                           yearSelected,
                           monthSelected,
                           weekSelected   
                       },
                       'success' : function(result, textStatus, xhr){    
                            $(".listbankaccount").children(".row").remove();
                            $(".listbankaccount").append(result['htmlText']);  
                            $(".bank-account-form").children("option").remove();  
                            var htmlselect = '';
                            var bank = result['listBank'];
                            var bankAccount = result['listBankAccount']; 
                            for(var i = 0;i<bank.length;i++){
                                for(var j = 0;j<bankAccount.length;j++){
                                    if(bank[i]['bank_id'] === bankAccount[j]['bank_id']){
                                        htmlselect += '<option value="'+bankAccount[j]['bank_account_id']+'">'+bank[i]['bank_name']+'&nbsp'+bankAccount[j]['account_no']+'&nbsp('+bankAccount[j]['account_detail']+')'+'&nbsp('+bankAccount[j]['currency']+')</option>';
                                    }   
                                }
                            }
                            $(".bank-account-form").append(htmlselect); 
                       }
                 }); 
             });  
        @endif  
        //on change then get latest deposit rate
        $('#view_year_selected,#view_month_selected,#view_week_selected').change(function (e) {   
             var projectSelected = $("#view_project_selected").val(); 
             var yearSelected    = $("#view_year_selected").val();   
             var monthSelected   = $("#view_month_selected").val();   
             var weekSelected    = $("#view_week_selected").val();     
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
             $.ajax({
                   'url'  : "{{ url('/deposit/listbankaccount') }}",
                   'type' : 'POST',
                   'data' :  {
                       projectSelected, 
                       yearSelected,
                       monthSelected,
                       weekSelected   
                   },
                   'success' : function(result, textStatus, xhr){    
                        $(".listbankaccount").children(".row").remove();
                        $(".listbankaccount").append(result['htmlText']);  
                        $(".bank-account-form").children("option").remove();  
                        var htmlselect = '';
                        var bank = result['listBank'];
                        var bankAccount = result['listBankAccount']; 
                        for(var i = 0;i<bank.length;i++){
                            for(var j = 0;j<bankAccount.length;j++){
                                if(bank[i]['bank_id'] === bankAccount[j]['bank_id']){
                                    htmlselect += '<option value="'+bankAccount[j]['bank_account_id']+'">'+bank[i]['bank_name']+'&nbsp'+bankAccount[j]['account_no']+'&nbsp('+bankAccount[j]['account_detail']+')'+'&nbsp('+bankAccount[j]['currency']+')</option>';
                                }   
                            }
                        }
                        $(".bank-account-form").append(htmlselect); 
                   }
             }); 
         });
			
            // var isEmptyTable = $("#list_deposit").children("tbody").find("td:first").hasClass('dataTables_empty') ;
            // if(isEmptyTable){ 
                // $("#create_modal").modal('show');
            // } else{
                // $("#set_new_dialog").modal('show');
                // $(".act_set_new").on("click", function(){
                    // $('#list_deposit tbody tr').each(function() {
                        // var id  = $(this).find(".ba_id").val();
                        // var percentDeposit  = $(this).children("td:nth-child(3)").text().replace('%','');
                        // var in_             = $(this).children("td:nth-child(5)").text();
                        // var out_            = $(this).children("td:nth-child(6)").text();  
                        // $("[name=percent_deposit_"+id+"]", $("#create_modal")).val(percentDeposit);
                        // $("[name=in_"+id+"]", $("#create_modal")).val(in_);
                        // $("[name=out_"+id+"]", $("#create_modal")).val(out_);
                    // });
                    // $("#create_modal").modal('show');
                // });
            // } 
        // });
</script>  
<script src="{{asset('/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script> 
<script src="{{asset('/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
@endsection
				 