@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/reportmonthlysetting')}}">Report Monthly Setting</a>
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
                    <span class="caption-subject font-blue-sharp bold uppercase">Report Monthly Setting</span>
                    <span class="caption-helper">Master Data</span>
                </div>
            </div> 
            <!-- BEGIN Table-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue-chambray">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>List of Project Report
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
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="#create_modal"> 
                                                    Add New 
                                                <i class="fa fa-plus"></i> 
                                            </a>
                                        </div>  
                                    </div> 
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="list_report">
                            <thead>
                                <tr>  
                                    <th>PID</th>
                                    <th>Project</th>  
                                    <th>Mail To</th>  
                                    <th>CC</th>   
                                    <th colspan="2">&nbsp</th> 
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
        <!-- END PORTLET-->
    </div>
</div>



<!-- PROPERTIES HERE ALL -->
<!-- create_modal modal-->
<div id="create_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Master report</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add report</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_report_form"> 
                            {{ csrf_field() }}
                            <div class="form-body"> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="report_name" id="form_control_1" placeholder="Enter report Name">
                                    <label for="form_control_1">report Name</label>
                                    <span class="help-block">ex: BCA</span>
                                </div> 
                                <div>
                                    report akan ditambahkan ke dalam master data setelah di approve oleh admin, dikarenakan banyak yang menambahkan report yang sudah ada...
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
@if($isAdmin)
<!-- edit_modal modal-->
<div id="edit_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Master report</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit report</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="update_report_form"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="report_id">
                            <div class="form-body">
                                 <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="report_name" id="form_control_1" placeholder="Enter report Name">
                                    <label for="form_control_1">report Name</label>
                                    <span class="help-block">ex: BCA</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="description" id="form_control_1" placeholder="Enter Description">
                                    <label for="form_control_1">Description</label>
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
@endif
<!-- Modal Export Data -->
<div id="export_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('export/excel/report/')}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong>Export Data</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row"> 
                            <div class="col-md-12">
                                <h4>Type</h4>
                                <p>
                                    <select class="col-md-12 form-control" name="type_export">
                                        <option value="html">HTML</option>
                                        <option value="excel">Excel</option>
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
@endsection




@section('script-js')

<script>
  $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name=_token]').val()
            }
        });
        
    $(function(){
        
        $("[data-hide]").on("click", function(){
            $(this).closest("." + $(this).attr("data-hide")).hide();
        });
        
        
        var grid = new Datatable();

        grid.init({
            src: $("#list_report"),
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
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url"   : "{{url('reportmonthly/datatable')}}",
                    "type"  : "POST"
                },
                columns: [   
                    {data: 'project_id', name: 'vm_report_monthly.project_id'},
                    {data: 'projectname', name: 'vm_report_monthly.projectname'},   
                    {data: 'mail_to', name: 'vm_report_monthly.mail_to'},  
                    {data: 'cc', name: 'vm_report_monthly.cc'},  
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [0, "asc"]
                ],// set first column as a default sort by asc 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
        $form = $("#create_report_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('report/show')}}",
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
        
        $("#submit",$form).click(function(){
           $.ajax({
               'url' : "{{url('report/create')}}",
               'type' : 'POST',
               'data' : $form.serialize(),
               'success' : function(result, textStatus, xhr){
                   console.log(result);
                   grid.getDataTable().ajax.reload(null, false);
                    $("#create_modal").modal('hide');  
                   $(".alert").show(600).children('label').text(result);
                   
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
        $formUpdate = $("#update_report_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/report/edit')}}",
               'type' : 'PUT',
               'data' : $formUpdate.serialize(),
               'success' : function(result, textStatus, xhr){ 
                   grid.getDataTable().ajax.reload(null, false);
                   $("#edit_modal").modal('hide');  
                   $(".alert").show(600).children('label').text(result);
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
        $('#list_report').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/report/') }}' + '/' + dataID,
                    type: 'DELETE',
                    data: dataID,
                    success: function( msg ) {  
                        grid.getDataTable().ajax.reload(null, false);
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
				 