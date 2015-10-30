  <br><br>
 <span class="label label-success"><i>&nbsp;&nbsp;&nbsp;</i></span>    <strong>Al Corriente</strong> &nbsp;&nbsp;&nbsp;&nbsp;
 <span class="label label-danger"><i>&nbsp;&nbsp;&nbsp;</i></span>    <strong>Debe</strong> &nbsp;&nbsp;&nbsp;&nbsp;
 <span class="label label-info"><i>&nbsp;&nbsp;&nbsp;</i></span>       <strong>Saldo a Favor</strong><br><br> 

 <table class="table table-condensed table-bordered margin-0px" style="table-layout:fixed">
					  <thead>
						<tr>
						  <th>A&ntilde;o</th>
						  <th>Ene</th><th>Feb</th><th>Mar</th><th>Abr</th><th>May</th><th>Jun</th>
						  <th>Jul</th><th>Ago</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dic</th>
						</tr>
					  </thead>
						<tbody>
			@if($payments->count() > 0)
											@foreach($payments as $row)
											<tr>
												<td><strong class="text-info">{{$row->year}}</strong></td>
						
												@for($i=0; $i<=11; $i++)
													@if($i+1 < $mes_ini)
														<td class="default">&nbsp;</td>
													@else
													
															@if( $i+1 <= date("m"))
																
																@if($row->$months[$i] == Null  && date("m") != $i+1)
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
																
																<td class="danger" nowrap style="font-size:95%;"> {{ "- $".number_format ($cuotas[ $months[$i] ],2, '.' , ',' ) }} </td>
																
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
                    