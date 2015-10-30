<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Logs
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
				<li class="active">Registros</li>
				<li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}} [ {{$urbanismo}} ]</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Seguridad<small>Registros</small></h1>

		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid">
			<!-- New widget -->
				<div class="powerwidget green" id="datatable-filter-column" data-widget-editbutton="false">
				  <header>


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
						  <th>Usuario</th>
						  <th>Rol</th>
						  <th>Acción</th>
						  <th>Fecha - Hora</th>


						</tr>
					  </thead>

					  <tbody>
					  	@foreach($logs as $log)
							<tr>
								<td>{{$log->user}}</td>
								<td>{{$log->rol_user}}</td>
								<td>{{$log->accion}}</td>
								<td>{{strftime("%d/%b/%Y",strtotime($log->fecha)) }}  {{strftime("%l:%m %p",strtotime($log->fecha)) }} </td>

							</tr>
						@endforeach
					  </tbody>

					  <tfoot>
						<tr>

						  <th><input type="text" name=""			placeholder="Filtrado por Usuario"				class="search_init" /></th>
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
