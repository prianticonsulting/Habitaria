@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Promociones 
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
					 <h1>Promociones<small>Colonia @if($colony == 1) Los alpes @endif @if($colony == 2) Brisas @endif</small></h1>
					 
				 </div>
		
		
		        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <!-- New widget -->
			<div class="powerwidget green" id="form-wizard" data-widget-editbutton="false">
			
					  <header>
						<strong>Crear Código de promoción </strong>
					  </header>
			 
			 <div class="row">
			
						   <div class="col-md-6 bootstrap-grid">
								<div class="col-md-8 bootstrap-grid">			   
			
			<form action="" class="orb-form">	
			
									  <fieldset>
										<section>
									  <label class="label">Duración de la promoción</label>
									  <label class="select">
										<select onchange="duracion(this.value)">
										  <option value="0">Seleccione duración</option>
										  <option value="10">10 Días</option>
										  <option value="20">20 Días</option>
										  <option value="30">30 Días</option>
										</select>
										<i></i> </label>
									</section>
									<section>
									<button type="button" class="btn btn-default" onclick="generar_codigo()">Generar código</button>
									</section>									
									</fieldset>
								
								  </div>
						  </div>
						  
						<div class="inner-spacer">
							<div class="col-md-6">
							  <div class="coupons">
								<div class="coupons-inner">Cupón de activación de la promoción. Valido por: <span id="dias" class="text-dark-blue"></span>
								  <div class="coupons-code"><span id="codigo" class="text-green" style="font-size:12px;"></span></div>
								  <div class="one-time">Este cupón solo puede ser usando una vez</div>
								</div>
							  </div>
							</div>
						  </div>
	
		     </div>
			   	
				<div class="row">
				      <div class="col-md-12 bootstrap-grid"> 
					  <footer>

						<button type="button" class="btn btn-success pull-right">Enviar Promo</button>
					
					</footer>
<br><br><br>
					 
					 </div>
					 
				</form>

				</div>
			
	        </div>
		</div>
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

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/classie/classie.js')}}"></script>

<!--Datatables--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables-bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/dataTables.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/colvis.extras.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>


<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	
	<!-- page script -->
    <script type="text/javascript">


	function duracion(dias) 
	{ 
	document.getElementById('dias').innerHTML=dias+" días"; 

	}
	
	function generar_codigo() 
	{ 
	
		chars= "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		lon =40;
		code = "";

		for (x=0; x < lon; x++)
		{

			rand = Math.floor(Math.random()*chars.length);
			code += chars.substr(rand, 1);

		}

	document.getElementById('codigo').innerHTML=code; 

	}
	

	
    </script>
	
@stop
