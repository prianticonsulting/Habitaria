
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
			 <h1>Estado de Cuenta General<small>Vecinos</small></h1>
		</div>

	<!-- Widget Row Start grid -->
		<div class="row" id="powerwidgets">
			<div class="col-md-12 bootstrap-grid">
			<!-- New widget -->
				<div class="powerwidget green" id="datatable-basic-init" data-widget-editbutton="false">
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

					<div class="table-responsive">
						<table width="200" border="0" cellpadding="0" cellspacing="0">
							  <tr>

								@if($selano->count() > 0)
								<td><h5>Año:</h5></td>
							    <td>
							      <select name="" id="selano">
							           @foreach($selano as $ano)
							               <option value="{{$ano['y']}}">{{$ano['y']}}</option>
							           @endforeach
							        </select>
								 </td>
								@else

								<td></td><td></td>
								@endif

							  </tr>
					</table>
						<br>
						<label class="select"></label>
						<table class="table table-striped table-hover" id="table-1" style="table-layout:fixed">

						  <thead>
							<tr>
							  	  <!--<td bgcolor="#A7F8B3" width="20%">Dirección</td>-->
								  <td bgcolor="#A7F8B3" width="15%">Vecino</td>
								  <td bgcolor="#A7F8B3">Ene</td><td bgcolor="#A7F8B3">Feb</td>
								  <td bgcolor="#A7F8B3">Mar</td><td bgcolor="#A7F8B3">Abr</td>
								  <td bgcolor="#A7F8B3">May</td><td bgcolor="#A7F8B3">Jun</td>
								  <td bgcolor="#A7F8B3">Jul</td><td bgcolor="#A7F8B3">Ago</td>
								  <td bgcolor="#A7F8B3">Sep</td><td bgcolor="#A7F8B3">Oct</td>
								  <td bgcolor="#A7F8B3">Nov</td><td bgcolor="#A7F8B3">Dic</td>
							</tr>

						  </thead>

						  <tbody>
						<?php

				foreach ($neighbors as $neighbor) {
								$neighbor_payments = PaymentStates::with('NeighborProperty')
									->where(DB::raw('year') , '=', date("Y"))
									->where('neighbor_property_id','=',$neighbor->id)
									->first();

						if ($neighbor_payments) {
								$debe=0;
									 	//if($neighbor->Urbanism->UrbanismType->id == 3)
											//echo '<td style="font-size:95%;" ><div align="left">'.strtolower ($neighbor->Building->description).' - Apto. '.$neighbor->num_house_or_apartment.'</div></td>';
										//else
										   // echo '<td style="font-size:95%;" ><div align="left">'.strtolower ($neighbor->Street->name).' - Casa '.$neighbor->num_house_or_apartment.'</div></td>';

										echo '<td><div align="left">'. ucfirst(strtolower($neighbor->Neighbors->name)).' '. ucfirst(strtolower($neighbor->Neighbors->last_name)).'</div></td>';

										for($j=0; $j<=11; $j++){

									 					if($j+1 < $mes_ini){
									 						echo '<td>&nbsp;</td>';
									 					}else{

									 							if( $j+1 <= date("m")){

									 													if($neighbor_payments->$months[$j] == Null && date("m") != $j+1){
									 														$debe = $debe + $cuotas[$months[$j]];
																							echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" style="color:#ED3333;  cursor: pointer; font-size:100% ;text-align: center;"> <div><i class="fa fa-2x fa-times" ></i></div></td>';
																						}
									 														elseif($neighbor_payments->$months[$j] < $cuotas[ $months[$j] ] && $neighbor_payments->$months[$j] > 0 && date("m") != $j+1){
									 															$debe = $debe + ( $cuotas[$months[$j]] - $neighbor_payments->$months[$j] );
									 															echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" style="color:#ED3333;  cursor: pointer; font-size:100% ;text-align: center;"> <div><i class="fa fa-2x fa-money" ></i></div></td>';

																							}
									 														elseif($neighbor_payments->$months[$j] == $cuotas[ $months[$j] ] && date("m") != $j+1)
									 															echo '<td  dir="'.$neighbor_payments->NeighborProperty->id.'" class="modalInfo" style="color:green;font-size:100%;" ><div style="color:green; cursor: pointer;" align="center"><i class="fa fa-2x fa-money" ></i></div></td>';

																							elseif($neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] && date("m") != $j+1){
																								echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'" class="modalInfo" style="color:blue;font-size:100%;" ><div style="cursor: pointer;"  align="center"><i class="fa fa-2x fa-money" ></i></div></td>';
																							}
																							elseif( date("m") == $j+1){

									 																	if($neighbor_payments->$months[$j] < 0 &&  $neighbor_payments->$months[$j] != null){
																											$deuda = -1*($neighbor_payments->$months[$j]);
																											$acumulado = $debe + $cuotas[$months[$j]];
									 																	echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'" class="modalInfo"  style="color:#ED3333; background:#F8E0E0; cursor: pointer; font-size:100%; text-align: right;">-$'.number_format($acumulado,2,".",",").'</td>';
																										}
																										elseif( $neighbor_payments->$months[$j] == $cuotas[ $months[$j] ] )
									 																	echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'" class="modalInfo" ><div style="background:#CCF8D3; cursor: pointer;" align="center"><i class="fa fa-check"></i></div></td>';

									 																	elseif( $neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] ){
									 																	$abono = $neighbor_payments->$months[$j] - $cuotas[ $months[$j] ];
																										echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo"  style="color:#2682D3; cursor: pointer; background:#C5DCFC; font-size:100%; text-align: right;" >$'.number_format($abono,2,".",",").'</td>';
																										}
																										elseif( $neighbor_payments->$months[$j] < $cuotas[ $months[$j] ] &&  $neighbor_payments->$months[$j] > 0 ){

									 																	$debe = $debe + $cuotas[$months[$j]];
									 																	$acumulado = ($debe) - ($neighbor_payments->$months[$j]) ;
									 																	echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'" class="modalInfo"  style="color:#ED3333; background:#F8E0E0; cursor: pointer; font-size:100%; text-align: right;">-$'.number_format($acumulado,2,".",",").'</td>';

									 																	}
																										elseif( $neighbor_payments->$months[$j] == null){
																										$mes_anterior = $neighbor_payments->$months[$j-1] - $cuotas[ $months[$j-1] ];

																											if($mes_anterior > 0 ){
																												$mes = $mes_anterior - $cuotas[ $months[$j] ] ;

																												if($mes == 0 )
																													echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" ><div style="background:#CCF8D3; cursor: pointer;" align="center"><i class="fa fa-check"></i></div></td>';
																												elseif($mes > 0 )
																													echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" style="color:#2682D3; cursor: pointer; background:#C5DCFC; font-size:100%; text-align: right;" >$'.number_format($mes,2,".",",").'</td>';
																												elseif($mes < 0 ){
																													$mes_deuda = -1*($mes);
																													$debe = $debe + $cuotas[$months[$j]];
									 																				echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" ><div style="background:#CCF8D3; cursor: pointer;" align="center"><i class="fa fa-check"></i></div></td>';
																												}
																											}else{
																												$acumulado = $debe + $cuotas[$months[$j]];
									 																			echo '<td dir="'.$neighbor_payments->NeighborProperty->id.'"  class="modalInfo" style="color:#ED3333; background:#F8E0E0; cursor: pointer; font-size:100%; text-align: right;" >-$'.number_format($acumulado,2,".",",").'</td>';
																											}
																										}

																							}


									 								}else{
									 									echo '<td>&nbsp;</td>';
									 							}

									 					}
									 			}

									 			echo "</tr>";

									 }else{
									 	$debe=0;
									 	//if($neighbor->Urbanism->UrbanismType->id == 3)
											//echo '<td><div align="left">'.$neighbor->Building->description.' - Apartamento '.$neighbor->num_house_or_apartment.'</div></td>';
										//else
										   // echo '<td><div align="left">'.$neighbor->Street->name.' - Casa '.$neighbor->num_house_or_apartment.'</div></td>';
										echo '<td ><div align="left">'.$neighbor->Neighbors->name.' '.$neighbor->Neighbors->last_name.'</div></td>';

									 	for ($x=1; $x <= 12 ; $x++) {


									 		if ( $x  <  $mes_ini) {
									 			echo '<td>&nbsp;</td>';
									 		}elseif ($x >= $mes_ini && $x <= $fin) {

												 		if( date("m") == $x){

																	$acumulado = $debe + $cuotas[ $months[$x-1] ];

												 		echo '<td dir="'.$neighbor->id.'"  class="modalInfo" style="color:#ED3333; background:#F8E0E0;  cursor: pointer; font-size:100% ;text-align: right;">-$'.number_format($acumulado,2,".",",").'</td>';

														}elseif(date("m") != $x){
															$debe = $debe + $cuotas[$months[$x-1]];
														echo '<td dir="'.$neighbor->id.'"  class="modalInfo" style="color:#ED3333;  cursor: pointer; font-size:100% ;text-align: center;"> <div><i class="fa fa-2x fa-times" ></i></div></td>';


														}


											}else{
									 			echo '<td>&nbsp;</td>';
									 		}

									 	}

										echo "</tr>";

									 }
				}
								?>
						  </tbody>
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
<div class="modal" id="InfoModal">
  <div class="modal-dialog modal-sm" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      		<h3>ESTADO DE CUENTA GENERAL</h3>
      </div>

      <div class="modal-body text-center">

	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

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

