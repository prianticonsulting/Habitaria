
		 <div class="estado-cuenta table-responsive">

			 <h4 style="float: left;" > <u> {{$neighbor->Neighbors->name}} {{$neighbor->Neighbors->last_name}} </u></h4>
			 <br>

			 <table class="table table-condensed table-striped">
			 	<colgroup>
			 		<col class="col-xs-2">
					<col class="col-xs-1">
			 	</colgroup>

				<thead>
					<tr>
						<th>Info.</th>
						<th>Ene</th>
						<th>Feb</th>
						<th>Mar</th>
						<th>Abr</th>
						<th>May</th>
						<th>Jun</th>
						<th>Jul</th>
						<th>Ago</th>
						<th>Sep</th>
						<th>Oct</th>
						<th>Nov</th>
						<th>Dic</th>
					</tr>

					<tbody>
						<tr>
							<th>Saldo Anterior</th>
							@for($j=0; $j<=11; $j++)
								<?php
								$color = "";
								if ($saldoAnteriol[$j] < 0 ) {
									 $color = 'red';
								}
								if ($saldoAnteriol[$j] == 0 ) {
									 $color = 'black';
								}
								if ($saldoAnteriol[$j] > 0 ) {
									 $color = 'blue';
								}?>
								@if($j+1 == $mes_ini)
									<td style="color:black;  text-align: right;"><?php $saldoAnteriol[$j] = 0; ?>{{"$0.00"}}</td>
								@elseif($saldoAnteriol[$j]  == "")
									<td style="color:{{$color}}; text-align: right;">{{""}}</td>
								@else
									<td style="color:{{$color}}; text-align: right;">${{number_format((float)$saldoAnteriol[$j], 2, '.', ',')}}</td>
								@endif
							@endfor
						</tr>

						<tr>
							<th>Cuota del Mes</th>
							@for($j=0; $j<=11; $j++)
								@if($cuataMes[$j] == "")
									<td style="color:{{$color}}; text-align: right;">{{""}}</td>
								@else
									<?php $cuota_mes = str_replace("-", "", (string)$cuataMes[$j]); ?>
									<td style="color:red; text-align: right;">-${{number_format((float)$cuota_mes, 2, '.', ',')}}</td>
								@endif
							@endfor
						</tr>

						<tr>
							<th>Total Debe</th>
							@for($j=0; $j<=11; $j++)
								<?php
								$color = "";
								if ($totalDebe[$j] < 0 ) {
									 $color = 'red';
								}
								if ($totalDebe[$j] == 0 ) {
									 $color = 'black';
								}
								if ($totalDebe[$j] > 0 ) {
									 $color = 'blue';
								}?>

								@if($totalDebe[$j] == "")
									<td style="color:{{$color}}; text-align: right;">{{""}}</td>
								@else
									<?php $total_debe = str_replace("-", "", (string)$totalDebe[$j]); ?>
									<td style="color:{{$color}}; text-align: right;">-${{number_format((float)$total_debe, 2, '.', ',')}}</td>
								@endif
							@endfor
						</tr>

						<tr>
							<th>Pagos</th>
							@for($j=0; $j<=11; $j++)
								@if($pagos[$j] == "")
									<td style="color:{{$color}}; text-align: right;">{{""}}</td>
								@else
									<td style='color:green; text-align: right;'>${{number_format((float)$pagos[$j], 2, '.', ',')}}</td>
								@endif
							@endfor
						</tr>

						<tr>
							<th>Saldo Total</th>
							@for($j=0; $j<=11; $j++)
								<?php
								$color = "";
								if ($saldoTotal[$j] < 0  ) {
									 $color = 'red';
								}
								if ($saldoTotal[$j] == 0 ) {
									 $color = 'black';
								}
								if ($saldoTotal[$j] > 0 ) {
									 $color = 'blue';
								}?>

								@if($saldoTotal[$j] == "")
									<td style="color:{{$color}}; text-align: right;">{{""}}</td>
								@else
									<td style="color:{{$color}}; text-align: right;">${{number_format((float)$saldoTotal[$j], 2, '.', ',')}}</td>
								@endif
							@endfor
						</tr>
					</tbody>
				</thead>
			 </table>
		 </div>
