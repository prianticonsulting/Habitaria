@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Usuarios
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
				<li class="active">Usuarios</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->
		
		<div class="page-header">
			 <h1>Usuarios<small>Directorio</small></h1>
		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid"> 
			<!-- New widget -->
				<div class="powerwidget blue" id="datatable-filter-column" data-widget-editbutton="false">
				  <header>
					<h2>Listado<small>usuarios</small></h2>
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
						  <th width="20">ID</th>
						  <th width="300">Email</th>
						  <th>Rol</th>
						  <th>Estatus</th>
						  <th width="50">Opciones</th>
						</tr>
					  </thead>
					  
					  <tbody>
						{{--*/ $count = 1 /*--}}	
						@foreach($users as $row)
						
						<tr>
							<td>{{$count++}}</td>
							
							<td>{{$row->email}}</td>
							@foreach($row->AssigmentRole as $role)
								<td>{{$role->Role->name}}</td>
							@endforeach
							<td>
							@if ($row->status_id == 1)
								<span class="label bg-green-alt">
							@elseif ($row->status_id == 2)	
								<span class="label bg-dark-cold-grey">
							@else
								<span class="label bg-dark-red">
							@endif
								{{$row->Status->type}}</span>
							</td>
							<td>
							<center>
							<div class="control-buttons info">
								<a href="{{URL::action('UsersController@edit',$row->id)}}"   title="Editar"><i class="fa fa-cog"></i></a>
								<a href="{{URL::action('UsersController@delete',$row->id)}}" title="Eliminar"><i class="fa fa-times-circle"></i></a> 
						   </div>
						   </center>
						  </td>
						</tr>
						@endforeach
					  </tbody>
					  </center>
					  <tfoot>
						<tr>
						  <th><input type="hidden"></th>
						  <th><input type="text" name="filter_name"		placeholder="Filtrado por Nombre"				class="search_init" /></th>
						  <th><input type="text" name="filter_email"	placeholder="Filtrado por Email"				class="search_init" /></th>
						  <th><input type="text" name="filter_role" 	placeholder="Filtrado por Rol"					class="search_init" /></th>
						  <th><input type="text" name="filter_status" 	placeholder="Filtrado por Estatus"				class="search_init" /></th>
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
