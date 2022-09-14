@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/user')}}">User</a>
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
                    <span class="caption-subject font-blue-sharp bold uppercase">User</span>
                    <span class="caption-helper"></span>
                </div>
            </div> 
            <!-- BEGIN Table-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue-chambray">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>List of User
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
<!--                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="{{url('export/excel/user')}}" >-->
                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="#export_modal" >
                                            <i class="fa fa-file-excel-o">&nbsp</i>Export Data 
                                            </a>
                                        </div> 
                                    </div> 
                                </div>
                            </div> 
                            <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="list_user">
								<thead>
									<tr> 
										<th>User ID</th>
										<th>Username</th>
										<th>First Name</th>
										<th>Last Name</th> 
										<th>Email</th>   
										<th>Group User</th>  
										<th colspan="2">&nbsp</th> 
									</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
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
                <h4 class="modal-title">Master User</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add User</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_user_form"> 
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="username" id="form_control_1" placeholder="Enter Username">
                                    <label for="form_control_1">Username</label>
                                    <span class="help-block">ex: usertes123</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="password" class="form-control" name="password" id="form_control_1" placeholder="Enter Password" value="sungairaya">
                                    <label for="form_control_1">Password</label>  
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="first_name" id="form_control_1" placeholder="Enter Your First Name">
                                    <label for="form_control_1">First Name</label>
                                    <span class="help-block">ex: Jack</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="last_name" id="form_control_1" placeholder="Enter Your Last Name">
                                    <label for="form_control_1">Last Name</label>
                                    <span class="help-block">ex: Lie</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="email" id="form_control_1" placeholder="Enter Email">
                                    <label for="form_control_1">Email</label>
                                    <span class="help-block">ex: tes@tes.com</span>
                                </div> 
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="group_user_id" id="form_control_1">
                                        @foreach($listGroupUser as $groupUser)
                                            <option value="{{$groupUser->group_user_id}}">{{$groupUser->group_detail}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">User Group</label> 
                                </div> 
                                <div class="form-group form-md-line-input"> 
                                    <input type="hidden" class="form-control list_project_request" name="project" > 
                                    <label for="form_control_1">Project</label> 
                                    <table class="table table-striped list_project_add">  
                                        <thead>
                                            <tr>
                                                <th>PT</th>
                                                <th>Project</th>
                                                <th></th>
                                            </tr> 
                                        </thead>  
                                        <tbody>
                                        </tbody>
                                    </table> 
                                    <div class="row" style="margin-top:10px;">
                                         <div class="col-md-12">
                                             <a class="btn grey fa fa-plus" id="add_project"  data-toggle="modal" href="#project_modal">&nbspAdd Project</a>
                                        </div>
                                    </div> 
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
                <button type="button" class="close cancel_update" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Master User</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit User</span>
                        </div> 
                    </div>
                    <!-- modal form update -->
                    <div class="portlet-body form">
                        <form role="form" id="update_user_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id"> 
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="username" id="form_control_1" placeholder="Enter Username">
                                    <label for="form_control_1">Username</label>
                                    <span class="help-block">ex: usertes123</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="password" class="form-control" name="password" id="form_control_1" placeholder="Enter Password">
                                    <label for="form_control_1">Password</label> 
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="first_name" id="form_control_1" placeholder="Enter Your First Name">
                                    <label for="form_control_1">First Name</label>
                                    <span class="help-block">ex: Jack</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="last_name" id="form_control_1" placeholder="Enter Your Last Name">
                                    <label for="form_control_1">Last Name</label>
                                    <span class="help-block">ex: Lie</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="email" id="form_control_1" placeholder="Enter Email">
                                    <label for="form_control_1">Email</label>
                                    <span class="help-block">ex: tes@tes.com</span> 
                                </div> 
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="group_user_id" id="form_control_1">
                                        @foreach($listGroupUser as $groupUser)
                                            <option value="{{$groupUser->group_user_id}}">{{$groupUser->group_detail}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">User Group</label> 
                                </div> 
                                <div class="form-group form-md-line-input"> 
                                    <input type="hidden" class="form-control list_project_request" name="project"> 
                                    <label for="form_control_1">Project</label> 
                                    <table class="table table-striped list_project_add">  
                                        <thead>
                                            <tr>
                                                <th>PT</th>
                                                <th>Project</th>
                                                <th></th>
                                            </tr> 
                                        </thead>  
                                        <tbody>
                                        </tbody>
                                    </table> 
                                    <div class="row" style="margin-top:10px;">
                                         <div class="col-md-12">
                                             <a class="btn grey fa fa-plus" id="add_project"  data-toggle="modal" href="#project_modal">&nbspAdd Project</a>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                            <div class="form-actions noborder">
                                <button type="button" class="btn blue" id="submit">Submit</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default cancel_update">Cancel</button>
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
<!-- Modal Exports -->
<div id="export_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('export/excel/user/')}}">
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
<!-- End Modal Export --> 
<!-- Project Modal -->
<div id="project_modal" class="modal fade bs-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><strong>Select Project to Add</strong></h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="list_project">
                <thead>
                    <tr> 
                        <th>Project Code</th>
                        <th>PT Name</th>
                        <th>Project Name</th>
                        <th>Project Location</th> 
                        <th>Project Location Group</th> 
                        <th colspan="1">&nbsp</th> 
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="button" class="btn blue" id="get_project">Add</button>
            </div> 
        </div>
    </div>
</div>
<!-- End Modal Export --> 
@endsection


@section('script-js')

<script>
  $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name=_token]').val()
            }
        });
        
    var listProjectIDSelected = [];
    
    $(function(){
        
        $("[data-hide]").on("click", function(){
            $(this).closest("." + $(this).attr("data-hide")).hide();
        });
        
        
        var grid = new Datatable(); 
        grid.init({
            src: $("#list_user"),
            onSuccess: function (grid) { 
            },
            onError: function (grid) {  
            },
            onDataLoad: function(grid) { 
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
                    "url":  "{{url('user/datatable')}}", 
                    "type"  : "POST" 
                },
                 columns: [  
                    {data: 'user_id', name: 'm_user.user_id'},
                    {data: 'username', name: 'm_user.username'}, 
                    {data: 'first_name', name: 'm_user.first_name'}, 
                    {data: 'last_name', name: 'm_user.last_name'},  
                    {data: 'email', name: 'm_user.email'},  
                    {data: 'group_detail', name: 'group_detail'},  
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [0, "DESC"]
                ], 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0,4,5 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
        
        
        $form = $("#create_user_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('user/show')}}",
                data : {
                    id : id
                },
                success : function(result){ 
                    for(var key in result){ 
//                        alert(result['list_project'][0]['project_id']); 
                        $("[name="+key+"]", $("#edit_modal")).val(result[key]);
                    } 
                    //clear array
                    listProjectIDSelected = [];
                    listProjectNameSelected = [];
                    listPTNameSelected = []; 
                    // get list project
                    for(var i=0;i<result['list_project'].length;i++){
                        listProjectIDSelected.push(result['list_project'][i]['project_id']);
                        listProjectNameSelected.push(result['list_project'][i]['project_name']);
                        listPTNameSelected.push(result['list_project'][i]['pt_name']);
                    }
                    //set to request
                    $(".list_project_request").val(listProjectIDSelected); 
                    //clear table first
                    $(".list_project_add").children("tbody").empty();
                    //Draw Table
                    for(var i =0 ;i<listProjectIDSelected.length;i++){ 
                        $(".list_project_add").children("tbody").append("<tr><td>"+listPTNameSelected[i]+"</td><td>"+listProjectNameSelected[i]+"</td><td><a class=\"btn_delete fa fa-trash\" onClick=\"removeSelectedProject("+listProjectIDSelected[i]+")\"></td></tr>");
                    }
                }
           }) 
        });       
        
        $("#submit",$form).click(function(){
           $.ajax({
               'url' : "{{url('user/create')}}",
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
        $formUpdate = $("#update_user_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/user/edit')}}",
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
        $('#list_user').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/user/') }}' + '/' + dataID,
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
        
         
        //datatable for project
        var grid2 = new Datatable(); 
        grid2.init({
            src: $("#list_project"),
            onSuccess: function (grid) { 
            },
            onError: function (grid) { 
            },
            onDataLoad: function(grid) { 
            },
            loadingMessage: 'Loading...',
            dataTable: {  
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'f>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true,  

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"]  
                ],
                "pageLength": 10,  
                "ajax": {
                    "url":  "{{url('user/datatableProject')}}",
                    "type"  : "GET" 
                },
                 columns: [  
                    {data: 'project_code', name: 'project_code'},
                    {data: 'pt_name', name: 'pt_name'},
                    {data: 'project_name', name: 'project_name'}, 
                    {data: 'project_location', name: 'project_location'}, 
                    {data: 'project_location_group', name: 'project_location_group'},  
                    {data: 'checkbox', name: 'checkbox', "width": "20px", orderable: false, searchable: false}
                ],
                "order": [
                    [2, "asc"]
                ], 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        
       listProjectNameSelected = [];
       listPTNameSelected = []; 
        
        $("#get_project").on("click", function(){ 
            //clear table
            $(".list_project_add").children("tbody").empty(); 
            
            @foreach($listProject as $l)
                if($("#check_{{$l->project_id}}").is(':checked')){
                    if(!isAlreadyExistOnArray({{$l->project_id}})){ 
                        listProjectIDSelected.push({{$l->project_id}});
                        listProjectNameSelected.push("{{$l->project_name}}");
                        listPTNameSelected.push("{{$l->pt_name}}");
                    } 
                }
            @endforeach  
            for(var i =0 ;i<listProjectIDSelected.length;i++){ 
                $(".list_project_add").children("tbody").append("<tr><td>"+listPTNameSelected[i]+"</td><td>"+listProjectNameSelected[i]+"</td><td><a class=\"btn_delete fa fa-trash\" onClick=\"removeSelectedProject("+listProjectIDSelected[i]+")\"></td></tr>");
            }
            $(".list_project_request").val(listProjectIDSelected); 
            
            $("#project_modal").modal('hide'); 
        });
        
        
        $(".cancel_update").on("click", function(){
            //clear value in modal and array
            listProjectIDSelected = [];
            listProjectNameSelected = [];
            listPTNameSelected = [];  
            $(".list_project_add").children("tbody").empty();
        });
        
        
    }); 
    function isAlreadyExistOnArray(projectID){ 
        for(var i=0;i<listProjectIDSelected.length;i++){
            if(listProjectIDSelected[i]==projectID)
                return true;
        }
    }
    function removeSelectedProject(projectID){
        //remove from array
        for(var i=0;i<listProjectIDSelected.length;i++){ 
            if(listProjectIDSelected[i]==projectID){
                listProjectIDSelected.splice(i,1);
                listPTNameSelected.splice(i,1);
                listProjectNameSelected.splice(i,1);
            }
        } 
        //set to request
        $(".list_project_request").val(listProjectIDSelected); 
        //clear table
        $(".list_project_add").children("tbody").empty();
        for(var i =0 ;i<listProjectIDSelected.length;i++){  
            $(".list_project_add").children("tbody").append("<tr><td>"+listPTNameSelected[i]+"</td><td>"+listProjectNameSelected[i]+"</td><td><a class=\"btn_delete fa fa-trash\" onClick=\"removeSelectedProject("+listProjectIDSelected[i]+")\"></td></tr>");
        }
    }
    
    
</script>
@endsection
				 