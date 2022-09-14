
@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/reksadana')}}">Reksadana</a>
        </li> 
    </ul>
</div>
<h3 class="page-title"></h3> 
@endsection

@section('content') 
<!-- alert result --> 
<div class="alert alert-success" style="display:none;">
    <button type="button" class="close" data-hide="alert" aria-hidden="true"></button>
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
    <label></label>
</div>  
<!-- end alert modal -->  
<div class="row">
    <div class="col-md-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-blue-sharp hide"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase">Reksadana</span>
                    <span class="caption-helper">Transaction</span>
                </div>
            </div> 
            <!-- BEGIN Table-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue-chambray">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>List of Reksadana
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a> 
                                <a href="javascript:;" class="reload">
                                </a> 
                            </div>
                        </div>
                        <div class="portlet-body"> 
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="btn-group">
                                            <a class="btn blue" id="set_new_button">
                                            Set New <i class="fa fa-plus"></i>
                                            </a>
                                        </div> 
                                        <div class="btn-group"> 
                                            <a class="btn blue"  data-toggle="modal" href="#export_modal" >
                                            <i class="fa fa-file-excel-o">&nbsp</i>Export Data 
                                            </a>
                                        </div>  
                                        <div class="btn-group"> 
                                            <a class="btn blue"  data-toggle="modal" href="#mail_modal" >
                                            <i class="fa fa-pencil-square-o">&nbsp</i>Send Email 
                                            </a>
                                        </div>
                                    </div> 
                                    <div class="col-md-7">
                                        <div class="btn-group pull-right">Project : 
                                            <select class="table-group-action-input form-control input-inline input-sm" id="view_project_selected">    
                                                @foreach($listProject as $p)
                                                    <option value="{{$p->project_id}}">@if($p->pt_name!=""){{$p->pt_name}},@endif {{$p->project_name}}</option> 
                                                @endforeach 
                                            </select>  
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
                                                @for($i=$nowYear; $i>=2014; $i--)
													<option value="{{ $i }}">Year : {{ $i }}</option>
												@endfor 
                                            </select>  
										</div> 
									</div>
                                </div>
                            </div>  
								<!--<div class="table-responsive">-->
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="list_reksadana">
                                <thead>
                                    <tr>  
                                        <th>Bank Account</th>
                                        <th>Bank Account</th>
                                        <th>Bank Account</th>
                                        <th>Type</th>
                                        <th>Opening Balance</th> 
                                        <th>In</th>  
                                        <th>Out</th>  
                                        <th>Closing Balance</th> 
                                        <th colspan="2">&nbsp</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                </table>
								</div>
								<!--</div>-->
<!--                            </div>-->
                        </div> 
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
					<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" > 
                        <thead>
                            <tr>
                                <th style="text-align:center;">Total Balance Before</th>
                                <th style="text-align:center;">Total IN</th>
                                <th style="text-align:center;">Total OUT</th>
                                <th style="text-align:center;">Total Current Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td id="total_balance_before">{{$totalValue[0]->totalBefore}}</td>  
                                <td id="total_in">{{$totalValue[0]->totalIn}}</td>   
                                <td id="total_out">{{$totalValue[0]->totalOut}}</td>   
                                <td id="total_balance_after">{{$totalValue[0]->totalAfter}}</td>  
                            </tr> 
                        </tbody>
                    </table> 
					</div>
                </div>
            </div>  
            <!-- END Table-->
        </div>
        <!-- END PORTLET-->
    </div>
</div>



