<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IDE Consulting Services Pvt Ltd</title>

	<link  href="{{asset('/css/bootstrap-cerulean.min.css')}}" rel="stylesheet">

    <link href="{{asset('/css/charisma-app.css')}}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('/bower_components/fullcalendar/dist/fullcalendar.css')}}" rel='stylesheet'>
    <link href="{{asset('/bower_components/fullcalendar/dist/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <link href="{{asset('/bower_components/chosen/chosen.min.css')}}" rel='stylesheet'>
    <link href="{{asset('/bower_components/colorbox/example3/colorbox.css')}}" rel='stylesheet'>
    <link href="{{asset('/bower_components/responsive-tables/responsive-tables.css')}}" rel='stylesheet'>
    <link href="{{asset('/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/jquery.noty.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/noty_theme_default.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/elfinder.min.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/elfinder.theme.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/jquery.iphone.toggle.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/uploadify.css')}}" rel='stylesheet'>
    <link href="{{asset('/css/animate.min.css')}}" rel='stylesheet'>

    <!-- jQuery -->
    <script src="{{asset('/bower_components/jquery/jquery.min.js')}}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">

        <!--fav icon-->
<link rel="apple-touch-icon" sizes="57x57" href="{{asset('/img/ico/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('/img/ico/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('/img/ico/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/ico/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('/img/ico/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('/img/ico/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('/img/ico/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('/img/ico/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/img/ico/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/img/ico/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/img/ico/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('/img/ico/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/ico/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('/img/ico/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{asset('/img/ico/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">
    <!--fav icon-->
</head>
<body>
	
<div class="navbar navbar-default" role="navigation">

            <div class="navbar-inner">
                <button type="button" class="navbar-toggle pull-left animated flip">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="{{URL::to('/')}}"><img alt="" src="{{asset('/img/ide_logo.png')}}" class="hidden-xs" /></a>
               
              
@if (Auth::guest())
					 <!-- theme selector starts -->
         <div class="btn-group pull-right theme-container animated tada">
               <a href="{{URL::to('/')}}"> <button class="btn btn-default" >
                   <i class="fa fa-home"></i><span
                        class="hidden-sm hidden-xs"> Home</span>
                  
                </button></a>
               
            </div>
            <!-- theme selector ends -->

					@else
                <!-- user dropdown starts -->
                <div class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
{{ Auth::user()->name }} 
                </span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                                           
                      <li><a href="{{ url('main/logout') }}">Logout</a></li>
                    </ul>
                </div>
                <!-- user dropdown ends -->
@endif


            </div>
        </div>
	@yield('content')

	<!-- Scripts -->
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- library for cookie management -->
<script src="{{asset('/js/jquery.cookie.js')}}"></script>
<!-- calender plugin -->
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- data table plugin -->
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>

<!-- select or dropdown enhancer -->
<script src="{{asset('/bower_components/chosen/chosen.jquery.min.js')}}"></script>
<!-- plugin for gallery image view -->
<script src="{{asset('/bower_components/colorbox/jquery.colorbox-min.js')}}"></script>
<!-- notification plugin -->
<script src="{{asset('/js/jquery.noty.js')}}"></script>
<!-- library for making tables responsive -->
<script src="{{asset('/bower_components/responsive-tables/responsive-tables.js')}}"></script>
<!-- tour plugin -->
<script src="{{asset('/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js')}}"></script>
<!-- star rating plugin -->
<script src="{{asset('/js/jquery.raty.min.js')}}"></script>
<!-- for iOS style toggle switch -->
<script src="{{asset('/js/jquery.iphone.toggle.js')}}"></script>
<!-- autogrowing textarea plugin -->
<script src="{{asset('/js/jquery.autogrow-textarea.js')}}"></script>
<!-- multiple file upload plugin -->
<script src="{{asset('/js/jquery.uploadify-3.1.min.js')}}"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="{{asset('/js/jquery.history.js')}}"></script>
<!-- application script for Charisma demo -->
<script src="{{asset('/js/charisma.js')}}"></script>

</body>
</html>
