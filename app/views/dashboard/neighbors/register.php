@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Registro de Vecino
@stop

{{-- Content --}}
@section ('pageContent')

<div class="colorful-page-wrapper">
	<!-- Messages-->	
		@if ( Session::get('error') )
			<div class="callout callout-danger">
				<h4>{{ Session::get('error') }}</h4>
			</div>
		@endif

		@if ( Session::has('notice') )
			<div class="callout callout-info">
				<h4>{{ Session::get('notice') }}</h4>
			</div>
		@endif
	<!-- /Messages-->
  <div class="center-block">
    <div class="login-block" >
		{{ Form::open(['action'=>'(Auth::check()) ?: URL::route('users.store')','class'=>'orb-form', 'id'=>'registration-form']) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="registerbox-neighbor">
				<center>
					<br><br><br><br><br>
					<hr>
					
					<span class="lead">Registro de nuevo vecino </span><br>
					<small class="text-success">{{$urbanism}}</small>
				</center>
				
				<fieldset>
					<section>
						<label class="input"><i class="icon-append fa fa-envelope"></i>
							{{ Form::email('email',Input::old('email',$email),['disabled', 'id'=>email]) }}}
						</label>
					</section>
					<section>
						<label class="input"><i class="icon-append fa fa-key"></i>
							{{ Form::password('password','',['placeholder'=>'Contraseña', 'id'=>'password']) }}
						</label>
					</section>
                    <section>
						<label class="input"> <i class="icon-append fa fa-key"></i>
							{{ Form::password('password_confirmation','',['placeholder'=>'Confirmar Contraseña', 'id'=>'password_confirmation']) }}
                        </label>
                    </section>
                </fieldset>
                <fieldset>
					<button type="submit" class="btn btn-success btn-sm send_forgot">Registrarme</button>
                </fieldset>
			</div>
		 {{ Form::close() }}
    </div>
</div>
<!--Scripts-->
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Fullscreen--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/fullscreen/screenfull.min.js')}}"></script>

<!--Forms--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery-steps/jquery.steps.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/classie/classie.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>


<!--ToDo--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Knob--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/knob/jquery.knob.js')}}"></script>


<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--Page Specific-->
<script type="text/javascript" src="{{asset('assets/js/script.custom.wizard.js')}}"></script>
<!--/Scripts-->	
@stop
