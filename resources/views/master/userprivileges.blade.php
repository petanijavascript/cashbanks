@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/userprivileges')}}">User Privileges</a>
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
                    <span class="caption-subject font-blue-sharp bold uppercase">User Privileges</span>
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
                                <i class="fa fa-globe"></i>List of User Privileges
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
                            <table class="table table-striped table-bordered table-hover" id="list_user_privileges">
                            <thead>
                                <tr> 
                                    <th>Menu ID</th>
                                    <th>Menu Name</th>
                                    <th>Group User</th>
                                    <th>View Data</th>
                                    <th>CRUD</th>  
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
                <h4 class="modal-title">Master User Privileges</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add User Privileges</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_user_privileges_form"> 
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="menu_id" id="form_control_1">
                                        @foreach($listMenu as $menu)
                                            <option value="{{$menu->menu_id}}">{{$menu->name}}{{$menu->parent_id}}
                                            @if($menu->parent_menu_id === null)
                                                (Parent Menu)
                                            @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Menu</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="group_user_id" id="form_control_1">
                                        @foreach($listGroupUser as $groupUser)
                                            <option value="{{$groupUser->group_user_id}}">{{$groupUser->group_code}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Group User</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="view_data" id="form_control_1"> 
                                        <option value="1">Yes</option> 
                                        <option value="0">No</option> 
                                    </select>
                                    <label for="form_control_1">View Data</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="crud_access" id="form_control_1"> 
                                        <option value="1">Yes</option> 
                                        <option value="0">No</option> 
                                    </select>
                                    <label for="form_control_1">Doing CRUD</label> 
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
                <h4 class="modal-title">Master User Privileges</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit User Privileges</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="update_user_privileges_form"> 
                            <input type="hidden" name="user_privileges_id">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="menu_id" id="form_control_1">
                                        @foreach($listMenu as $menu)
                                            <option value="{{$menu->menu_id}}">{{$menu->name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Menu</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="group_user_id" id="form_control_1">
                                        @foreach($listGroupUser as $groupUser)
                                            <option value="{{$groupUser->group_user_id}}">{{$groupUser->group_code}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Group User</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="view_data" id="form_control_1"> 
                                        <option value="1">Yes</option> 
                                        <option value="0">No</option> 
                                    </select>
                                    <label for="form_control_1">View Data</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="crud_access" id="form_control_1"> 
                                        <option value="1">Yes</option> 
                                        <option value="0">No</option> 
                                    </select>
                                    <label for="form_control_1">Doing CRUD</label> 
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
            src: $("#list_user_privileges"),
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
                    "url":  "{{url('userprivileges/datatable')}}",
                    "type"  : "POST" 
                },
                 columns: [  
                    {data: 'menu_id', name: 'menu_id'},
                    {data: 'name', name: 'menu_name'},
                    {data: 'group_code', name: 'group_code'}, 
                    {data: 'view_data', name: 'view_data'}, 
                    {data: 'crud_access', name: 'crud_access'},    
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [0, "DESC"]
                ],// set first column as a default sort by asc 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0,1,2,3,4 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
        $form = $("#create_user_privileges_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('userprivileges/show')}}",
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
               'url' : "{{url('userprivileges/create')}}",
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
        $formUpdate = $("#update_user_privileges_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/userprivileges/edit')}}",
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
        $('#list_user_privileges').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/userprivileges/') }}' + '/' + dataID,
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
				 
				 