<script type="text/javascript">
$(document).ready(function() {

	$('#table-1').dataTable( {
			"oLanguage": {
				"sLengthMenu": "Mostrar _MENU_ Registros por p&aacute;g"
								+ '&nbsp; <span class="label label-success"><i class="">&nbsp;&nbsp;&nbsp;</i></span> <strong>Al Corriente</strong>'
								+ '&nbsp; <span class="label label-danger"><i class="">&nbsp;&nbsp;&nbsp;</i></span> <strong>Debe</strong>'
								+ '&nbsp; <span class="label label-info"><i class="">&nbsp;&nbsp;&nbsp;</i></span> <strong>Saldo a Favor</strong>',
				"sZeroRecords": "No se econtraron registros :(",
				"sInfo": "_START_ de _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 de 0 de un total de 0 registros",
				"sInfoFiltered": "(Filtado de un m&aacute;ximo de _MAX_ registros)",
				"sSearch": 'Buscar: '
			}
	} );




});

$("#table-1 .modalInfo").click(function() {


		$.post('{{ URL::route("modal.estado.cuenta") }}',{neighbor_property_id : $(this).attr('dir') },
			function(resp){
				$('#InfoModal .modal-body').html(resp);
				$('#InfoModal').modal();
			});


	});
</script>

@stop
