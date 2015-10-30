<?php setlocale(LC_TIME, 'es_MX.UTF-8'); ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - DASHBOARD | Reportes-Egresos
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
				<li class="active">Egresos</li>
				<li class="active" style="float:right">Bienvenido {{	$usuario	}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Listados<small>Egresos</small></h1>

		</div>
	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid">
			<!-- New widget -->
				 <div class="powerwidget green" id="datatable-filter-column" data-widget-editbutton="false">
				  <header>

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
					<br>

					<div class="table-responsive">
						<table class="display table table-striped table-hover table-condensed" id="table-2">
						  <thead>
							<tr>
							  <th>ID</th>
							  <th>Fecha - Hora</th>
							  <th>Monto</th>
							  <th>Concepto</th>
							  <th>Pagador</th>
							  <th>Archivos</th>
							  <th>Saldo</th>
							  @if( $AssigmentRole == 2)
							  <th>Opciones</th>
							  @endif
							</tr>
						  </thead>

						  <tbody>
							{{--*/ $count = 1 /*--}}
							@foreach($expenses as $row)
							<tr class="{{($count==1)? 'warning':''}}">
								<td>{{$count++}}</td>
								<td> {{strftime("%d/%b/%Y",strtotime($row->updated_at))}} {{date('h:ia', strtotime($row->updated_at))}}</td>
								<td style="text-align: right;">${{number_format($row->amount,2,'.',',')}} <?php $total = $total + $row->amount; ?></td>
								<td>{{$row->description}}</td>
								<td>{{$row->name}} {{$row->last_name}}</td>

								<td>
									@foreach($files as $file)
										@if($file->expense_id == $row->id)
										<a href="{{asset('uploads/files/expenses').'/'.$file->filename}}" target="_blank">
											<button type="button" class="btn btn-primary btn-xs">{{$file->public_filename}}</button>
										</a>
										@endif
									@endforeach
								</td>
								<td style="text-align: right;" >${{number_format($total,2,'.',',')}}</td>
								@if( $AssigmentRole == 2)
								<td>
										<center>
												<div class="control-buttons info">

													<a href="{{URL::action('ExpensesController@delete_egreso',$row->id)}}" title="Eliminar"><i class="fa fa-times-circle"></i></a>
									   			</div>
									   	</center>
							  	</td>
								@endif

							</tr>
							@endforeach
						  </tbody>
						  <tfoot>
						  	<tr>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<td>&nbsp;</td>
						  	<th style="color: #000;"  colspan="2">Egresos Acumulados</th>
						  	<th style="text-align: right; color: #000000;"><strong> - ${{number_format($total,2,'.',',')}}</strong></th>
						  	 @if( $AssigmentRole == 2)<td>&nbsp;</td>@endif
						  </tr>
							<tr>
							  <th><input type="hidden"></th>
							  <th><input type="text" name="filter_date"		placeholder="Filtrar por Fecha y Hora" 	class="search_init" /></th>
							  <th><input type="text" name="filter_amount" 	placeholder="Filtrar por Monto" 		class="search_init" /></th>
							  <th><input type="text" name="filter_concept" 	placeholder="Filtrar por Concepto" 		class="search_init" /></th>
							  <th><input type="text" name="filter_concept" 	placeholder="Filtrar por Pagador" 		class="search_init" /></th>
							  <th><input type="hidden"></th>
							  <th><input type="hidden"></th>
							   @if( $AssigmentRole == 2)<th><input type="hidden"></th>@endif
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
