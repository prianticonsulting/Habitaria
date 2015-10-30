<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>@yield('titlePage')</title>
	
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	{{ HTML::style('assets/css/styles.css'); }}

	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/index/images/favicon/apple-icon-57x57.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/index/images/favicon/apple-icon-60x60.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/index/images/favicon/apple-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/index/images/favicon/apple-icon-76x76.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/index/images/favicon/apple-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/index/images/favicon/apple-icon-120x120.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/index/images/favicon/apple-icon-144x144.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/index/images/favicon/apple-icon-152x152.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/index/images/favicon/apple-icon-180x180.png')}}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/index/images/favicon/android-icon-192x192.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/index/images/favicon/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/index/images/favicon/favicon-96x96.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/index/images/favicon/favicon-16x16.png')}}">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
<!-- Bootstrap -->
    {{ HTML::style('assets/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/index/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/index/css/templatemo_style.css'); }}
    {{ HTML::style('assets/index/css/templatemo_misc.css'); }}
    
  <!--   {{ HTML::style('assets/index/css/circle.css'); }} 
    {{ HTML::style('assets/index/css/jquery.bxslider.css'); }} -->
    {{ HTML::style('assets/index/css/nivo-slider.css'); }}
    {{ HTML::style('assets/index/css/slimbox2.css'); }}
    {{ HTML::style('assets/index/css/slimbox2.css'); }}
    
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,600' rel='stylesheet' type='text/css'>
    
    <!--Scripts--> 
	<!--JQuery--> 
	<script src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/index/js/slimbox2.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('assets/index/js/slimbox2.js')}}"></script>
    <!--<script src="{{asset('assets/index/css/ddsmoothmenu.css')}}"></script>-->
    <!-- <script src="{{asset('assets/index/js/ddsmoothmenu.js')}}"></script>-->

<!--/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

-->
<!--
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_flicker", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
-->
</head>

<body>
    @yield('pageContent')
    
    
<!--Scripts--> 
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://code.jquery.com/jquery.js"></script> -->
    
    <script src="{{asset('assets/index/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('assets/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/index/js/jquery.cycle2.min.js')}}"></script>
    <script src="{{asset('assets/index/js/jquery.cycle2.carousel.min.js')}}"></script>
    <script src="{{asset('assets/index/js/jquery.nivo.slider.pack.js')}}"></script>
    <script>$.fn.cycle.defaults.autoSelector = '.slideshow';</script>
    <script src="{{asset('assets/index/js/main.js')}}"></script>
     <!-- <script src="{{asset('assets/index/js/extra.js')}}"></script> -->
	<script src="{{asset('assets/index/js/jquery.singlePageNav.js')}}"></script>
	<script src="{{asset('assets/index/js/extra2.js')}}"></script>
	 <!-- <script src="{{asset('assets/index/js/lib/jquery.mousewheel-3.0.6.pack.js')}}"></script>-->
	<script src="{{asset('assets/index/js/extra3.js')}}"></script>
	<script src="{{asset('assets/index/js/stickUp.min.js')}}"></script>
    <!-- <script src="{{asset('assets/index/js/extra4.js')}}"></script> -->

    <!-- templatemo 396 smoothy -->
	
	<!--Forms--> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="http://localhost/habitaria/public/assets/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  //Registration Form Validation
        if ($('#registrationLogin-form').length) {
            $("#registrationLogin-form").validate({
               
                // Rules for form validation
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                },

                // Messages for form validation
                messages: {
					password: {
                        required: '<span style="color:#FF0000; font-size:12px; margin-left:15px;  margin-top:1px;"> Por favor, ingrese su contraseña </span>',
						minlength: '<span style="color:#FF0000; font-size:12px; margin-left:15px;  margin-top:1px;"> La logitud mínima es de 6 carácteres </span>'
                    },
                    password_confirmation: {
                        required: '<span style="color:#FF0000; font-size:12px; margin-left:15px;  margin-top:1px;"> Ingrese su contraseña una vez mas </span>',
                        equalTo: '<span style="color:#FF0000; font-size:12px; margin-left:15px;  margin-top:1px;"> Introduzca la misma contraseña que la anterior </span>',
						minlength: '<span style="color:#FF0000; font-size:12px; margin-left:15px;  margin-top:1px;"> La logitud mínima es de 6 carácteres </span>'
                    },
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }
});
</script>
	
<!--/Scripts-->
</body>
</html>
