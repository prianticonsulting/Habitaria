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
    <div class="login-block" align="Center">
		{{ Form::open(['route'=>'neighbor.store_update','files'=>'true','class'=>'orb-form', 'id'=>'registration-form']) }}
		
			<div class="registerbox-neighbor">
				<center>
					<br><br><br><br><br><br>
					<hr>
					
					<span class="lead">{{$urbanism}}</span><br>
					<small class="text-success">Verfique sus datos y establezca su contraseña</small>
					
					{{ Form::hidden('urbanism', $urbanism_id) }}
					{{ Form::hidden('code', $code) }}
					{{ Form::hidden('urbanism_type', $urbanism_type) }}
					
				</center>
				
				<fieldset>
				<div class="row">
					<section class="col col-6">
							<label class="label">Nombre</label>
						<label class="input">
							{{ Form::text('firstname',$neighbor->name,['placeholder'=>'Nombre']) }}
						</label>
					</section>
					<section class="col col-6">
						  <label class="label">Apellido</label>
						<label class="input">
							{{ Form::text('lastname',$neighbor->last_name,['placeholder'=>'Apellido']) }}
						</label>
					</section>
				</div>
                    <section > 
						<label class="input"> <i class="icon-append fa fa-phone"></i>
							{{ Form::text('phone',($neighbor->phone != NULL)? $neighbor->phone : '', ['placeholder'=>'Teléfono']) }}
                        </label>
                    </section>
                    <div class="row">
                    <section class="col col-7">
						<label class="label">Calle o Piso</label>
						<label class="select">
							{{ Form::select($select_name, ($select+ $catalog), Input::old($select_name), ['required']) }}
							<i></i>
                        </label>
                    </section>
                    <section class="col col-5">
					<label class="label">Casa</label>
						<label class="input"> <i class="icon-append fa fa-slack"></i>
							{{ Form::text('num_house_or_apartment',$property->num_house_or_apartment,['placeholder'=>($urbanism_type==3)? "Apto":"Casa"]) }}
							{{ Form::hidden('email', $email) }}
						</label>
                    </section>
                    </div>
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

<script type="text/javascript">

var email1 = $("#email1");

$(document).ready(function($){
	
	email1.blur(function () {
		if (email1.val() != "" && email1.val() != null)	{
			$.ajax({
				url: "usuario",
				type:"POST",
				data:{email:email1.val()},
				dataType: "json",
				success: comprobacionTerminada
			});
		}
	});

	
});
	
	function comprobacionTerminada (data) {
		if (data.dato == 2) {
			email1.popover("show");
			
			email1.click(function(){
				email1.popover("hide");
			});
		}
	}
	
	function comprobacionEmail () {

		if (email1.val() != "" && email1.val() != null)	{
			$.ajax({
				url: "usuario",
				type:"POST",
				data:{email:email1.val()},
				dataType: "json",
				success: comprobacionTerminada
			});
		}
		
	}
	
</script>	

@stop
