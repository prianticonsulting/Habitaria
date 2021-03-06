@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Licencias
@stop

@section ('pageContent')
<!--Smooth Scroll-->
	<div class="smooth-overflow">
		@include('dashboard.layouts.navigation')
	
		<!--MainWrapper-->
		<div class="main-wrap">
	
		<!--OffCanvas Menu -->
			@include('dashboard.layouts.offcanvas_menu_admin')
			
		<!--Main Menu-->
			@include('dashboard.layouts.main_super_admin')
					
			<div class="content-wrapper"> 
				<!--Content Wrapper-->
					<!--Horisontal Dropdown-->
					@include('dashboard.layouts.horizontal_dropdown')

				<!--Breadcrumb-->
					<div class="breadcrumb clearfix">
					  <ul>
						<li><a href=""><i class="fa fa-home"></i></a></li>
						<li class="active">Inicio</li>
				<li class="active" style="float:right">Bienvenido {{ $nombre }}</li>
					  </ul>
					</div>
				 
				 <div class="page-header">
					 <h1>Licencia <small>Colonia {{$colony_name}}</small></h1>
					 
				 </div>
		
		
		        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
			<div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
			
					  <header>
						<strong>Crear Código de Licencia </strong>
					  </header>
			 
			 <div class="row">
						   <div class="col-md-5 bootstrap-grid">
								<div class="col-md-10 bootstrap-grid">			   
			
							{{ Form::open(['route'=>'license.create','files'=>'true','class'=>'orb-form', 'id'=>'lic_form']) }}
							
							{{ Form::hidden('admin_colonia',$admin_colonia) }}
							{{ Form::hidden('colony_id',$colony) }}
			
									  <fieldset>
										<section>
									  <label class="label">Duración de la licencia</label>
									  <label class="select">
										<select name="months" onchange="duracion(this.value)" required >
										  <option value="6" selected>6 meses</option>
										</select>
										<i></i> </label>
									</section>
									<section>
									<button type="button" class="btn btn-default" onclick="generar_codigo()">Generar código</button>
									<input type="hidden" name="code" id="code" required>
									</section>									
									</fieldset>
								
								  </div>
						  </div>
						  
						<div class="inner-spacer">
							<div class="col-md-6">
							  <div class="coupons">
								<div class="coupons-inner"><span style="text-transform: uppercase">Cupón de activación de licencia. Valido por: </span> <span id="meses" class="text-dark-blue" style="text-transform: uppercase">6 Meses</span>
								  <div class="coupons-code"><span id="codigo" class="text-green" style="font-size:15px;"></span></div>
								  <div class="one-time" style="text-transform: uppercase">Este cupón solo puede ser usando una vez</div>
								</div>
							  </div>						   
							</div>							
						  </div>
						  
	
		     </div>
			   	
				<div class="row">
				      <div class="col-md-12 bootstrap-grid"> 
					  <footer>

						<button type="submit" class="btn btn-success pull-right">Enviar Licencia</button>
					
					</footer>
					
					 {{ Form::close() }}
					
					<br><br><br>
					 
					 </div>					 

				</div>
			
	        </div>
		</div>
		</div>		
				
		<!--/MainWrapper--> 
	</div>
	<!--/Smooth Scroll--> 


<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Fullscreen--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/fullscreen/screenfull.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/classie/classie.js')}}"></script>

<!--Forms--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/forms/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery-steps/jquery.steps.min.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>


<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	

    <script type="text/javascript">

 
 $(document).ready(function () {

        if ($('#lic_form').length) {
            $("#lic_form").validate({ 
				ignore: '',
                rules: {
					months: {
                        required: true
                    },
					code: {
                        required: true
                    },
                },

                // Messages for form validation
                messages: {
					months: {
                        required: 'Por favor, seleccione la duración de la licencia'
                    },
					code: {
                        required: 'Por favor, genere un código para el cupón'
                    },
                },
				errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

 })

	function duracion(meses) 
	{ 
	document.getElementById('meses').innerHTML=meses+" Meses"; 

	}
	
	function generar_codigo() 
	{ 
	
		chars= "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		lon =30;
		code = "";

		for (x=0; x < lon; x++)
		{

			rand = Math.floor(Math.random()*chars.length);
			code += chars.substr(rand, 1);

		}
	
	document.getElementById('code').value=code;
	document.getElementById('codigo').innerHTML=code; 

	}
	

	
    </script>
	
@stop
