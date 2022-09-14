@extends('layouts.index') 
@show

@section('page-bar')  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{url('/bankaccount')}}">Bank Account</a>
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
                    <span class="caption-subject font-blue-sharp bold uppercase">Bank Account</span>
                    <span class="caption-helper">Master Data</span>
                </div>
            </div> 
            <!-- BEGIN Table -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue-chambray">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>List of Bank Account
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
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="#create_modal">
                                            Add New <i class="fa fa-plus"></i>
                                            </a>
                                        </div> 
                                        <div class="btn-group">
<!--                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="{{url('export/excel/bank')}}" >-->
                                            <a id="sample_editable_1_new" class="btn blue"  data-toggle="modal" href="#export_modal" >
                                            <i class="fa fa-file-excel-o">&nbsp</i>Export Data 
                                            </a>
                                        </div> 
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">Project : 
                                            <select class="table-group-action-input form-control input-inline input-sm" id="view_project_selected">    
                                                @foreach($listProject as $p)
                                                    <option value="{{$p->project_id}}">@if($p->pt_name!=""){{$p->pt_name}},@endif {{$p->project_name}}</option> 
                                                @endforeach 
                                            </select>  
										</div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group pull-right">Transaction Type : 
                                            <select class="table-group-action-input form-control input-inline input-sm" id="view_transaction_type_selected">  
                                                <option value="cashbank">Kas</option>  
                                                <option value="deposit">Deposit</option>  
                                                <option value="escrow">Escrow</option>  
                                                <option value="bank_operational">Bank Operational</option>  
                                                <option value="bank_loan">Bank Loan</option>  
                                                <option value="bank_dk">Bank Dana Kebersamaan</option>  
                                                <option value="reksadana">Reksadana</option>  
                                            </select>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="list_bank_account">
                            <thead>
                                <tr>  
                                    <th>Bank Name</th>
                                    <th>Account No</th>  
                                    <th>Detail</th>      
                                    <th colspan="2">&nbsp</th> 
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- END EXAMPLE TABLE PORTLET -->
                </div>
            </div>  
            <!-- END Table -->
        </div>
        <!-- END PORTLET -->
    </div>
</div>



