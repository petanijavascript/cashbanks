@extends('layouts.index') 
@show

@section('style')
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css"/>
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
    <div class="col-md-12 col-sm-12">
        <div class="portlet light " style="height:75vh;">
            <img class="logo-main img-responsive" src="{{asset('global/img/logo.png')}}" height="230px;" style="display:none"/  > 
        </div>
    </div>
</div> 
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

     
</script> 
@endsection
				 