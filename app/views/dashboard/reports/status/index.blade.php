
@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Reportes
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
				<li class="active">Reportes</li>
				<li class="active" style="float:right">Bienvenido {{$breadcrumbs_data}}</li>
			  </ul>
			</div>
		<!--/Breadcrumb-->

		<div class="page-header">
			 <h1>Reporte<small> Cuenta General Vecinos</small></h1>
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

					<-->
					{{ Form::open(['url' => 'dashboard/reports/generate-pdf-status', 'class' => 'form-inline']) }}
						<input type="submit" name="Generar Pdf" value="Generar PDF" id="btnPdf" class="btn btn-default">
					</form>

					<label class="select"></label>
					<br><br>

					<div class="table-responsive">
						<table class="table table-striped table-hover">

						  <thead>
							<tr>
							  	  <!--<td bgcolor="#A7F8B3" width="20%">Dirección</td>-->
								  <th >Vecino</th>
								  <th >Ene</th><th >Feb</th>
								  <th >Mar</th><th >Abr</th>
								  <th >May</th><th >Jun</th>
								  <th >Jul</th><th >Ago</th>
								  <th >Sep</th><th >Oct</th>
								  <th >Nov</th><th >Dic</th>
								  <th>saldo</th>
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
								$saldo=0;

										echo '<td><div align="left">'. ucfirst(strtolower($neighbor->Neighbors->name)).' '. ucfirst(strtolower($neighbor->Neighbors->last_name)).'</div></td>';

										for($j=0; $j<=11; $j++){

									 					if($j+1 < $mes_ini){
									 						echo '<td>&nbsp;</td>';
									 					}else{

									 							if( $j+1 <= date("m")){

									 													if($neighbor_payments->$months[$j] == Null && date("m") != $j+1){
									 														$saldo = ($saldo) + (-$cuotas[ $months[$x-1] ]);
																							echo '<td style="color:#ED3333; font-size:100% ;text-align: right;">-$'.number_format($cuotas[$months[$j]],2,".",",").' </td>';
																						}
									 														elseif($neighbor_payments->$months[$j] < $cuotas[ $months[$j] ] && $neighbor_payments->$months[$j] > 0 && date("m") != $j+1){

									 															$saldo = ($saldo) + ( $cuotas[$months[$j]] - $neighbor_payments->$months[$j] );
									 															echo '<td  style="color:#ED3333; font-size:100% ;text-align: right;">-$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';

																							}
									 														elseif($neighbor_payments->$months[$j] == $cuotas[ $months[$j] ] && date("m") != $j+1){
									 															$saldo = ($saldo) + ( $cuotas[$months[$j]] - $neighbor_payments->$months[$j] );
									 															echo '<td  style="color:green;font-size:100%;text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';

																							}elseif($neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] && date("m") != $j+1){
																								$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]);
																								echo '<td style="color:green;font-size:100%;text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																							}
																							elseif( date("m") == $j+1){

									 																	if($neighbor_payments->$months[$j] < 0 &&  $neighbor_payments->$months[$j] != null){
																											$saldo = ($saldo) + ( $cuotas[$months[$j]] - $neighbor_payments->$months[$j] );

									 																	echo '<td style="color:#ED3333; pointer; font-size:100%; text-align: right;">$-'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																										}
																										elseif( $neighbor_payments->$months[$j] == $cuotas[ $months[$j] ] ){
									 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j]  - $cuotas[$months[$j]]);
									 																	echo '<td  style="color:green; pointer; font-size:100%; text-align: right;">$'.$neighbor_payments->$months[$j].'</td>';

									 																	}elseif( $neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] ){
									 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );
																										echo '<td style="color:green;font-size:100%; text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																										}
																										elseif( $neighbor_payments->$months[$j] < $cuotas[ $months[$j] ] &&  $neighbor_payments->$months[$j] > 0 ){

									 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );

									 																	echo '<td  style="color:#ED3333;font-size:100%; text-align: right;">$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';

									 																	}
																										elseif( $neighbor_payments->$months[$j] == null){
																										$mes_anterior = $neighbor_payments->$months[$j-1] - $cuotas[ $months[$j-1] ];

																											if($mes_anterior > 0 ){
																												$mes = $mes_anterior - $cuotas[ $months[$j] ] ;

																												if($mes == 0 ){
																													$saldo = $saldo - $cuotas[$months[$j]];
																													echo '<td  >$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																												}
																												elseif($mes > 0 ){
																													$saldo = $saldo  - $cuotas[$months[$j]]  ;
																													echo '<td style="color:green; font-size:100%; text-align: right;" >$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																												}
																												elseif($mes < 0 ){
																													$mes_deuda = -1*($mes);
																													$saldo = $saldo  - $cuotas[$months[$j]]  ;
									 																				echo '<td >-$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																												}
																											}else{
																												$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );
									 																			echo '<td style="color:#ED3333;font-size:100%; text-align: right;" >-$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																											}
																										}

																							}


									 								}else{
									 									echo '<td>&nbsp;</td>';
									 							}

									 					}
									 			}
									 			if ($saldo < 0  ) {
										 				$color = 'red';
												}
												if ($saldo == 0 ) {
										 				$color = 'black';
												}
												if ($saldo > 0 ) {
										 				$color = 'blue';
												}
									 			echo "<td style=' color:{$color}; font-size:100% ;text-align: right;'>$".number_format($saldo,2,".",",")."</td>";
									 			echo "</tr>";

									 }else{
									 	$debe=0;
									 	$saldo=0;

										echo '<td ><div align="left">'.$neighbor->Neighbors->name.' '.$neighbor->Neighbors->last_name.'</div></td>';

									 	for ($x=1; $x <= 12 ; $x++) {


									 		if ( $x  <  $mes_ini) {
									 			echo '<td>&nbsp;</td>';
									 		}elseif ($x >= $mes_ini && $x <= $fin) {

												 		if( date("m") == $x){

																	$saldo = ($saldo) + (-$cuotas[ $months[$x-1] ]);

												 		echo '<td  style="color:#ED3333;  font-size:100% ;text-align: right;">-$'.number_format($cuotas[ $months[$x-1] ],2,".",",").'</td>';

														}elseif(date("m") != $x){
															$saldo = ($saldo) + (-$cuotas[ $months[$x-1] ]);
														echo '<td  style="color:#ED3333; font-size:100% ;text-align: right;">-$'.number_format($cuotas[ $months[$x-1] ],2,".",",").'</td>';


														}


											}else{
									 			echo '<td>&nbsp;</td>';
									 		}

									 	}
									 	echo "<td style='color:#ED3333; font-size:100% ;text-align: right;'>$".number_format($saldo,2,".",",")."</td>";
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



@stop
