@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Registro de Vecino
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
				<li class="active">Registro de nuevo vecino</li>
				<li class="active" style="float:right">Bienvenido {{	$usuario	}} </li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
          <h1>Registro<small>Vecinos</small></h1>
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
            <div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
              <header>
               &nbsp;
              </header>
              <div class="inner-spacer">
				<!--Messages-->
					@if(Session::has('msg'))
						<div class="callout callout-{{ Session::get('class') }}">
							<h4>{{ Session::get('msg')}}</h4>
						</div>
					@endif
					@foreach($errors->all() as $error)
						<div class="callout callout-danger">
							<h4>{{$error}}</h4>
						</div>
					@endforeach
				<!--/Messages-->
				{{ Form::open(['route'=>'config.colony.vecino.store','files'=>'true','class'=>'orb-form', 'id'=>'registration-neighbor']) }}
                    <fieldset>
                      <div class="row">
                        <section class="col col-6">
							
							<label class="textarea"> 
								<div class="input-group">
									<center>
					<small class="text-success">{{$urbanism}}</small>
					
					{{ Form::hidden('urbanism', $urbanism_id) }}
					{{ Form::hidden('urbanism_type', $urbanism_type) }}
					
				</center>
				
				<fieldset>
					<section>
                      <label  class="input" id="label_email"><i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email"  placeholder="Email" id="email"  data-toggle="popover" data-content="Este email ya esta registrado" onblur="emailUnique()"> 
                      </label>
                    </section>
					<section>
						<label class="input">
							{{ Form::text('firstname','',['placeholder'=>'Nombre']) }}
						</label>
					</section>
					<section>
						<label class="input">
							{{ Form::text('lastname','',['placeholder'=>'Apellido']) }}
						</label>
					</section>
                    <section>
						<label class="input"> <i class="icon-append fa fa-phone"></i>
							{{ Form::text('phone','',['placeholder'=>'Teléfono']) }}
                        </label>
                    </section>
                    <div class="row">
                    <section class="col col-7">
						<label class="select">
							{{ Form::select($select_name, ($select+ $catalog), Input::old($select_name)) }}
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
								</div><!-- /input-group -->
								
							</label>
                        </section>

                      </div>
                    </fieldset>
				  <footer>
				  <button style="float:right;" type="submit" class="btn btn-success" id="registrar">Registrar</button>
                </footer>
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

<script type="text/javascript">
 
 $(document).ready(function () {

   //Registration Form Validation
        if ($('#registration-neighbor').length) {
            $("#registration-neighbor").validate({ 
				onkeyup: false,
                // Rules for form validation
                rules: {
					email: {
                        required: true,
						email:true,
                    },
				    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
					name_floor: {
                        required: true
                    },
					name_street: {
                        required: true
                    },
                    phone: {
                        number	: true
                    },	
					num_house_or_apartment: {
                        required : true
                    },
                },

                // Messages for form validation
                messages: {
					email: {
                        required: 'Ingrese un E-mail',
						email: 'Ingrese una dirección VÁLIDA de email',
                    },
					firstname: {
                        required: 'Ingrese su nombre'
                    },
                    lastname: {
                        required: 'Ingrese su apellido'
                    },
                    phone: {
                        number	: 'Ingrese dígitos solamente.'
                    },
					name_floor: {
                        required: 'Seleccione piso donde vive.'
                    },
					name_street: {
                        required: 'Seleccione calle donde vive.'
                    },
					num_house_or_apartment: {
                        required: 'Ingrese el número de casa.'
                    },
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

 })
		
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

@stop
