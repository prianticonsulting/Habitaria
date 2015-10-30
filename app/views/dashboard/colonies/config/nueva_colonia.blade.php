@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Configuración de Colonia
@stop
@section ('cssPage')
	{{ HTML::style('assets/css/styles.css'); }}
@stop

@section ('pageContent')
<!--Smooth Scroll-->
	<div class="smooth-overflow">
		@include('dashboard.layouts.navigation')
	
	<!--MainWrapper-->
		<div class="main-wrap"> 
		<!--OffCanvas Menu -->
			@include('dashboard.layouts.offcanvas_menu')
		<!--Main Menu-->
			@include('dashboard.layouts.main_menu')
			
			<div class="content-wrapper">
			<!--Content Wrapper-->
			<!--Horisontal Dropdown-->
			@include('dashboard.layouts.horizontal_dropdown')
			
		<!--Breadcrumb-->
			<div class="breadcrumb clearfix">
			  <ul>
				<li><a href="{{URL::route('home')}}"><i class="fa fa-home"></i></a></li>
				<li class="active">Registro de Nueva Colonia</li>
				<li class="active" style="float:right">Bienvenido {{$user}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Nueva<small>Colonia</small></h1>
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
              <header></header>
              <div class="inner-spacer">
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
				{{ Form::open(['action'=>['ColonyController@config_store', $code],'files'=>'true','class'=>'orb-form', 'id'=>'steps-wizard']) }}
                  
				<div id="wizard">			    
					
                    <h1>Paso 1 <br> Info</h1>
                    <fieldset class="step-1">
					<div class="row">
						<section class="col col-9">
						<header>Información del administrador de la colonia</header><br>
                        </section>
					  </div>				  
					  <div class="row">
						<section class="col col-3">
							<label class="input"> 
								{{ Form::text('admin_name',$user_admin->name,['placeholder'=>'Nombre','class'=>'form-control', 'disabled'=>'true']) }}
							</label>
                        </section>
                        <section class="col col-3">
							<label class="input">							 
								{{ Form::text('admin_lname',$user_admin->last_name,['placeholder'=>'Apellido','class'=>'form-control', 'disabled'=>'true']) }}
							</label>
						</section>
                        <section class="col col-3">
							<label class="input">
								{{ Form::text('admin_phone',$user_admin->phone,['placeholder'=>'Teléfono', 'class'=>'form-control', 'disabled'=>'true']) }}
							</label>
						</section>               
					  </div>                    									
					 <br>
					  <div class="row">
						<section class="col col-9">
						<header>Información general de la colonia</header><br>
                        </section>
                      </div>
					  	<div class="row">	
                        <section class="col col-3">
							<label class="input"> 
								<div class="input-group">
									<span class="input-group-addon"><i class="entypo-home"></i></span>
									{{ Form::text('colony_name','',['placeholder'=>'Nombre de la Colonia','class'=>'form-control']) }}
								</div><!-- /input-group -->
							</label>
                        </section> 
						<section class="col col-3">
							<label class="input">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-empire"></i></span>
									{{ Form::text('urbanism_name','',['placeholder'=>'Nombre del desarrollo','class'=>'form-control']) }}
								</div>
							</label>
						</section> 						
						<section class="col col-3">
							<label class="select">
								{{ Form::select('urbanism_type', ($select+ $urbanism_types), Input::old('urbanism_type')) }}
								<i></i>
							</label>
						</section>
						</div>
                      <br>
					  <div class="row">
                        <section class="col col-3">
							<label class="select">							 
								{{ Form::select('country', ($select_1+ $countries), $selected_country ) }}
								<i></i>
							</label>
						</section>
                        <section class="col col-3">
							<label class="select">
								{{ Form::select('state', ($select_2 + $states), Input::old('state'),array('id' => 'state', 'onchange'  => 'getCities(this.value)')) }}
								<i></i>
							</label>
						</section>               
                        <section class="col col-3">
							<label class="select">
								{{ Form::select('city', ($select_3), Input::old('city'),['id' => 'city']) }}
								<i></i>
							</label>
						</section>  
					  </div>
			
                    </fieldset>
					
                    <h1>Paso 2 <br> Ubicación</h1>
                    <fieldset class="step-2">
						<div class="row">
						<section class="col col-6">
							<header>Agregar Calles o Pisos de la colonia</header><br>
							
							<label class="input"> 
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-map-marker"></i></span>
									{{ Form::text('location','',['placeholder'=>'Ubicación', 'id'=>'street_field','class'=>'form-control']) }}
									<span class="input-group-btn">
										<button class="btn btn-success" type="button" onClick="addStreet()">Agregar</button>
									</span>
								</div><!-- /input-group -->
							</label>
							<label>
                            <input type="checkbox" name="location2" id="location2"  style="width: 2px; height: 2px;" required>
                            <i></i>
							</label>
                        </section>

						<!-- /Street Section --> 
						<section class="col col-6">						
							<div class="powerwidget" id="table2" data-widget-editbutton="false">
							  <div class="inner-spacer" id="street_table2">
								<table class="table table-condensed table-bordered margin-0px">
								  <thead>
									<tr>
									  <th>Calles agregadas a la Colonia</th>
									</tr>
								  </thead>
								  <tbody id="streets">
								  </tbody>
								</table>
							  </div>
							</div>
							<!-- /Street Section --> 
                        </section>  
						
                      </div>
	
                    </fieldset>
					
                    <h1>Paso 3 <br> Cuota</h1>
                    <fieldset class="step-3">
					 
                        <section class="col col-6">
							<header>Definir cuota mensual de pago de la colonia</header><br>
                          <label class="input"> 
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-money"></i></span>
									{{ Form::text('monthly_fee','',['placeholder'=>'Ingrese Monto','class'=>'form-control']) }}
									<span class="input-group-addon">0.00</span>
								</div><!-- /input-group -->
                          </label>
                        </section>
						
                    </fieldset>
					
                    <h1>Paso 4 <br> Invitar Vecinos</h1>
                    <fieldset>
                      <div class="row">
                        <section class="col col-6">
							<header>Enviar invitaciones a los vecinos</header><br>
							<label class="textarea"> 
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<!--{{ Form::textarea('email','',['placeholder'=>'Ingrese E-mails de vecinos', 'id'=>'email_field','class'=>'form-control', 'size'=>'5x5']) }}-->
									{{ Form::textarea('correo','',['placeholder'=>'Ingrese E-mails de vecinos', 'id'=>'email_field','class'=>'form-control', 'size'=>'5x5']) }}
									<b class="tooltip tooltip-top-left">Ingrese máximo 10 correos electrónicos separados por un (1) renglon</b>
									<span class="input-group-addon">
										<button class="btn btn-success" type="button" onClick="addMail()" id="add_mail">Agregar</button>
									</span>
								</div><!-- /input-group -->
								<div class="note" id="email_invalidos" style="color:#F78181"></div>
								<input type="checkbox" name="email" id="email2"  style="width: 2px; height: 2px;">
							</label>
							
                        </section>
                        <section class="col col-6">
							<div id="mail_area"></div>
                        </section>
                      </div>
                    </fieldset>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
            <!-- End .powerwidget --> 
            
          </div>
          <!-- /Inner Row Col-md-12 --> 
        </div>
        <!-- /Widgets Row End Grid--> 
      </div>
      <!-- / Content Wrapper --> 
    </div>
    <!--/MainWrapper--> 
  </div>
<!--/Smooth Scroll--> 


<!-- scroll top -->
<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->


<!--Scripts-->
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

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


<!--X-Editable--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/demo.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/demo-mock.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/address.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/jquery.mockjax.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/select2-bootstrap.css')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/typeahead.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/x-editable/typeaheadjs.js')}}"></script>


<!--ToDo--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Knob--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/knob/jquery.knob.js')}}"></script>


<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--Page Specific-->
<script type="text/javascript" src="{{asset('assets/js/script.custom.wizard.js')}}"></script>

<!--Select dependientes country-states-cities -->
<script type="text/javascript">
    $('form').bind('submit', function() {
        $(this).find(':input').removeAttr('disabled');
    });			
			
			
function getCities(state){
		
		$.get("{{ url('listCities')}}",
			{ state: state },
			function(data) {
				$('#city').empty();
				$('#city').append($('<option></option>').text('Seleccione Ciudad').val('')); 
				$.each(data, function(i) {
					$('#city').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				});
			}, "json");
			
}	

</script>

<!--/Scripts-->	

@stop
