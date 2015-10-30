<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Colonias 
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
			 <h1>Registro<small></small></h1>
			 
		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid"> 
			<!-- New widget -->
				<div class="powerwidget green" id="datatable-filter-column" data-widget-editbutton="false">
				  <header>					
				 <h2><small></small></h2>
				  </header>
				  <div class="inner-spacer">					
					<!--
						Messages  	
					-->
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
					<!--
									
					-->
					
					<br>
					<table class="display table table-striped table-hover" id="table-2">
					  
					  <thead>
						  
						<tr>	
						  <th>Colonia</th>						
						  <th>Usuario</th>
						  <th>Correo</th>
						  <th>Acción</th>
						  <th>Fecha - Hora</th>					  						 
						</tr>
					  </thead>
					  
					  <tbody>
					  	@foreach($logs as $log)
							<tr>
								<td>{{$log->Urbanism->Colony->name}}</td>
								<td>{{$log->user}}</td>							
								<td>{{$log->user_email}}</td>								
								<td>{{$log->accion}}</td>
								<td>{{strftime("%d/%b/%Y",strtotime($log->fecha)) }}  {{strftime("%l:%m %p",strtotime($log->fecha)) }}</td>														
							</tr>
						@endforeach
					  </tbody>				 
					  <tfoot>
						<tr>
						  <th><input type="text" name="filter_colonia"	placeholder="Filtrado por Colonia"	class="search_init" /></th>
						  <th><input type="text" name="filter_usu"		placeholder="Filtrado por Usuario"	class="search_init" /></th>
						  <th><input type="hidden"></th>
						  <th><input type="hidden"></th>
						  <th><input type="hidden"></th>
						  
						  						  
						</tr>
					  </tfoot>
					</table>
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
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--/Scripts-->	

@stop