<!-- PROPERTIES HERE ALL -->
<!-- create_modal modal-->
<div id="create_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Reksadana Transaction</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add Reksadana</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_reksadana_form"> 
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input"> 
                                            <select class="form-control" name="project_id" id="select_project_add"> 
                                                @foreach($listProject as $project)
                                                    <option value="{{$project->project_id}}">{{$project->pt_name}}, {{$project->project_name}}</option>
                                                @endforeach
                                            </select>
                                            <label>Project</label>   
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                               <label class="year_request_label">{{$nowYear}}</label> 
                                                <input type="hidden" class="form-control year_request" name="year" value="{{$nowYear}}">
                                                <label>Year</label>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-md-line-input">
                                            <label class="month_request_label">{{$nowMonthString}}</label>
                                            <input type="hidden" class="form-control month_request" name="month" readonly="readonly" value="{{$nowMonthNumber}}"> 
                                            <label>Month</label> 
                                        </div> 
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group form-md-line-input">
                                            <label class="month_request_label">{{$nowMonthString}}</label>
                                            <input type="hidden" class="form-control month_request" name="month" readonly="readonly" value="{{$nowMonthNumber}}"> 
                                            <label>Month</label> 
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="week_request_label">{{$nowWeekNumber}}</label>
                                            <input type="hidden" class="form-control week_request" name="week" readonly="readonly" value="{{$nowWeekNumber}}"> 
                                            <label>Week</label> 
                                        </div>  
                                    </div>
                                </div> 
								<div class="listbankaccount">
                                @foreach($listBank as $bank)
                                    @foreach($listBankAccount as $bankAccount) 
                                        @if($bank->bank_id === $bankAccount->bank_id)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input"> 
                                                        <label>
                                                            {{$bank->bank_name}}&nbsp&nbsp{{$bankAccount->account_no}}&nbsp
                                                            @if($bankAccount->account_detail != "")
                                                                ({{$bankAccount->account_detail}})
                                                            @endif
															&nbsp({{$bankAccount->currency}})
                                                        </label> 
                                                       <input type="hidden" name="bank_name_{{$bankAccount->bank_account_id}}" value="{{$bank->bank_name}}" class="form-control"> 
                                                        <label>Bank Account</label> 
                                                    </div>  
                                                </div>
                                                <div class="col-md-3">  
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-group right-addon"> 
                                                            @php $foundBankAccount = 0; @endphp
                                                            @foreach($latestReksadanaRate as $rate)
                                                                @if($rate->bankAccountID == $bankAccount->bank_account_id)
                                                                    @php $foundBankAccount=1; @endphp
                                                                    <input type="text" class="form-control create_in" name="percent_reksadana_{{$bankAccount->bank_account_id}}"  placeholder="Enter Percent" value="{{$rate->rate}}"> 
                                                                @endif
                                                            @endforeach 
                                                            @if($foundBankAccount == 0)
                                                                <input type="text" class="form-control create_in" name="percent_reksadana_{{$bankAccount->bank_account_id}}"  placeholder="Enter Percent"> 
                                                            @endif
                                                            <label for="form_control_1">Percent Reksadana</label>
                                                            <span class="help-block">ex: 5 </span>
                                                            <span class="input-group-addon">%</span>
                                                        </div>  
                                                    </div>
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="form-group form-md-line-input">
                                                        <input type="text" class="form-control create_in" name="in_{{$bankAccount->bank_account_id}}"  placeholder="Enter In">
                                                        <label>In</label>
                                                        <span class="help-block">ex: 10000000</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-md-line-input">
                                                        <input type="text" class="form-control create_out" name="out_{{$bankAccount->bank_account_id}}"  placeholder="Enter Out">
                                                        <label>Out</label>
                                                        <span class="help-block">ex: 10000000</span>
                                                    </div> 
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach   
								</div>
                            </div>
                            <div class="form-actions noborder">
                                <button type="button" class="btn blue" id="submit">Submit</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- edit_modal modal-->
