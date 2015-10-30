<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Pagos
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
				<li class="active">Pagos</li>
				<li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Pagos<small>Historial</small></h1>

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

				<table class="table table-striped table-condensed " id="table-record">
	            <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>FECHA</th>
	                    <th nowrap>NOMBRE VECINO</th>
	                    <th>CONCEPTO</th>
	                    <th class="valor">CARGO</th>
	                    <th class="valor">ABONO</th>
	                    <th class="valor">SALDO</th>
	                    @if( $AssigmentRole == 2)
							  <th>Opciones</th>
						@endif
	                </tr>
	            </thead>

	            <tbody>

			<?php $mesActual = date("m"); $cont = 1; $saldo = -$cuotas[$mes_ini]; ?>


			@for($i=$mes_ini; $i<=$mesActual; $i++)

							<?php

							if($i <= 9)
								$mes_corriente = date('Y')."-0".$i;
							else
								$mes_corriente = date('Y')."-".$i;

							if($i != $mes_ini){
								if($saldo < 0 )
									$saldo = $saldo + $cuotas[$i];
								else
								   $saldo = $saldo - $cuotas[$i];
							}

							?>

							<tr>
												<td>{{$cont++}}</td>
												<td>01/{{$mes[$i-1]}}/{{date("Y")}}</td>
												<td nowrap>{{$payments[0]->name}} {{$payments[0]->last_name}}</td>
												<td>Cuota {{$meses[$i-1]}}</td>
												<td>${{number_format($cuotas[$i],2,'.',',')}}</td>
												<td></td>
												<td>${{number_format($saldo,2,'.',',')}}</td>
												@if( $AssigmentRole == 2)
													<td>
													</td>
												@endif
						   </tr>

				@foreach($payments as $payment)
				    @if(strftime("%Y-%m",strtotime($payment->created_at)) == $mes_corriente )
						<tr>
												<td>{{$cont++}}</td>
												<td>{{strftime("%d/%b/%Y",strtotime($payment->created_at)) }}</td>
												<td>{{$payment->name}} {{$payment->last_name}}</td>
												
												@if ($payment->description == "Pago de cuota mensual")

												<?php $saldo = $payment->amount + $saldo; ?>	

													<td>Su abono gracias</td>
													<td></td>
													<td>${{number_format($payment->amount,2,'.',',')}}</td>
													<td>${{number_format($saldo,2,'.',',')}}</td>
													
												@if( $AssigmentRole == 2)
													<td>
													</td>
												@endif
												@else
												<?php $saldo = $saldo - $payment->amount; ?>
											
													<td>{{$payment->description}}</td>
													<td>${{number_format($payment->amount,2,'.',',')}}</td>
													<td></td>
													<td>${{number_format($saldo,2,'.',',')}}</td>
													@if( $AssigmentRole == 2)
														<td>
														</td>
													@endif
													<tr>
												
												<?php $saldo = $saldo + $payment->amount; ?>
															<td>{{$cont++}}</td>
															<td>{{strftime("%d/%b/%Y",strtotime($payment->created_at)) }}</td>
															<td>{{$payment->name}} {{$payment->last_name}}</td>
															<td>{{$payment->description}}</td>
															<td></td>
															<td>${{number_format($payment->amount,2,'.',',')}}</td>
															<td>${{number_format($saldo,2,'.',',')}}</td>
															@if( $AssigmentRole == 2)
															<td>
															</td>
															@endif
												   </tr>
												@endif

						</tr>
				    @endif
				@endforeach
			@endfor
	            </tbody>
	            <tfoot>

							<tr>
							  <th><input type="hidden"></th>
							  <th><input type="text" name="filter_date"			placeholder="Filtrado por Fecha"				class="search_init" /></th>
							  <th><input type="hidden"></th>
							  <th><input type="text" name="filter_collector"	placeholder="Filtrado por Concepto"				class="search_init" /></th>
							  <th><input type="text" name="filter_concept" 		placeholder="Filtrado por Cargo"				class="search_init" /></th>
							  <th><input type="text" name="filter_coments" 		placeholder="Filtrado por Abono"			class="search_init" /></th>
							  <th><input type="text" name="filter_coments" 		placeholder="Filtrado por Saldo"			class="search_init" /></th>
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
