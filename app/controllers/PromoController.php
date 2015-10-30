<?php

class PromoController extends BaseController {

	public function uniquePromo () {
		
		$code		= Input::get('promo');
		$colonia	= Input::get('colonia');
		
		$promo_colonia = Promo::where('colony_id','=',$colonia)->where('status','=',1)->get();
		
		$code_active = 0;
		
		foreach($promo_colonia as $promo){
			
			if($code == Crypt::decrypt($promo->code)){
				$code_active = 1;
			}
		}
		
		if ($code_active == 1) {
			
			return Response::json(array( "response" => 1 ));
			
		}else{
			
			return Response::json(array( "response" => 0));
			
		} 
		
	}

	public function promo_store(){
	
		$data=Input::all();
		
		$colonia	= Input::get('colony_id');
		$code		= Input::get('code');
		
		$promo_colonia = Promo::where('colony_id','=',$colonia)->get();
		
		$code_exist = 0;
		
		foreach($promo_colonia as $promo){
			
			if($code == Crypt::decrypt($promo->code)){
				$code_exist = 1;
				$code_id = $promo->id;
				$promo_status = $promo->status;
			}
		}
		
		if ($code_exist == 1) {				
				
				if ($promo_status == 0) {
					
						$promo = Promo::where('id','=',$code_id)->first();
				
						$promo->status = 1;
								
						if($promo->update(['id'])){
							
							$expiration = Expiration::where('colony_id','=',$colonia)->first();

							$expiration_old = date('Y-m-j', strtotime($expiration->expiration));
							
							$newExpiration = strtotime ( '+'.$promo->days.' day' , strtotime ( $expiration_old ) ) ;
							$newExpiration = date ( 'Y-m-j' , $newExpiration );

							$expiration->expiration = $newExpiration;
							$expiration->update(['id']);
							
							$datetime2 = new DateTime($expiration->expiration);
							$datetime1 = new DateTime(date('Y-m-d'));
												
							$interval = $datetime1->diff($datetime2);
							$days_expiration = $interval->format('%a');

							Session::put('days_expiration', $days_expiration);
							
							$notice_msg = 'Código de la promo activado';	
							return Redirect::route('home')->with('notice_modal', $notice_msg);		
						}
					
				}else{
					
					$error_msg = 'Este Código de la promo ya se fue utilizado';	
					return Redirect::back()->with('error_modal', $error_msg);
					
				} 
				
			
			
		}else{
			
		$error_msg = 'Código de la promo inválido';	
		return Redirect::back()->with('error_modal', $error_msg);
			
		} 
		


	}
}