<div id="edit_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Reksadana Transaction</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit Reksadana</span>
                        </div> 
                    </div>
                    <!-- modal form update -->
                    <div class="portlet-body form">
                        <form role="form" id="update_reksadana_form"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="reksadana_id">
                            <div class="form-body">
                               <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="project_id" >
                                        <option value="null">-- No Project --</option>
                                        @foreach($listProject as $project)
                                            <option value="{{$project->project_id}}">{{$project->pt_name}}, {{$project->project_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Project</label> 
                                </div>
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control bank-account-form" name="bank_account_id" >
                                        @foreach($listBank as $bank)
                                            @foreach($listBankAccount as $bankAccount)
                                                @if($bank->bank_id === $bankAccount->bank_id)
                                                    <option value="{{$bankAccount->bank_account_id}}">{{$bank->bank_name}}&nbsp{{$bankAccount->account_no}}&nbsp({{$bankAccount->account_detail}})&nbsp({{$bankAccount->currency}})</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Bank Account</label> 
                                </div>  
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="in"  placeholder="Enter In">
                                    <label for="form_control_1">In</label>
                                    <span class="help-block">ex: 10000000</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="out"  placeholder="Enter Out">
                                    <label for="form_control_1">Out</label>
                                    <span class="help-block">ex: 10000000</span>
                                </div>  
                                <div class="form-group form-md-line-input"> 
                                    <input type="text" class="form-control year_request" name="year" readonly="readonly">
                                    <label for="form_control_1">Year</label> 
                                </div> 
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="month" >
                                        <option value="1">January</option> 
                                        <option value="2">February</option> 
                                        <option value="3">March</option> 
                                        <option value="4">April</option> 
                                        <option value="5">May</option> 
                                        <option value="6">June</option> 
                                        <option value="7">July</option> 
                                        <option value="8">August</option> 
                                        <option value="9">September</option> 
                                        <option value="10">October</option> 
                                        <option value="11">November</option> 
                                        <option value="12">Desember</option> 
                                    </select>
                                    <label for="form_control_1">Month</label> 
                                </div>  
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="week" >
                                        <?php
                                            for($i=1 ; $i<=5 ; $i++){
                                                echo "<option value=\"$i\">$i</option>"; 
                                            }
                                        ?>   
                                    </select>
                                    <label for="form_control_1">Week</label> 
                                </div>  
                            </div>
                            <div class="form-actions noborder">
                                <button type="button" class="btn blue" id="submit">Submit</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- confirm modal dialog -->
<div id="confirm-dialog" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> 
                <h4 class="modal-title glyphicon glyphicon-warning-sign">&nbsp;Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>
                     Would you like to continue delete?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="button" data-dismiss="modal" class="btn act_delete">Continue Task</button>
            </div>
        </div>
    </div>
</div>
<!-- end confirm modal --> 
<!-- set new modal dialog -->
<div id="set_new_dialog" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> 
                <h4 class="modal-title glyphicon glyphicon-warning-sign">&nbsp;Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>
                     Data for this week has already set, Would you like to continue to set new?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="button" data-dismiss="modal" class="btn act_set_new">Continue Task</button>
            </div>
        </div>
    </div>
</div>
<!-- end set new modal --> 
<!-- Modal Export Data -->
<div id="export_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('export/excel/reksadana/')}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong>Export Data</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:450px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Project</h4>
                                <p>
                                    <select class="form-control" name="project" id="project_selected_export">
                                        @foreach($listProject as $p)
                                            <option value="{{$p->project_id}}">@if($p->pt_name!=""){{$p->pt_name}},@endif {{$p->project_name}}</option> 
                                        @endforeach 
                                    </select>
                                </p> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Year</h4>
                                <p>
                                    <select class="form-control" name="year" id="year_selected_export">
                                        @for($i=$nowYear; $i>=2014; $i--)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor 
                                    </select>
                                </p> 
                            </div>
                            <div class="col-md-9">  
                                <h4>Month</h4>
                                <p>
                                    <select class="form-control" name="month" id="month_selected_export">
                                        @for($m=1; $m<=12; $m++) 
                                            <?php  
                                                $monthString = date('F', mktime(0,0,0,$m, 1, date('Y'))); 
                                            ?>
                                            <option value="{{$m}}" @if($m == $nowMonthNumber) {{'selected="selected"'}} @endif>{{$monthString}}</option>  
                                        @endfor
                                    </select>
                                </p> 
                            </div> 
                            <div class="col-md-6">
                                <h4>Start Week</h4>
                                <select class="form-control" name="start_week" id="week_selected_export">
                                    <?php
                                        for($i=1 ; $i<=5 ; $i++){
                                            echo "<option value=\"$i\">$i</option>"; 
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h4>End Week</h4>
                                <select class="form-control" name="end_week" >
                                    <option value="0">--Select Week--</option> 
                                    <?php
                                        for($i=1 ; $i<=5 ; $i++){
                                            echo "<option value=\"$i\">$i</option>"; 
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="col-md-12">
                                <h4>Reksadana Type</h4>
                                <p>
                                    <select class="col-md-12 form-control" name="reksadana_type">
                                        <option value="reksadana">Reksadana</option> 
                                    </select>
                                </p> 
                            </div>
                            <div class="col-md-12">
                                <h4>Type</h4>
                                <p>
                                    <select class="col-md-12 form-control" id="type_export" name="type_export">
                                        <option value="html">HTML</option>
                                        <option value="excel">Excel</option>
<!--                                        <option value="pdf">PDF</option>-->
                                    </select>
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                    <input type="submit" class="btn blue" value="submit"/> 
                </div> 
            </form>
        </div>
    </div>
</div>  
<!-- End Modal --> 

<!-- Modal Send Mail Data -->
<div id="mail_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('sendmail/reksadana/')}}" id="sendmail_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong>Send Report Email</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:670px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Project</h4>
                                <p>
                                    <select class="form-control" name="project_id" id="project_selected_mail">
                                        @foreach($listProject as $p)
                                            <option value="{{$p->project_id}}">@if($p->pt_name!=""){{$p->pt_name}},@endif {{$p->project_name}}</option> 
                                        @endforeach 
                                    </select>
                                </p> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Year</h4>
                                <p>
                                    <select class="form-control" name="year" id="year_selected_mail">
                                        @for($i=$nowYear; $i>=2014; $i--)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor 
                                    </select>
                                </p> 
                            </div>
                            <div class="col-md-9">  
                                <h4>Month</h4>
                                <p>
                                    <select class="form-control" name="month" id="month_selected_mail" > 
                                        @for($m=1; $m<=12; $m++) 
                                            <?php  
                                                $monthString = date('F', mktime(0,0,0,$m, 1, date('Y'))); 
                                            ?>
                                            <option value="{{$m}}" @if($m == $nowMonthNumber) {{'selected="selected"'}} @endif>{{$monthString}}</option>  
                                        @endfor  
                                    </select>
                                </p> 
                            </div> 
                            <div class="col-md-6">
                                <h4>Start Week</h4>
                                <select class="form-control" name="start_week" id="week_selected_mail">
                                    <?php
                                        for($i=1 ; $i<=5 ; $i++){
                                            echo "<option value=\"$i\">$i</option>"; 
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h4>End Week</h4>
                                <select class="form-control" name="end_week" >
                                    <option value="0">--Select Week--</option> 
                                    <?php
                                        for($i=1 ; $i<=5 ; $i++){
                                            echo "<option value=\"$i\">$i</option>"; 
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="col-md-12">
                                <h4>Mail To:</h4>
                                <div id="mail_to"></div> 
                                <input type="hidden" class="form-control typeahead" name="mail_to"/>
                            </div>
                            <div class="col-md-12">
                                <h4>CC:</h4>
                                <div id="cc"></div>
                                <input type="hidden" class="form-control typeahead" name="cc"/>
                            </div>
                            <div class="col-md-12">
                                <h4>Notes:</h4>
                                <p>
                                    <textarea class="form-control" name="notes" rows="5" placeholder="Write notes."></textarea> 
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                    <input type="button" class="btn blue btn_preview" value="Data  Preview"  />
                    <input type="submit" class="btn blue btn_send_mail" value="submit"/> 
                </div> 
            </form>
			<center>
				<div id="loading" style="display:none;">
					<div class="loader"></div>
					<p>Sending in process, please wait...</p>
				</div>
			</center>
        </div>
    </div>
</div>  
<!-- End Modal --> 

@endsection




@section('script-js')
<script src="{{asset('global/scripts/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>  
<script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name=_token]').val()
            }
        });

    $(function(){
        var projectSelected     = $("#view_project_selected").val();  
        var id = projectSelected;

        $.ajax({
            'url' : "{{url('reportweekly/detailsender')}}",
            'data' : {
                id : id
            },
            'type' : 'POST',
            success : function(result){
                for(var key in result){
                    $("#"+key).text(result[key]);
                    $('#sendmail_form [name="'+key+'"]').val(result[key]); 
                }
                // console.log(result);
            }
        });

        // set for modal message alert
        $("[data-hide]").on("click", function(){
             $(this).closest("." + $(this).attr("data-hide")).hide();
        });
        @if (session('message'))
            $(".alert").show(600).children('label').text("{{ session('message') }}");
        @endif
        // set for set new modal
        $("#set_new_button").on("click", function(){   
            var isEmptyTable = $("#list_reksadana").children("tbody").find("td:first").hasClass('dataTables_empty') ;  
            if(isEmptyTable){ 
                $("#create_modal").modal('show');
            } else{
                $("#set_new_dialog").modal('show');
                $(".act_set_new").on("click", function(){
                    $('#list_reksadana tbody tr').each(function() {
                        var id  = $(this).find(".ba_id").val();
                        var in_  = $(this).children("td:nth-child(4)").text();
                        var out_ = $(this).children("td:nth-child(5)").text();  
                        $("[name=in_"+id+"]", $("#create_modal")).val(in_);
                        $("[name=out_"+id+"]", $("#create_modal")).val(out_);
                    });
                    $("#create_modal").modal('show');
                });
            } 
        });
        
        //set formatter input
        $(".create_in").on("change",function(){
            var input = $(this).val();   
            input = input.replace(/,/g , ""); 
            $(this).val(formatterNumber(input));
        }); 
        $(".create_out").on("change",function(){
            var input = $(this).val();   
            input = input.replace(/,/g , "");  
            $(this).val(formatterNumber(input));
        }); 
        $(".edit_in").on("change",function(){
            var input = $(this).val();   
            input = input.replace(/,/g , ""); 
            $(this).val(formatterNumber(input));
        }); 
        $(".edit_out").on("change",function(){
            var input = $(this).val();   
            input = input.replace(/,/g , ""); 
            $(this).val(formatterNumber(input));
        });
		
		//triggered loading send mail
		$(".btn_send_mail").on("click", function(){
           $("#loading").show();                  
        });
        
        var grid = new Datatable();

        grid.init({
            src: $("#list_reksadana"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
                var projectSelected     = $("#view_project_selected").val();  
                var id = projectSelected;

                $.ajax({
                    'url' : "{{url('reportweekly/detailsender')}}",
                    'data' : {
                        id : id
                    },
                    'type' : 'POST',
                    success : function(result){
                        for(var key in result){
                            $("#"+key).text(result[key]);
                            $('#sendmail_form [name="'+key+'"]').val(result[key]); 
                        }
                        // console.log(result);
                    }
                });
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { 
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url":  "{{url('reksadana/datatable')}}",
                    "type"  : "POST" ,
                    data: function(d){ 
                        d.projectSelected = $('#view_project_selected').val(); 
                        d.yearSelected = $('#view_year_selected').val(); 
                        d.monthSelected = $('#view_month_selected').val();
                        d.weekSelected = $('#view_week_selected').val();
                    }
                },
                 columns: [   
                    {data: 'bank_account', name: 'bank_name'},   
                    {data: 'bank_account', name: 'account_no'},   
                    {data: 'bank_account', name: 'account_detail'}, 
                    {data: 'reksadana_type', name: 'reksadana_type'},     
                    {data: 'opening_balance', name: 'opening_balance', orderable: false, searchable: false}, 
                    {data: 'in', name: 'in'},  
                    {data: 'out', name: 'out'},  
                    {data: 'closing_balance', name: 'closing_balance', orderable: false, searchable: false},    
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc
                "aoColumnDefs": [ 
                    {
                        "aTargets": [4,5,6,7],
                        "sClass":"text-right",  
                        "mRender": function (data, type, full) {
                         var formmatedvalue=data.replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
                          return formmatedvalue;
                        }
                    },
                    {
                        "aTargets": [ 0, 3, 8,9 ],
                        "sClass":"text-center" 
                    },
                    { 
                        "aTargets": [ 1, 2 ],
                        "bVisible": false 
                    }
                ]
            }
        });
        
         
        var path = "{{url('/autocompleteEmail/reksadana')}}";
        $('.typeahead').typeahead({  
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) { 
                console.log(data); 
                    return process(data);
                });
            }
        }); 

        $('#project_selected_mail').change(function (e) {
            var projectSelected     = $("#project_selected_mail").val();  
            var id = projectSelected;

            $('#mail_to').text("Loading Please Wait...");
            $('#cc').text("Loading Please Wait..."); 

            $('#sendmail_form [name="mail_to"]').val("");
            $('#sendmail_form [name="cc"]').val(""); 

            $.ajax({
                'url' : "{{url('reportweekly/detailsender')}}",
                'data' : {
                    id : id
                },
                'type' : 'POST',
                success : function(result){
                    if(result=='') 
                    { 
                        $('#mail_to').text("Email Sender Tidak Ada");
                        $('#cc').text("Email Sender Tidak Ada"); 

                        $('#sendmail_form [name="mail_to"]').val("");
                        $('#sendmail_form [name="cc"]').val(""); 
                    }
                    
                    for(var key in result){
                        $("#"+key).text(result[key]);
                        $('#sendmail_form [name="'+key+'"]').val(result[key]); 
                    }
                    // console.log(result);
                }
            });
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
            $("#project_selected_export").val(projectSelected);
            $("#year_selected_export").val(yearSelected);
            $("#month_selected_export").val(monthSelected);
            $("#week_selected_export").val(weekSelected);
            
            $("#project_selected_mail").val(projectSelected);
            $("#year_selected_mail").val(yearSelected);
            $("#month_selected_mail").val(monthSelected);
            $("#week_selected_mail").val(weekSelected);
            
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
                   'url'  : "{{ url('/reksadana/gettotalvalue')}}"+"/"+projectSelectedID+"/"+yearSelected+"/"+monthSelected+"/"+weekSelected,
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
                       'url'  : "{{ url('/reksadana/listbankaccount') }}",
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
		// @if(count($listProject)>1)
        //     // on project select then doing ajax to get list account bank for add
        //     $('#view_project_selected').change(function (e) {    
        //          var projectSelectedID = $("#view_project_selected").val();  
        //          $.ajax({
        //                'url'  : "{{ url('/reksadana/listbankaccount') }}" + '/' + projectSelectedID,
        //                'type' : 'GET',
        //                'data' : projectSelectedID,
        //                'success' : function(result, textStatus, xhr){  
        //                     $(".listbankaccount").children(".row").remove();
        //                     $(".listbankaccount").append(result['htmlText']);   
                               
        //                     $(".bank-account-form").children("option").remove();  
        //                     var htmlselect = '';
        //                     var bank = result['listBank'];
        //                     var bankAccount = result['listBankAccount'];
        //                     for(var i = 0;i<bank.length;i++){
        //                         for(var j = 0;j<bankAccount.length;j++){
        //                             if(bank[i]['bank_id'] === bankAccount[j]['bank_id']){
        //                                 htmlselect += '<option value="'+bankAccount[j]['bank_account_id']+'">'+bank[i]['bank_name']+'&nbsp'+bankAccount[j]['account_no']+'&nbsp('+bankAccount[j]['account_detail']+')'+'&nbsp('+bankAccount[j]['currency']+')</option>';
        //                             }   
        //                         }
        //                     }
        //                     $(".bank-account-form").append(htmlselect);  
        //                }
        //          });
        //      });
        // @endif

        
        
         
        $form = $("#create_reksadana_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('reksadana/show')}}",
                data : {
                    id : id
                },
                success : function(result){
                    for(var key in result){
                        $("[name="+key+"]", $("#edit_modal")).val(result[key]);
                    } 
                }
           }) 
        });
		
		$formMail = $("#sendmail_form"); 
        $(document).on('click','.btn_preview', function(){ 
            var formData = $formMail.serialize(); 
            var url = '{{url('sendmail/cashbank/')}}?'; 
            url += formData; 
            url += '&is_preview=true';
            var w = window.open(url, 'mail_modal', 'width=1100, height=600, any-other-option, ...');
            f.target = 'mail_modal';
            f.submit();
        });
        
        $("#submit",$form).click(function(){
             //clear all formatter
            $('.create_in').each(function(i, obj) { 
                $(this).val($(this).val().replace(/,/g , "")); 
            });
             $('.create_out').each(function(i, obj) { 
                $(this).val($(this).val().replace(/,/g , "")); 
            });
            
           $.ajax({
               'url' : "{{url('reksadana/create')}}",
               'type' : 'POST',
               'data' : $form.serialize(),
               'success' : function(result, textStatus, xhr){
                   console.log(result);
                   grid.getDataTable().ajax.reload(null, false);
                   $("#create_modal").modal('hide');   
                   $(".alert").show(600).children('label').text(result); 
                   $("#view_week_selected").trigger("change");
                   
               },
               statusCode : {
                   422 : function(xhr){
                       var result = $.parseJSON(xhr.responseText);
                       for(var key in result){ 
                           $("[name="+key+"]").after($("<span style=\"color:red\"></span>").html(result[key][0]));
                       }
                   }
               },
               'error' : function(result, textStatus, xhr){
                   //console.log(xhr.statusCode);
                   
               }
           })
        });
        //update
        $formUpdate = $("#update_reksadana_form");
        $("#submit",$formUpdate).click(function(){
            //clear all formatter
             $('.edit_in').each(function(i, obj) { 
                $(this).val($(this).val().replace(/,/g , "")); 
            });
             $('.edit_out').each(function(i, obj) { 
                $(this).val($(this).val().replace(/,/g , "")); 
            }); 
            
           $.ajax({
               'url' : "{{url('/reksadana/edit')}}",
               'type' : 'PUT',
               'data' : $formUpdate.serialize(),
               'success' : function(result, textStatus, xhr){ 
                   grid.getDataTable().ajax.reload(null, false);
                   $("#edit_modal").modal('hide');  
                   $(".alert").show(600).children('label').text(result);
                   $("#view_week_selected").trigger("change");
               },
               statusCode : {
                   422 : function(xhr){
                       var result = $.parseJSON(xhr.responseText);
                       for(var key in result){
                           $("[name="+key+"]").after($("<span style=\"color:red\"></span>").html(result[key][0]));
                       }
                   }
               },
               'error' : function(result, textStatus, xhr){
                   //console.log(xhr.statusCode); 
               } 
           }) 
        });
        //delete 
        $('#list_reksadana').on('click', '.btn_delete', function (e) {  
            var dataID = $(this).attr('data-id'); 
            $(".act_delete").on("click", function(){ 
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 
                // confirm then
                $.ajax({
                    url: '{{ url('/reksadana/') }}' + '/' + dataID,
                    type: 'DELETE',
                    data: dataID,
                    success: function( msg ) {  
                        grid.getDataTable().ajax.reload(null, false);
                        $(".alert").show(600).children('label').text(msg);
                    },
                    error: function( data ) { 
                        if ( data.status === 422 ) {
                            toastr.error('Cannot delete');
                        }
                    }
                }) 
            }); 
        }); 
    });
    
     
</script>
@endsection
				 