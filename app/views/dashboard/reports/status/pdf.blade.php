<?php
    setlocale(LC_TIME, 'es_MX.UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Estado General</title>
    <style>

    @page {
        margin: 180px 15px;
    }

    .contenedor {
        font-size: 12px;
        font-weight: normal;
        margin: 0 auto;
        line-height: 1.4;
        padding: 0;
    }

    .cabecera {
        display: block;
        margin: auto;
        position: relative;
        text-align: center;
    }

    h2, .cabecera{
        margin-top: 10px;
        padding: 5px 5px;
        text-transform: uppercase;
    }

    .contenido {
        display: block;
        margin-top: 10px;
        margin-right: 15px;
        position: relative;
        text-align: left;
    }

    #header {
        position: fixed;
        left: 0px;
        top: -180px;
        right: 0px;
        height: 200px;
        text-align: center;
    }

    #header p.small {
        font-size: 11px;
    }

    #footer {
        position: fixed;
        left: 0px;
        bottom: -180px;
        right: 0px;
        height: 100px;
        text-align: center;

    }

    #footer .page:after {
            content: "Pág " counter(page) " de " counter(pages);

    }

    #footer .small{
        font-size: 11px;
    }

    table {
        border-spacing: 0;
        border-collapse: collapse;
        max-width: 100%;
        margin-bottom: 20px;
        text-align: left;
        width: 100%;
    }

    th {
        text-transform: uppercase;
    }

    td, th {
        padding: 0;
        text-align: left;
    }

    .valor {
        text-align: right;
    }

    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
      vertical-align: bottom;
      border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #ddd;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #f9f9f9;
    }

    .tex-right {
        display: block;
        float: right;
        margin: 20px 20px;
        text-align: right;
    }

    </style>
</head>
<body>

    <script type="text/php">

        if (isset($pdf)) {

            $font = Font_Metrics::get_font("verdana", "bold");
            $footer = $pdf->page_text( 260, 800, "Pág: {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0,0,0));
        }

    </script>

    <div id="header">
        <img src="{{asset('assets/images/pdf/header.jpg')}}" alt="" />
        <h2>Reporte de ESTADO DE CUENTA GENERAL  </h2>

    </div>

    <div id="footer" class="small" >
        <p class="small">Reporte generado: {{ strftime("%B %d, %Y, %I:%M %p")  }}</p>
    </div>

<div class="contenedor">
    <div class="contenido">
        <table class="display table table-striped table-hover" id="table-2">

					  <thead>
						<tr>

							  <th width="20%" >Vecino</th>
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
								 															echo '<td  style="color:green;text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';

																						}elseif($neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] && date("m") != $j+1){
																							$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]);
																							echo '<td style="color:green;text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																						}
																						elseif( date("m") == $j+1){

								 																	if($neighbor_payments->$months[$j] < 0 &&  $neighbor_payments->$months[$j] != null){
																										$saldo = ($saldo) + ( $cuotas[$months[$j]] - $neighbor_payments->$months[$j] );

								 																	echo '<td style="color:#ED3333; pointer;  text-align: right;">-$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																									}
																									elseif( $neighbor_payments->$months[$j] == $cuotas[ $months[$j] ] ){
								 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j]  - $cuotas[$months[$j]]);
								 																	echo '<td  style="color:green; pointer;  text-align: right;">$'.$neighbor_payments->$months[$j].'</td>';

								 																	}elseif( $neighbor_payments->$months[$j] > $cuotas[ $months[$j] ] ){
								 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );
																									echo '<td style="color:green; text-align: right;" >$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';
																									}
																									elseif( $neighbor_payments->$months[$j] < $cuotas[ $months[$j] ] &&  $neighbor_payments->$months[$j] > 0 ){

								 																	$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );

								 																	echo '<td  style="color:#ED3333; text-align: right;">$'.number_format($neighbor_payments->$months[$j],2,".",",").'</td>';

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
																												echo '<td style="color:green;  text-align: right;" >$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																											}
																											elseif($mes < 0 ){
																												$mes_deuda = -1*($mes);
																												$saldo = $saldo  - $cuotas[$months[$j]]  ;
								 																				echo '<td >-$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
																											}
																										}else{
																											$saldo = ($saldo) + ( $neighbor_payments->$months[$j] - $cuotas[$months[$j]]  );
								 																			echo '<td style="color:#ED3333; text-align: right;" >-$'.number_format($cuotas[$months[$j]],2,".",",").'</td>';
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
								 			echo "<td style=' color:{$color}; text-align: right;'>$".number_format($saldo,2,".",",")."</td>";
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

											 		echo '<td  style="color:#ED3333;  text-align: right;">-$'.number_format($cuotas[ $months[$x-1] ],2,".",",").'</td>';

													}elseif(date("m") != $x){
														$saldo = ($saldo) + (-$cuotas[ $months[$x-1] ]);
													echo '<td  style="color:#ED3333; text-align: right;">-$'.number_format($cuotas[ $months[$x-1] ],2,".",",").'</td>';


													}


										}else{
								 			echo '<td>&nbsp;</td>';
								 		}

								 	}
								 	echo "<td style='color:#ED3333; text-align: right;'>$".number_format($saldo,2,".",",")."</td>";
									echo "</tr>";

								 }
			}
							?>
					  </tbody>
					</table>
    </div>
</div>
</body>
</html>
