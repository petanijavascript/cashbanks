
@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/dirview')}}">Cashbank Report</a>
        </li> 
    </ul>
</div>
<h3 class="page-title"></h3> 
@endsection

@section('content')  
<!-- alert result --> 
<div class="alert alert-success" style="display:none">
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
                    <span class="caption-subject font-blue-sharp bold uppercase">Cashbank Report</span>
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
                                <i class="fa fa-globe"></i>Select Data
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a> 
                                <a href="javascript:;" class="reload">
                                </a> 
                            </div>
                        </div>
						<div class="portlet-body">  
							<div class="scroller" style="height:520px" data-always-visible="1" data-rail-visible1="1"> 
								<form action="{{url('sendmail/cashbank/')}}" id="sendmail_form">
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
									<div class="col-md-2">
										<h4>Year</h4>
										<p>
											<select class="form-control" name="year" id="year_selected_mail">
												<option value="2019">2019</option> 
												<option value="2018">2018</option> 
												<option value="2017">2017</option> 
												<option value="2016">2016</option> 
												<option value="2015">2015</option> 
												<option value="2014">2014</option>  
											</select>
										</p> 
									</div>
									<div class="col-md-4">  
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
									<div class="col-md-2">
										<h4>Start Week </h4>
										<select class="form-control" name="start_week" id="week_selected_mail">
											<?php
												for($i=1 ; $i<= $totalWeek ; $i++){
													echo "<option value=\"$i\">$i</option>"; 
												}
											?>   
										</select>
									</div>
									<div class="col-md-2">
										<h4>End Week </h4>
										<select class="form-control" name="end_week" id="endweek_selected_mail"> 
											<?php
												for($i=1 ; $i<= $totalWeek ; $i++){
													echo "<option value=\"$i\">$i</option>"; 
												}
											?>   
										</select>
									</div>  
									<div class="col-md-12">  
										<h2></h2>
										<input type="button" class="btn blue btn_preview" value="Show Data"  />
									</div>
								</form>
                        </div> 
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET--> 
                </div>
            </div>  
            <!-- END Table-->
        </div>
        <!-- END PORTLET-->
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------>

<!-- PROPERTIES HERE ALL -->      

@endsection




@section('script-js')  
<script src="{{asset('global/scripts/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>  
<script> 
    
    $(function(){ 
		$(document).ready(function () {
			var yearSelected        = $("#year_selected_mail").val(); 
            var monthSelected       = $("#month_selected_mail option:selected").text();   
            var arrWeek             = getWeekOfMonth(yearSelected, monthSelected);
            //change list week depends on month
            $("#week_selected_mail option").remove();
            $("#endweek_selected_mail option").remove();
            for(var i=0;i<arrWeek.length;i++){
                $("#week_selected_mail").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
                $("#endweek_selected_mail").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
            }  
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
		
		$('#month_selected_mail,#year_selected_mail').change(function (e) {   
            var yearSelected        = $("#year_selected_mail").val(); 
            var monthSelected       = $("#month_selected_mail option:selected").text();   
            var arrWeek             = getWeekOfMonth(yearSelected, monthSelected);
            //change list week depends on month
            $("#week_selected_mail option").remove();
            $("#endweek_selected_mail option").remove();
            for(var i=0;i<arrWeek.length;i++){
                $("#week_selected_mail").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
                $("#endweek_selected_mail").append("<option value=\""+(i+1)+"\">"+arrWeek[i]+"</option>");
            }  
		});
        
         
    });
    
     
</script>
@endsection
				 