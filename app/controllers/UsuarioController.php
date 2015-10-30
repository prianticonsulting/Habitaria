<?php 	

class UsuarioController extends BaseController {
	
	public function com () {
		$dato = Input::all();
		$reglas = array(
			"email" => "unique:users,email" 
		);
		$mensaje = array(
			"email.unique" => "1"
		);

		$validar = Validator::make($dato,$reglas,$mensaje);
		if ($validar->passes()) {
			return Response::json(array(
				"dato" => 1
			)); 
		} else {
			return Response::json(array(
				"dato" => 2
			));
		}
	}
	
	public function uniqueEmail () {
		
		$email= Input::get('email');
		
		$buscar_email= UserNeighbors::where('email','=',$email)->first();
		
		if ($buscar_email) {
			
			return Response::json(array( "response" => 1));
			
		}else{
			
			return Response::json(array( "response" => 0));
			
		} 
		
	}
	
}

?>