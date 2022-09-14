@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/logreportcashbank')}}">Log Transaction</a>
        </li> 
    </ul>
</div>
<h3 class="page-title"></h3> 
@endsection

@section('content') 
<div class="row">
    <div class="col-md-12 col-sm-12"> 
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-blue-sharp hide"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase">Log Transaction</span>
                    <span class="caption-helper">Log Data</span>
                </div>
            </div> 
            <!-- BEGIN Table-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>List of Log
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
                                    <div class="col-md-12">
                                        <div class="btn-group ">Project : 
                                            <select class="table-group-action-input form-control input-inline input-sm" id="view_project_selected">    
                                                <option value="0">All</option>
                                                @foreach($listProject as $p)
                                                    <option value="{{$p->project_id}}">{{$p->pt_name}}, {{$p->project_name}}</option> 
                                                @endforeach 
                                            </select>  
										</div>
                                    </div>
                                    <div class="col-md-12">
										<div class="btn-group " style="margin:5px 3px;">Date : 
                                            <select class="table-group-action-input form-control input-inline input-small input-sm" id="view_month_selected">
                                                <option value="0">-- All Month --</option>
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
                                                <option value="12">December</option> 
                                            </select> 
										</div>
                                        <div class="btn-group " style="margin:5px 3px;">
                                            <select class="table-group-action-input form-control input-inline input-small input-sm" id="view_year_selected"> 
                                                <option value="2017">Year : 2017</option> 
                                                <option value="2016">Year : 2016</option> 
                                                <option value="2015">Year : 2015</option> 
                                                <option value="2014">Year : 2014</option>  
                                            </select>  
										</div> 
									</div>
                                </div>
                            </div>     
                            <table class="table table-striped table-bordered table-hover" id="list_log">
                            <thead>
                                <tr> 
                                    <th>Sender</th>
                                    <th>Project</th>
                                    <th>Transaction Type</th>
                                    <th>Detail</th>
                                    <th>TR ID</th>
                                    <th>Submit Date</th>  
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>  
            <!-- END Table-->
        </div> 
    </div>
</div>
 
 
@endsection


@section('script-js')

<script>
    $(function(){
        var grid = new Datatable();

        grid.init({
            src: $("#list_log"),
            onSuccess: function (grid) {
                // execute some code after table records loaded    
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
                    "url":  "{{url('logreportcashbank/datatable')}}",
                    "type"  : "POST" ,
                    data: function(d){ 
                        d.projectSelected = $('#view_project_selected').val(); 
                        d.monthSelected = $('#view_month_selected').val();
                        d.yearSelected = $('#view_year_selected').val(); 
                    }
                },
                 columns: [  
                    {data: 'user', name: 'user.email'},
                    {data: 'project', name: 'project.project_name'}, 
                    {data: 'activity_type', name: 'activity_type'}, 
                    {data: 'detail', name: 'detail'}, 
                    {data: 'tr_id', name: 'tr_id'}, 
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false} 
                ],
                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0,1,2,4 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
        $('#view_project_selected').change(function (e) {   
            grid.getDataTable().ajax.reload(null, false);  
        });
        
        
         
    });
</script>
@endsection
				 