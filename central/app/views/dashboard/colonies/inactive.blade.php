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
					 <h1>Colonias<small>Versión de prueba</small></h1>
					 
				 </div>
				
				
		<!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            <!-- New widget -->

            <div class="powerwidget cold-grey" id="table1" data-widget-editbutton="false">
              <header>
                <h2>Colonias en versión de prueba</h2>
              </header>
              <div class="inner-spacer">
                <table class="display table table-striped table-hover" id="table-2">
                  <thead>
                    <tr>
                      <th>Nombre de la Colonia</th>
                      <th>Nombre del Administrador</th>
                      <th>Teléfono del Administrador</th>
					  <th>Creación de la colonia</th>
					  <th>Versión de prueba hasta</th>
                      <th>Generar</th>
                    </tr>
                  </thead>
                  <tbody>
				  @foreach($colonies as $row)
                    <tr>
                      <td>{{$row->Colony->name}}</td>
                      
					  @foreach($admin as $row_admin)
					  
						@if($row_admin->colony_id == $row->Colony->id)
							<td>
							{{Neighbors::where('user_id','=',$row_admin->user_id)->pluck('name')}} {{Neighbors::where('user_id','=',$row_admin->user_id)->pluck('last_name')}}
							</td>
							<td>
							{{Neighbors::where('user_id','=',$row_admin->user_id)->pluck('phone')}}
							</td>
						@endif
						
					  @endforeach
					  
                      <td>{{strftime("%d/%b/%Y",strtotime($row->Colony->created_at)) }}</td>
					  <td>{{date('d-M-Y', strtotime( $row->expiration ))}}</td>
                      <td>
					  <a href="{{URL::action('LicenseController@index',$row->colony_id)}}"><button type="button" class="btn btn-success btn-xs">Licencia</button></a>
					  <a href="{{URL::action('PromoController@index',$row->colony_id)}}"><button type="button" class="btn btn-default btn-xs">Promoción</button></a>
					  </td>
                    </tr>
					@endforeach					
                  </tbody>
				  <tfoot>
						<tr>
						  <th><input type="text" name="filter_name"			placeholder="Filtrar por Nombre" 			class="search_init" /></th>
						  <th><input type="text" name="filter_admin" 		placeholder="Filtrar por Administrador" 	class="search_init" /></th>
						  <th><input type="text" name="filter_tlf" 			placeholder="Filtrar por Télefono" 			class="search_init" /></th>	 
						 <th><input type="text" name="filter_created" 		placeholder="Filtrar por Creación" 			class="search_init" /></th>
						  <th><input type="text" name="filter_expiration" 	placeholder="Filtrar por expiración" 		class="search_init" /></th>
						  <th><input type="hidden"></th>
						</tr>
					  </tfoot>
                </table>
              </div>
            </div>
            <!-- End .powerwidget --> 
	
				
			</div>
			<!--/Content--> 	  
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

@stop
