@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/userproject')}}">userproject</a>
        </li> 
    </ul>
</div>
<h3 class="page-title"></h3> 
@endsection

@section('content') 
<div class="row">
    <div class="col-md-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-blue-sharp hide"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase">User Project</span>
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
                                <i class="fa fa-globe"></i>List of User Project
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
                                            Add New <i class="fa fa-plus"></i>
                                            </a>
                                        </div> 
                                        <div class="btn-group">
<!--                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="{{url('export/excel/project')}}" >-->
                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="#export_modal" >
                                            <i class="fa fa-file-excel-o">&nbsp</i>Export Data 
                                            </a>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="list_project">
                            <thead>
                                <tr> 
                                    <th>User Email</th>
                                    <th>Nama</th>
                                    <th>Group User</th>  
                                    <th>Project Name</th>
                                    <th>PT Name</th>  
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
                <h4 class="modal-title">Master Project</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add Project</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_project_form"> 
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_code" id="form_control_1" placeholder="Enter Project Code">
                                    <label for="form_control_1">Project Code</label>
                                    <span class="help-block">ex: R12</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_name" id="form_control_1" placeholder="Enter Project Name">
                                    <label for="form_control_1">Project Name</label>
                                    <span class="help-block">ex: Citra Land Lampung</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_location" id="form_control_1" placeholder="Enter Project Location">
                                    <label for="form_control_1">Project Location</label>
                                    <span class="help-block">ex: Jl.Citra no.24, Lampung</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_location_group" id="form_control_1" placeholder="Enter Project Location Group">
                                    <label for="form_control_1">Project Location Group</label>
                                    <span class="help-block">ex: Lampung</span>
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
                <h4 class="modal-title">Master Project</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit Project</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="update_project_form"> 
                            <input type="hidden" name="project_id">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_code" id="form_control_1" placeholder="Enter Project Code">
                                    <label for="form_control_1">Project Code</label>
                                    <span class="help-block">ex: R12</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_name" id="form_control_1" placeholder="Enter Project Name">
                                    <label for="form_control_1">Project Name</label>
                                    <span class="help-block">ex: Citra Land Lampung</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_location" id="form_control_1" placeholder="Enter Project Location">
                                    <label for="form_control_1">Project Location</label>
                                    <span class="help-block">ex: Jl.Citra no.24, Lampung</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="project_location_group" id="form_control_1" placeholder="Enter Project Location Group">
                                    <label for="form_control_1">Project Location Group</label>
                                    <span class="help-block">ex: Lampung</span>
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
<!-- alert result -->
<div class="alert" >
    <?php
        
    ?>
    <a class="close" onclick="$('.alert').hide()">×</a>  
    <span class="alert-icon" aria-hidden="true"></span>
    <label class="alert-message"></label>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> 
</div> 
<!-- end alert result -->
<!-- Modal Export Data -->
<div id="exports_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><strong>Export Data</strong></h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Start Date</h4>
                            <p>
                                <input type="date" class="col-md-12 form-control">
                            </p> 
                        </div>
                        <div class="col-md-6">
                            <h4>End Date</h4>
                            <p>
                                <input type="date" class="col-md-12 form-control">
                            </p> 
                        </div>
                        <div class="col-md-12">
                            <h4>Type</h4>
                            <p>
                                <select class="col-md-12 form-control">
                                    <option>Excel</option>
                                    <option>PDF</option>
                                </select>
                            </p> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="button" class="btn blue">Export</button>
            </div> 
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- Modal Add Project -->
<div id="export_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><strong>Select Project To Add</strong></h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Start Date</h4>
                            <p>
                                <input type="date" class="col-md-12 form-control">
                            </p> 
                        </div>
                        <div class="col-md-6">
                            <h4>End Date</h4>
                            <p>
                                <input type="date" class="col-md-12 form-control">
                            </p> 
                        </div>
                        <div class="col-md-12">
                            <h4>Type</h4>
                            <p>
                                <select class="col-md-12 form-control">
                                    <option>Excel</option>
                                    <option>PDF</option>
                                </select>
                            </p> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="button" class="btn blue">Export</button>
            </div> 
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
        var grid = new Datatable();

        grid.init({
            src: $("#list_project"),
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
                    "url":  "{{url('project/datatable')}}",
                    "type"  : "POST" 
                },
                 columns: [  
                    {data: 'project_code', name: 'm_project.project_code'},
                    {data: 'project_name', name: 'm_project.project_name'}, 
                    {data: 'project_location', name: 'm_project.project_location'}, 
                    {data: 'project_location_group', name: 'm_project.project_location_group'},  
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
        $form = $("#create_project_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('project/show')}}",
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
               'url' : "{{url('project/create')}}",
               'type' : 'POST',
               'data' : $form.serialize(),
               'success' : function(result, textStatus, xhr){
                   console.log(result);
                   grid.getDataTable().ajax.reload(null, false);
                    $("#create_modal").modal('hide');  
                   
                   alert(result);
                   //show message 
//                   $(".alert-icon").removeClass().addClass("alert-icon glyphicon glyphicon-ok");
//                   $(".alert-message").text("Data created succesfully.");
//                   $(".alert").removeClass().addClass("alert alert-success").show(600); 
                   
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
        $formUpdate = $("#update_project_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/project/edit')}}",
               'type' : 'PUT',
               'data' : $formUpdate.serialize(),
               'success' : function(result, textStatus, xhr){ 
                   grid.getDataTable().ajax.reload(null, false);
                   $("#edit_modal").modal('hide');  
                   //show message 
                   $(".alert-icon").removeClass().addClass("alert-icon glyphicon glyphicon-ok");
                   $(".alert-message").text("Data updated succesfully.");
                   $(".alert").removeClass().addClass("alert alert-success").show(600); 
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
        $('#list_project').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/project/') }}' + '/' + dataID,
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
				 