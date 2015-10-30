					<table class="display table table-striped table-hover" id="table-2">

					  <thead>

						<tr>

						  <th width="10">ID</th>
						  <th>Fecha</th>
						  <th>Hora</th>
						  <th>Vecino</th>
						  <th>Concepto</th>
						  <th width="20">Monto</th>
						  <th>Cobrador</th>
						  
						  <th>Comentarios</th>
						 
						</tr>
					  </thead>

					  <tbody>
					  	@if($payments->count() > 0 )
								@foreach($payments as $row)
								
										<tr>
											<td>{{$row->id}}</td>

											<td>{{strftime("%d/%b/%Y",strtotime($row->created_at))}} </td>
											<td>{{date('h:ia', strtotime($row->created_at))}}</td>
											<td>{{$row->name}} {{$row->last_name}}</td>
											<td>{{$row->description}}</td>
											<td>${{number_format($row->amount,2,'.',',')}}</td>
											<?php
												 
												 $cobrador = Collector::join('users','users.id' , '=', 'collectors.user_id')
					                             ->join('neighbors','neighbors.user_id' , '=', 'users.id')
					                             ->where('collectors.id','=',$row->collector_id)
					                             ->first();
				                            ?>
											<td>{{$cobrador->name}} {{$cobrador->last_name}}</td>
											
											<td>{{$row->coments}}</td>
											
											
										</tr>
								@endforeach
						@else
						<tr>
							<td colspan="7" >No Hay Registros.</td>
						</tr>
						@endif
					  </tbody>
					  </center>
					  
					</table>
					
						{{ Form::open(['url' => 'dashboard/reports/generate-pdf-incomes', 'class' => 'orb-form']) }}
						{{ Form::hidden('desde', $desde) }}
						{{ Form::hidden('hasta', $hasta) }}
						{{ Form::hidden('neighbor_property_id', $neighbor_property_id) }}
						@if($payments->count() > 0 )
							{{ Form::submit('Generar PDF',['class' => 'btn btn-default']) }}
						@endif
						{{ Form::close() }}
					
