@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Selección de Colonia
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
		{{ Form::open(['route'=>'config.colony.colsel','class'=>'orb-form', 'id'=>'registration-form']) }}
			<center>
			<div class="registerbox-neighbor">
				<center>
					<br><br><br><br><br>
					<hr>
				<small class="text-success">Indíquenos en cual colonia desea ingresar</small>
				<fieldset>
				<label class="select">
					<select name="colonias" id="colonias">
					   @foreach($neighbor as $vecino)
						   <option value="{{ $vecino->Urbanism->Colony->id }}">{{$vecino->Urbanism->Colony->name }}</option>
					   @endforeach
					</select>
					<i></i>
				</label>
				</fieldset>	
				</center>
				
				<fieldset>
                    <button type="submit" class="btn btn-default send_forgot">Ingresar</button>
                </fieldset>

			</div>
			</center>
		 {{ Form::close() }}
    </div>
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