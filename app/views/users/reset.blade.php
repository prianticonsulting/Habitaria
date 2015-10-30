@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA - Restablecer contraseña
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
	<form method="POST" action="{{{ URL::to('/users/reset_password') }}}" id="registrationLogin-form2" class="orb-form" accept-charset="UTF-8">
    <input type="hidden" name="token" value="{{{ $token }}}">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
        <header>
          <div class="image-block"><img src="{{asset('assets/index/images/ui-sam.png')}}" alt="User" /></div>
          HABITARIA<small class="text-success"  style="font-weight:bold; font-size:14px;">Restablecer contraseña</small>
		</header>
        <fieldset>
          <section>
            <div class="row">
                <label class="label col col-4">Contraseña</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input placeholder="Contraseña" type="password" name="password" id="password">
                </label>
              </div>
            </div>
          </section>
		   <section>
            <div class="row">
                <label class="label col col-4">Confirmar</label>
              <div class="col col-8">
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input  placeholder="Confirmar contraseña" type="password" name="password_confirmation" id="password_confirmation">
                </label>
              </div>
            </div>
          </section>
        </fieldset>
        <footer>
          <button type="submit" class="btn btn-default">Guardar</button>
        </footer>
     </form>
    </div>
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

      if ($('#registrationLogin-form2').length) {
            $("#registrationLogin-form2").validate({
               
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
                        required: '<span style="color:#FF0000; font-size:11px; margin-left:15px;  margin-top:1px;"> Por favor, ingrese su contraseña </span>',
						minlength: '<span style="color:#FF0000; font-size:11px; margin-left:15px;  margin-top:1px;"> La logitud mínima es de 6 carácteres </span>'
                    },
                   password_confirmation: {
                        required: '<span style="color:#FF0000; font-size:11px; margin-left:15px;  margin-top:1px;"> Ingrese su contraseña una vez mas </span>',
                        equalTo: '<span style="color:#FF0000; font-size:11px; margin-left:15px;  margin-top:1px;"> Introduzca la misma contraseña que la anterior </span>',
						minlength: '<span style="color:#FF0000; font-size:11px; margin-left:15px;  margin-top:1px;"> La logitud mínima es de 6 carácteres </span>'
                    },
                },
				
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

</script>
<!--/Scripts-->

@stop