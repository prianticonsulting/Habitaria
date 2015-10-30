@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA
@stop
@section ('cssPage')
	{{ HTML::style('assets/css/styles.css'); }}
@stop
{{-- Content --}}
@section ('pageContent')
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script> 
<div class="colorful-page-wrapper">
  <div class="center-block">
    <div class="login-block">
	<div class="powerwidget-ctrls"> <a href="{{URL::route('login')}}" class="button-icon powerwidget-delete-btn"><h2><small><i class="icon fa entypo-cancel"></i></small></h2></a></div>
	<!--REGISTER -->
	{{ Form::open(['action'=>'UsersController@store','files'=>'true', 'id'=>'registrationLogin-form', 'class'=>'orb-form']) }}
        <header>
          <div class="image-block"><img src="{{asset('assets/index/images/ui-sam.png')}}" alt="User" /></div>
          <strong>Error Interno del Servidor</strong> <small style="font-weight:bold; font-weight:18px;"> La página no se puede mostrar</small>

		  </header>
		  <img src="{{asset('assets/index/images/error.png')}}" alt="Ooops!>
        
      {{ Form::close() }}
    </div>
    <div class="using-social-header"></div>
    <div class="social-buttons">
      <ul class="social">
        <li><a href="http://facebook.com/"><i class="entypo-facebook-circled"></i></a></li>
        <li><a href="http://google.com/"><i class="entypo-gplus-circled"></i></a></li>
        <li><a href="http://twitter.com/"><i class="entypo-twitter-circled"></i></a></li>
      </ul>
    </div>
    <div class="copyrights"> Copyright © 2015 <a href="#">Habitaria</a> | </div>
  </div>
</div>

<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Forms-->
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.maskedinput.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery-steps/jquery.steps.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script> 

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<!--/Scripts-->

@stop