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
          <h1>Pagos<small>Estado de Cuenta</small></h1>
        </div>

        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid">
				<!-- New widget -->

				<div class="powerwidget green" id="most-form-elements" data-widget-editbutton="false">
				  <header>

				  </header>
				  <div class="inner-spacer">
						  <br>
					<span class="label label-success"><i>&nbsp;&nbsp;&nbsp;</i></span>    <strong>Al Corriente</strong> &nbsp;&nbsp;&nbsp;&nbsp;
					<span class="label label-danger"><i >&nbsp;&nbsp;&nbsp;</i></span>    <strong>Debe</strong> &nbsp;&nbsp;&nbsp;&nbsp;
					<span class="label label-info"><i >&nbsp;&nbsp;&nbsp;</i></span>       <strong>Saldo a Favor</strong><br><br>

					<div class="table-responsive">
						<table class="table table-condensed table-bordered margin-0px" style="table-layout:fixed">
						  <thead>
						  <tr>
							<th>Año</th>
							<?php $meses = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]; ?>
						    @for($i=0; $i<=11; $i++)
								@if( date("m") == $i+1)
									<th><i class="fa fa-check-square-o"></i> {{$meses[$i]}}</th>
								@else
									<th>{{$meses[$i]}}</th>
								@endif
					        @endfor


							</tr>
						  </thead>
							<tbody>

							@if($payments->count() > 0)

									@foreach($payments as $row)
												<tr>
													<td><strong class="text-info"><center>{{$row->year}}</center></strong></td>
										@for($i=0; $i<=11; $i++)

												@if($i+1 < $mes_ini)
															<td class="default">&nbsp;</td>
												@else

														@if( $i+1 <= date("m"))

																	    @if($row->$months[$i] == Null && date("m") != $i+1)
																		<td class="danger" nowrap style="font-size:95%;"> {{ "-$".number_format($cuotas[ $months[$i] ],2,'.',',') }} </td>
																		@elseif($row->$months[$i] < $cuotas[ $months[$i] ] && $row->$months[$i] > 0 && date("m") != $i+1)
																		<td class="danger" nowrap style="font-size:95%;">{{"-$".number_format($row->$months[$i],2,'.',',')}}</td>
																		@elseif($row->$months[$i] == $cuotas[ $months[$i] ] && date("m") != $i+1)
																		<td class="success" nowrap style="font-size:95%;"><center><i class="fa fa-check"></i></center></td>
																		@elseif($row->$months[$i] > $cuotas[ $months[$i] ] && date("m") != $i+1)
																		<?php $sobrante = $sobrante + $row->$months[$i] - $cuotas[ $months[$i] ] ;	?>
																		<td class="success" nowrap style="font-size:95%;"><center><i class="fa fa-check"></i></center></td>

																		@elseif( date("m") == $i+1)

																			@if($saldo == 0)

																						@if($row->$months[$i] < 0 &&  $row->$months[$i] != null )
																						<?php $deuda = -1*($row->$months[$i]);	?>
																						<td class="danger" nowrap style="font-size:95%;">{{ "-$".number_format($deuda,2,'.',',') }}</td>
																						@elseif($row->$months[$i] < $cuotas[ $months[$i] ] && $row->$months[$i] > 0 &&  $row->$months[$i] != null )
																						<td class="danger" nowrap style="font-size:95%;">{{ "-$".number_format($row->$months[$i],2,'.',',') }}</td>
																						@elseif( $row->$months[$i] == $cuotas[ $months[$i] ] )
																						<td class="success" nowrap><center><i class="fa fa-check"></i></center></td>
																						@elseif( $row->$months[$i] > $cuotas[ $months[$i] ] )
																						<?php $abono = $row->$months[$i] - $cuotas[ $months[$i] ];	?>
																						<td class="info" nowrap style="font-size:95%;">{{ "$".number_format($abono,2,'.',',') }}</td>
																						@elseif( $row->$months[$i] == null && $sobrante == 0)
																						<td class="danger" nowrap style="font-size:95%;">{{ "-$".number_format($cuotas[ $months[$i] ],2,'.',',') }}</td>
																						@elseif( $row->$months[$i] == null && $sobrante > 0)
																							<?php $mes = $sobrante - $cuotas[ $months[$i] ] ;	?>
																							@if($mes > 0 )
																								<td class="info" nowrap style="font-size:95%;">{{ "$".number_format($mes,2,'.',',') }}</td>
																							@else
																								<td class="danger" nowrap style="font-size:95%;">{{ "-$".number_format($mes,2,'.',',') }}</td>
																							@endif
																						@endif
																			@else
																					<?php $deuda = $row->$months[$i] - $saldo;	?>
																					@if($deuda < 0)
																					<?php $deuda = -1*($deuda);	?>
																					<td class="danger" nowrap style="font-size:95%;">{{ "-$".number_format($deuda,2,'.',',') }}</td>
																					@else
																					<td class="success" nowrap><center><i class="fa fa-check"></i></center></td>
																					@endif
																			@endif

																		@endif

														@else
															<td>&nbsp;</td>
														@endif

													@endif

												@endfor
												</tr>

												@endforeach
								@else
												<tr>
													<td><strong class="text-info">{{date('Y')}}</strong></td>
												@for($i=0; $i<=11; $i++)

													@if($i+1 < $mes_ini)
															<td class="default">&nbsp;</td>
													@else

															@if( $i+1 <= date("m"))

																@if(date("m") == $i+1)

																	<?php $deuda = $cuotas[ $months[$i] ] + $saldo;	?>

																	<td class="danger" nowrap style="font-size:95%;"> {{ "-$".number_format ($deuda, 2, '.' , ',' ) }} </td>

																@else

																	<td class="danger" nowrap style="font-size:95%;"> {{ "-$".number_format ($cuotas[ $months[$i] ],2, '.' , ',' ) }} </td>

																@endif
															@else

																@if(date('m') > $i)
																<td class="default">&nbsp;</td>
																@else
																<td>&nbsp;</td>
																@endif

															@endif
													@endif

												@endfor
												</tr>
								@endif

							</tbody>
						</table>
					</div>

				  </div>
				</div>
            </div>
            <!-- End Widget -->

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

<!--Calendar-->
<script type="text/javascript" src="{{asset('assets/js/vendors/fullcalendar/fullcalendar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/fullcalendar/gcal.js')}}"></script>


<!--Bootstrap-->
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--ToDo-->
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App-->
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>

<!--/Scripts-->

@stop
