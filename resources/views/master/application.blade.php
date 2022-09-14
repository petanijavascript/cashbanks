@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/application')}}">Application</a>
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
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-blue-sharp hide"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase">Application</span>
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
                                <i class="fa fa-globe"></i>List of Application
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
                                    </div> 
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="list_application">
                            <thead>
                                <tr>  
                                    <th>Application Name</th>
                                    <th>Application Detail</th> 
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
    </div>
</div>

<!-- PROPERTIES HERE ALL -->
<!-- create_modal modal-->
<div id="create_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Master Application</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add Application</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_application_form"> 
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="name" id="form_control_1" placeholder="Enter Application Name">
                                    <label for="form_control_1">Application Name</label>
                                    <span class="help-block">ex: Application Cash Bank</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="description" id="form_control_1" placeholder="Enter Application Detail">
                                    <label for="form_control_1">Application Detail</label> 
                                    <span class="help-block">ex: Application for calculate blabla</span>
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
                <h4 class="modal-title">Master Application</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit Application</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="update_application_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="app_id"> 
                            <div class="form-body">
                                 <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="name" id="form_control_1" placeholder="Enter Application Name">
                                    <label for="form_control_1">Application Name</label>
                                    <span class="help-block">ex: Application Cash Bank</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="description" id="form_control_1" placeholder="Enter Application Detail">
                                    <label for="form_control_1">Application Detail</label> 
                                    <span class="help-block">ex: Application for calculate blabla</span>
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
            src: $("#list_application"),
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
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

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
                    "url"   : "{{url('application/datatable')}}",
                    "type"  : "POST" 
                },
                 columns: [   
                    {data: 'name', name: 'm_application.name'}, 
                    {data: 'description', name: 'm_application.description'},  
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
        
        $form = $("#create_application_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('application/show')}}",
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
               'url' : "{{url('application/create')}}",
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
        $formUpdate = $("#update_application_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/application/edit')}}",
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
        $('#list_application').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/application/') }}' + '/' + dataID,
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
				 