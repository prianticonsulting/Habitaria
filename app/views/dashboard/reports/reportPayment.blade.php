<?php setlocale(LC_TIME, 'es_ES.UTF-8');   ?>

{{$html}}
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

												@else
												<?php $saldo = $saldo - $payment->amount; ?>

													<td>{{$payment->description}}</td>
													<td>${{number_format($payment->amount,2,'.',',')}}</td>
													<td></td>
													<td>${{number_format($saldo,2,'.',',')}}</td>
													<tr>

												<?php $saldo = $saldo + $payment->amount; ?>
															<td>{{$cont++}}</td>
															<td>{{strftime("%d/%b/%Y",strtotime($payment->created_at)) }}</td>
															<td>{{$payment->name}} {{$payment->last_name}}</td>
															<td>{{$payment->description}}</td>
															<td></td>
															<td>${{number_format($payment->amount,2,'.',',')}}</td>
															<td>${{number_format($saldo,2,'.',',')}}</td>
												   </tr>
												@endif

						</tr>
				    @endif
				@endforeach
			@endfor
	            </tbody>
	        </table>
			</div>
