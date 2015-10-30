@extends ('dashboard.layouts.users')

@section ('titlePage')
	HABITARIA | Registro de residencia
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
		{{ Form::open(['route'=>'neighbor.store.admin','files'=>'true','class'=>'orb-form', 'id'=>'registration-form']) }}
			<center>
			<div class="registerbox-neighbor">
				<center>
					<br><br><br><br><br>
					<hr>
					
					<span class="lead">{{$urbanism->name}}</span><br>
					<small class="text-success">Indíquenos en que calle y número de Casa es su domicilio</small>
					
					{{ Form::hidden('neighbor', $admin_neighbor->id) }}
					{{ Form::hidden('urbanism', $urbanism->id) }}
					{{ Form::hidden('urbanism_type', $urbanism_type) }}
					
				</center>
				
				<center>
				<br>
				<p class="text-center"> <strong>{{ $admin_neighbor->name }} {{ $admin_neighbor->last_name }} </strong>  </p>
				<br>
				</center>
				
				<fieldset>
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
                </fieldset>
				
				<fieldset>
                    <button type="submit" class="btn btn-default send_forgot">Guardar</button>
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


<!--/Scripts-->		

@stop
