<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Ciputra</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link rel="icon" type="image/x-icon" href="https://ces.ciputragroup.com/webapps/Ciputra/public/app/main/images/icons/Ciputra.ico">
	<link rel="shortcut icon" type="image/x-icon" href="https://ces.ciputragroup.com/webapps/Ciputra/public/app/main/images/icons/Ciputra.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('css/loader.css')}}" rel="stylesheet" type="text/css"/> 
    <!-- END GLOBAL MANDATORY STYLES --> 
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<!--    <link href="{{asset('global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{asset('global/plugins/morris/morris.css')}}" type="text/css"/> to make chart-->
<!--    <link href="{{asset('global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css"/>-->
    <link href="{{asset('global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES --> 
    <!-- BEGIN PAGE STYLES -->
    <link href="{{asset('global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="{{asset('global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES --> 
    <!-- BEGIN THEME STYLES --> 
    <link href="{{asset('layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147212443-6"></script> -->
    <style>
        /* Center the loader */
        #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        border-bottom: 16px solid #3498db;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
        }
    </style>
	<!-- <script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-147212443-6');
	</script>	 -->
    <!-- END THEME STYLES --> 
    @yield('style')
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed">
<div id="loader"></div>
@section('header')
    @include('layouts.header')
@show
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	@section('sidebar')
        @include('layouts.sidebar')
    @show
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content"> 
            @yield('page-bar')
            
			@yield('content')
		</div> 
	</div> 
	<!-- END CONTENT -->
	@section('quicksidebar')
        @include('layouts.quicksidebar')
    @show
</div>
<!-- END CONTAINER -->
@section('footer')
    @include('layouts.footer')
@show   
<script src="{{asset('global/scripts/main.js')}}" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('global/plugins/moment.min.js')}}" type="text/javascript"></script> 
<script src="{{asset('global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<!--<script src="{{asset('global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>    -->
<script src="{{asset('global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script> 
<script src="{{asset('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('global/plugins/datatables/pdfmake.min.js.map.js')}}" type="text/javascript"></script>   -->
<script src="{{asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('pages/scripts/table-datatables-ajax.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->   
@yield('script-js')
<script>
    $(document).ajaxStart(function(){ 
        $('#loader').show(); 
    });
    $(document).ajaxStop(function(){ 
        $('#loader').hide(); 
    });
    window.onload = function() {
        $('#loader').hide(); 
    };
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
