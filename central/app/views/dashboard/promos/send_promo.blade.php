<div class="modal-body">             
			<center>
			<div class="inner-spacer">
				 <div class="col-md-12">
					<div class="coupons">
						<div class="coupons-inner">Cupón de activación de la promoción. Valido por: <span class="text-dark-blue">{{ $days }} DÍAS </span>
							<div class="coupons-code"><span class="text-green" style="font-size:14px;">{{ $code }}</span></div>
							<div class="one-time">Este cupón solo puede ser usando una vez</div>
						</div>
					</div>					   
				</div>
			</div>
			</center>   
 </div>
 <div class="modal-footer">
		<a href="{{URL::action('PromoController@send_cupon',$promo)}}"><button type="button" class="btn btn-success">Enviar al administrador</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </div>