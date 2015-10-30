@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Registro de Vecino
@stop

{{-- Content --}}
@section ('pageContent')

<div class="colorful-page-wrapper">
	<!-- Messages-->	
		@if ( Session::has('error') )
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
		{{ Form::open(['route'=>'neighbor.store','files'=>'true','class'=>'orb-form', 'id'=>'registration-form']) }}
		<center>
			<div class="registerbox-neighbor">
				<center>
					<br><br><br><br><br><br>
					<hr>
					
					<span class="lead">Registro de nuevo vecino </span><br>
					<small class="text-success">{{$urbanism}}</small>
					
					{{ Form::hidden('urbanism', $urbanism_id) }}
					{{ Form::hidden('code', $code) }}
					{{ Form::hidden('urbanism_type', $urbanism_type) }}
					
				</center>
				
				<fieldset>
				<div class="row">
					<section class="col col-6">
						<label class="input">
							{{ Form::text('firstname','',['placeholder'=>'Nombre']) }}
						</label>
					</section>
					<section class="col col-6">
						<label class="input">
							{{ Form::text('lastname','',['placeholder'=>'Apellido']) }}
						</label>
					</section>
				</div>
                    <section > 
						<label class="input"> <i class="icon-append fa fa-phone"></i>
							{{ Form::text('phone','',['placeholder'=>'Teléfono']) }}
                        </label>
                    </section>
                    <div class="row">
                    <section class="col col-7">
						<label class="select">
							{{ Form::select($select_name, ($select+ $catalog), Input::old($select_name), ['required']) }}
							<i></i>
                        </label>
                    </section>
                    <section class="col col-5">
						<label class="input"> <i class="icon-append fa fa-slack"></i>
							{{ Form::text('num_house_or_apartment','',['placeholder'=>($urbanism_type==3)? "Apto":"Casa"]) }}
                        </label>
                    </section>
                    </div>
				<section>
                      <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
						<input type="email" name="email" placeholder="Email" value="{{ $email }}" readonly>
					 </label>
                    </section>
				  <section>
                      <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" id="password">
                       </label>
                    </section>
                    <section>
                      <label class="input"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="passwordConfirm" placeholder="Confirmar Contraseña">
					</label>
                    </section>
                </fieldset>
				
				<fieldset>
                    <button type="submit" class="btn btn-success send_forgot">Registrarse</button>
                </fieldset>

			</div>
			</center>
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
