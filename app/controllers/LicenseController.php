<?php

class LicenseController extends BaseController {


	public function license_store(){
	
		$data=Input::all();
		
		$colonia	= Input::get('colony_id');
		$code		= Input::get('code');
		
		$license_colonia = License::where('colony_id','=',$colonia)->get();
		
		$code_exist = 0;
		
		foreach($license_colonia as $lic){
			
			if($code == Crypt::decrypt($lic->code)){
				$code_exist = 1;
				$code_id = $lic->id;
				$lic_status = $lic->status;
			}
		}
		
		if ($code_exist == 1) {				
				
				if ($lic_status == 0) {
					
						$license = License::where('id','=',$code_id)->first();
				
						$license->status = 1;
								
						if($license->update(['id'])){
							
							$expiration = Expiration::where('colony_id','=',$colonia)->first();
							$expiration->status 	= 2;							
							$expiration->update(['id']);
							
							Session::put('days_expiration', 0); 
							
							$expiration_lic = LicenseExpiration::where('colony_id','=',$colonia)->first();
							
							if($expiration_lic->expiration == null){
								$expiration_old = date('Y-m-j');
							}else{
								$expiration_old = date('Y-m-j', strtotime($expiration_lic->expiration));
							}
							
							$newExpiration = strtotime ( '+'.$license->months.' month' , strtotime ( $expiration_old ) ) ;
							$newExpiration = date ( 'Y-m-j' , $newExpiration );																					
													
							$expiration_lic->expiration  = $newExpiration;
							$expiration_lic->update(['id']);;
							
							$datetime2 = new DateTime($expiration_lic->expiration);
							$datetime1 = new DateTime(date('Y-m-d'));
												
							$interval = $datetime1->diff($datetime2);
							$days_expiration = $interval->format('%a');
							
							Session::put('lic_fecha_expiration', $expiration_lic->expiration); 
							
							Session::put('lic_expiration', $days_expiration);
							
							$notice_msg = 'Código de la licencia activado';	
							return Redirect::route('home')->with('notice_modal', $notice_msg);		
						}
					
				}else{
					
					$error_msg = 'Este Código de licencia ya se fue utilizado';	
					return Redirect::back()->with('error_modal', $error_msg);
					
				} 
				
			
			
		}else{
			
		$error_msg = 'Código de la licencia inválido';	
		return Redirect::back()->with('error_modal', $error_msg);
			
		} 
		


	}
}
