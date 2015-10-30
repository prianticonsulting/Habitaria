<div class="modal-body">             
			<center>
			<div class="inner-spacer">
				 <div class="col-md-12">
					<div class="coupons">
						<div class="coupons-inner"><span style="text-transform: uppercase">Cupón de activación de la licencia. Valido por: </span><span class="text-dark-blue" style="text-transform: uppercase">{{ $months }} MESES </span>
							<div class="coupons-code"><span class="text-green" style="font-size:15px;">{{ $code }}</span></div>
							<div class="one-time" style="text-transform: uppercase">Este cupón solo puede ser usando una vez</div>
						</div>
					</div>					   
				</div>
			</div>
			</center>   
 </div>
 <div class="modal-footer">
		<a href="{{URL::action('LicenseController@send_cupon',$license)}}"><button type="button" class="btn btn-success">Enviar al administrador</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </div>