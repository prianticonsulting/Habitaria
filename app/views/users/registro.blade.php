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
	<div class="powerwidget-ctrls"> <a href="{{URL::route('users.registro.admin')}}" class="button-icon powerwidget-delete-btn"><h2><small><i class="icon fa entypo-cancel"></i></small></h2></a></div>
	<!--REGISTER -->
	{{ Form::open(['action'=>'UsersController@store','files'=>'true', 'id'=>'registrationLogin-form', 'class'=>'orb-form']) }}
        <header>
          <div class="image-block"><img src="{{asset('assets/index/images/ui-sam.png')}}" alt="User" /></div>
          Nueva Colonia <small style="font-weight:bold; font-weight:18px;"> Ya tienes una cuenta? - <a href="{{URL::route('users.registro.admin')}}"> <span class="text-success" style="font-weight:bold; font-weight:20px">ENTRA AQUÍ</span></a></span><br>

		  </header>
        <fieldset>
			<section>
				<center>
				  <label class="label col-9">
				  Registrate para crear una nueva colonia
				  </label>			
				</center>				
			</section>
			
          <section>
            <div class="row">
              <label class="label col col-4">E-mail</label>
              <div class="col col-8">
                <label class="input" id="label_email"> <i class="icon-append fa fa-user"></i>
				    <input type="email" name="email"  placeholder="Email" id="email"  data-toggle="popover" data-content="Este email ya esta registrado" onblur="emailUnique()"> 
                </label>
              </div>
            </div>
          </section>
          <section>
            <div class="row">
              <label class="label col col-4">Contraseña</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input type="password" name="password2" placeholder="Contraseña" id="password2">
                </label>
              </div>
            </div>
          </section>
		  <section>
            <div class="row">
              <label class="label col col-4">Confirmar</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirmar contraseña">
                </label>
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
        </fieldset>
        <footer>
          <button type="submit" class="btn btn-default" id="registrar">Registrar</button>
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

<script type="text/javascript">
	function emailUnique() {

		var value = $('#email').val();
		if(value){
			
			   $.ajax({ 
					Type: "get",
                    url: "{{ url('emailUser')}}", 
                    data: "email="+value,
                    dataType: "json",
					//async:false,					
                    success: function(data) { 
                            if(data.response == 1){ 
								  $('#label_email').removeClass("state-success"); 
								  $('#label_email').addClass("state-error"); 
								  document.getElementById('registrar').disabled = true;
								   $('#email').popover("show");
									
									$('#email').click(function(){
										$('#email').popover("hide");
									});
									
							}else{
								  $('#label_email').addClass("state-success"); 
								  $('#email').popover("hide");
								  document.getElementById('registrar').disabled = false;
								  }
                    },					
                });

			}
		
		}
</script>


<!--/Scripts-->

@stop