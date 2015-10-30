<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Ingresos
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
				<li class="active">Ingresos</li>
				<li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Ingresos<small>Historial</small></h1>

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
					<div class="table-responsive">
						<table class="display table table-striped table-hover" id="table-2">

						  <thead>

							<tr>

							  <th width="10">ID</th>
							  <th>Fecha - Hora</th>
							  <th width="20">Monto</th>
							  <th>Pagador</th>
							  <th>Concepto</th>
							  <th>Comentarios</th>
							  <th>Saldo</th>
							 @if( $AssigmentRole == 2)
							  <th>Opciones</th>
							  @endif
							</tr>
						  </thead>

						  <tbody>
							@foreach($incomes as $row)

							<tr>
								<td>{{$row->id}}</td>
								<td>{{strftime("%d/%b/%Y",strtotime($row->created_at)) }} {{date('h:ia', strtotime($row->created_at))}}</td>
								<td style="text-align: right;">${{number_format($row->amount,2,'.',',')}} <?php $total = $total + $row->amount; ?></td>
								<td>{{$row->name}} {{$row->last_name}}</td>
								<td>{{$row->description}}</td>
								<td>{{$row->coments}}</td>
								<td style="text-align: right;">${{number_format($total,2,'.',',')}}</td>
								@if( $AssigmentRole == 2)
								<td>
								        <center>
											 <div class="control-buttons info">
													<a href="{{URL::action('IncomesController@delete',$row->id)}}" title="Eliminar"><i class="fa fa-times-circle"></i></a>
							  				 </div>
							   			</center>
							  	</td>
							  	@endif
							</tr>
							@endforeach
						  </tbody>
						  </center>
						  <tfoot>

						  <tr>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<th style="color: #000;"  colspan="2">Ingresos Acumulados</th>
						  	<th style="color: #000000; text-align: right;"><strong style=" text-align: right;">${{number_format($total,2,'.',',')}}</strong></th>
						  	 @if( $AssigmentRole == 2)<td>&nbsp;</td>@endif
						  </tr>
							<tr>
							  <th><input type="hidden"></th>
							  <th><input type="text" name="filter_date"			placeholder="Filtrado por Fecha"				class="search_init" /></th>
							  <th><input type="text" name="filter_amount"		placeholder="Filtrado por Monto"				class="search_init" /></th>
							  <th><input type="text" name="filter_collector"	placeholder="Filtrado por Cobrador"				class="search_init" /></th>
							  <th><input type="text" name="filter_concept" 		placeholder="Filtrado por Concepto"				class="search_init" /></th>
							  <th><input type="text" name="filter_coments" 		placeholder="Filtrado por Comentario"			class="search_init" /></th>
							  <th><input type="hidden"></th>
							  @if( $AssigmentRole == 2)
							  <th><input type="hidden"></th>
							  @endif
							</tr>
						  </tfoot>
						</table>
					</div>

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