<!-- PROPERTIES HERE ALL -->
<!-- create_modal modal -->
<div id="create_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Master Bank Account</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Add Bank Account</span>
                        </div> 
                    </div>
                    <!-- modal form add -->
                    <div class="portlet-body form">
                        <form role="form" id="create_bank_account_form"> 
                            {{ csrf_field() }}
                            <div class="form-body"> 
							<input type="hidden" name="aktif" value="1">
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="project_id" id="select_project_add"> 
                                        @foreach($listProject as $project)
                                            <option value="{{$project->project_id}}">{{$project->pt_name}}, {{$project->project_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Project</label> 
                                </div>
                                <div class="form-group form-md-line-input">  
                                    <label class="transaction_type_request_label">Kas</label>
                                    <input type="hidden" class="form-control transaction_type_request" name="transaction_type" readonly="readonly" value="cashbank"> 
                                    <label>Transaction Type</label>  
                                </div>
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="bank_id" id="form_control_1">
                                        @foreach($listBank as $bank)
                                            <option value="{{$bank->bank_id}}">{{$bank->bank_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Bank</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="account_no" id="form_control_1" placeholder="Enter Account Number">
                                    <label for="form_control_1">Account No</label> 
                                    <span class="help-block">example : 527 119 1279</span>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="account_detail" id="form_control_1" placeholder="Enter Account Detail">
                                    <label for="form_control_1">Account Detail</label>
                                    <span class="help-block">example : a/n Rieky Lesmana</span>
                                </div>
                                <div class="form-group form-md-line-input modal_currency_type">
                                    <select class="form-control" name="currency" id="form_control_1">  
                                        <option value="IDR">IDR</option>  
                                        <option value="USD">USD</option>    
                                    </select>
                                    <label for="form_control_1">Currency</label> 
                                </div>
                                <div class="form-group form-md-line-input modal_bank_operational" style="display:none;"> 
                                    <select class="form-control" name="operational_type" id="form_control_1">  
                                        <option value="operational">Operational</option> 
                                        <option value="operational-jo">Operational - JO</option> 
                                        <option value="rekber-jo">Rekening Bersama - JO</option>
                                        <option value="reksadana">Reksadana</option> 
                                    
                                    </select>
                                    <label for="form_control_1">Operational Type</label> 
                                </div> 
                                <div class="form-group form-md-line-input modal_deposit_type" style="display:none;"> 
                                    <select class="form-control" name="deposit_type" id="form_control_1">  
                                        <option value="deposit">Deposito</option>  
                                        <option value="deposit-dk">Deposito Dana Kebersamaan</option>  
                                        <option value="deposit-jo">Deposit JO</option> 
                                        <option value="deposit-doc">Deposito On Call</option>  
										<option value="deposit-doc-dk">Deposito On Call DK</option>   
                                    </select>
                                    <label for="form_control_1">Deposit Type</label> 
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
                <h4 class="modal-title">Master Bank Account</h4>
            </div>
            <div class="modal-body">     
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Edit Bank Account</span>
                        </div> 
                    </div>
                    <!-- modal form edit -->
                    <div class="portlet-body form">
                        <form role="form" id="update_bank_account_form"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="bank_account_id">
                            <div class="form-body">
								<input type="hidden" name="aktif" value="1">
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
                                    <label class="transaction_type_request_label">Cash Bank</label>
                                    <input type="hidden" class="form-control transaction_type_request" name="transaction_type" readonly="readonly" value="cashbank"> 
                                    <label>Transaction Type</label>  
                                </div>
                                <div class="form-group form-md-line-input"> 
                                    <select class="form-control" name="bank_id" id="form_control_1">
                                        @foreach($listBank as $bank)
                                            <option value="{{$bank->bank_id}}">{{$bank->bank_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="form_control_1">Bank</label> 
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="account_no" id="form_control_1" placeholder="Enter Account Number">
                                    <label for="form_control_1">Account No</label>
                                </div> 
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="account_detail" id="form_control_1" placeholder="Enter Account Detail">
                                    <label for="form_control_1">Account Detail</label>
                                </div>
                                <div class="form-group form-md-line-input modal_currency_type">
                                    <select class="form-control" name="currency" id="form_control_1">  
                                        <option value="IDR">IDR</option>  
                                        <option value="USD">USD</option>   
                                    </select>
                                    <label for="form_control_1">Currency</label> 
                                </div>
                                <div class="form-group form-md-line-input modal_bank_operational" style="display:none;"> 
                                    <select class="form-control" name="operational_type" id="form_control_1">  
                                        <option value="operational">Operational</option> 
                                        <option value="operational-jo">Operational - JO</option> 
                                        <option value="rekber-jo">Rekening Bersama - JO</option>
                                        <option value="reksadana">Reksadana</option>
                                    </select>
                                    <label for="form_control_1">Operational Type</label> 
                                </div>  
                                <div class="form-group form-md-line-input modal_deposit_type" style="display:none;"> 
                                    <select class="form-control" name="deposit_type" id="form_control_1">  
                                        <option value="deposit">Deposit</option> 
                                        <option value="deposit-dk">Deposit Dana Kebersamaan</option> 
                                        <option value="deposit-jo">Deposit JO</option> 
                                        <option value="deposit-doc">Deposito On Call</option>   
										<option value="deposit-doc-dk">Deposito On Call DK</option>   
                                    </select>
                                    <label for="form_control_1">Deposit Type</label> 
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
<!-- Modal Export Data -->
<div id="export_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('export/excel/bankaccount/')}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong>Export Data</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
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
                            <div class="col-md-12">
                                <h4>Transaction Type</h4>
                                <p>
                                    <select class="form-control" name="transaction_type" id="transaction_type_selected_export"> 
                                        <option value="cashbank">Kas</option>  
                                        <option value="deposit">Deposit</option>  
                                        <option value="escrow">Escrow</option>  
                                        <option value="bank_operational">Bank Operational</option>  
                                        <option value="bank_loan">Bank Loan</option>  
                                        <option value="bank_dk">Bank Dana Kebersamaan</option> 
                                        <option value="reksadana">Reksadana</option>  
                                    </select>
                                </p> 
                            </div>
                        </div>
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
            src: $("#list_bank_account"),
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
                    "url":  "{{url('bankaccount/datatable')}}",
                    "type"  : "POST", 
                    data: function(d){ 
                        d.projectSelected = $('#view_project_selected').val();  
                        d.transactionType = $('#view_transaction_type_selected').val();   
                    }
                },
                 columns: [   
                    {data: 'bank_name', name: 'bank_name'}, 
                    {data: 'account_no', name: 'account_no'}, 
                    {data: 'account_detail', name: 'account_detail'},  
                    {data: 'action_update', name: 'action_update', orderable: false, searchable: false},
                    {data: 'action_delete', name: 'action_delete', orderable: false, searchable: false} 
                ],
                "order": [
                    [2, "asc"]
                ],// set first column as a default sort by asc 
                "aoColumnDefs": [  
                    {
                        "aTargets": [ 0, 1 ],
                        "sClass":"text-center" 
                    }
                ]
            }
        });
        $('#view_project_selected').change(function (e) {   
            grid.getDataTable().ajax.reload(null, false); 
            //set request year and project
            $("#select_project_add").val($("#view_project_selected").val());
            $("#project_selected_export").val($("#view_project_selected").val());
        });
        $('#view_transaction_type_selected').change(function (e) {    
            grid.getDataTable().ajax.reload(null, false); 
            var transactionType         = $("#view_transaction_type_selected").val(); 
            var transactionTypeLabel    = $("#view_transaction_type_selected option:selected").text();  
            $(".transaction_type_request_label").text(transactionTypeLabel);
            $(".transaction_type_request").val(transactionType); 
            $("#transaction_type_selected_export").val(transactionType);
            
            if(transactionType == "bank_operational"){
                $(".modal_currency_type").show();
                $(".modal_currency_type select").val("IDR");
                $(".modal_bank_operational").show();
                $(".modal_bank_operational select").val("operational");
                $(".modal_deposit_type").hide();
                $(".modal_deposit_type select").val(null);
            }else if(transactionType == "deposit"){
                $(".modal_currency_type").show();
                $(".modal_currency_type select").val("IDR");
                $(".modal_deposit_type").show();
                $(".modal_deposit_type select").val("deposit");
                $(".modal_bank_operational").hide();
                $(".modal_bank_operational select").val(null);
            }else if(transactionType == "cashbank"){
                $(".modal_currency_type").show();
                $(".modal_currency_type select").val("IDR");
                $(".modal_bank_operational").hide();
                $(".modal_bank_operational select").val(null);
                $(".modal_deposit_type").hide();
                $(".modal_deposit_type select").val(null);
            }else if(transactionType == "reksadana"){
                $(".modal_currency_type").show();
                $(".modal_currency_type select").val("IDR");
                $(".modal_bank_operational").show();
                $(".modal_bank_operational select").val("reksadana");
                $(".modal_deposit_type").hide();
                $(".modal_deposit_type select").val(null);
            }else{
                $(".modal_currency_type").hide();
                $(".modal_currency_type select").val(null);
                $(".modal_bank_operational").hide();
                $(".modal_bank_operational select").val(null);
                $(".modal_deposit_type").hide();
                $(".modal_deposit_type select").val(null);
            }  
            
        });
        
        $form = $("#create_bank_account_form"); 
        $(document).on('click','.btn_show', function(){
            var id = $(this).data('id');
            
            $.ajax({
               'url' : "{{url('bankaccount/show')}}",
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
               'url' : "{{url('bankaccount/create')}}",
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
        $formUpdate = $("#update_bank_account_form");
        $("#submit",$formUpdate).click(function(){
           $.ajax({
               'url' : "{{url('/bankaccount/edit')}}",
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
        $('#list_bank_account').on('click', '.btn_delete', function (e) {  
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
                    url: '{{ url('/bankaccount/') }}' + '/' + dataID,
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
				 