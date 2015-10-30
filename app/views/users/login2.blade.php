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
	{{ Form::open(['action'=>'UsersController@doLogin','files'=>'true', 'id'=>'login-form', 'class'=>'orb-form']) }}
        <header>
          <div class="image-block"><img src="{{asset('assets/index/images/ui-sam.png')}}" alt="User" /></div>
          HABITARIA<small class="text-success"  style="font-weight:bold; font-size:14px;">Inicia sesión aquí para crear una nueva colonia</small>
		</header>
        <fieldset>
          <section>
            <div class="row">
              <label class="label col col-4">E-mail</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="email" name="email" id ="email1" placeholder="Email">
				  <input type="hidden" name="crearColonia"  value="1">
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <label class="label col col-4">Contraseña</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input type="password" name="password" placeholder="Contraseña">
                </label>
				<div class="note"><a href="{{URL::route('forgot')}}">Olvidaste tu contraseña?</a></div>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <div class="col col-4"></div>
              <div class="col col-8">
                <label class="checkbox">
				  <input type="hidden"	name="remember" value="0">
                  <input type="checkbox" name="remember"  id="remember" value="1" checked>
                  <i></i>Recordar mis datos</label>				  
              </div>
            </div>
          </section>
		  <section>
		  <div align="Center">
			Si aún no tienes cuenta <a href="{{URL::route('users.registro')}}"> <span class="text-success" style="font-weight:bold; font-weight:20px">REGISTRATE AQUÍ</span></a>
		  </div>
		  </section>
        </fieldset>
        <footer>
          <button type="submit" class="btn btn-default">Iniciar sesión</button>
        </footer>
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