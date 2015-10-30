<?php

class ConfirmationController extends BaseController
{

	
	 public function confirm($code)
    {
	
        $confirm = InvitedNeighbors::where('Confirmation_code','=',$code)->first();

		if(! $confirm->confirmed)
		{
				//$confirm->confirmed = true;
				//$confirm->update(['id']);
				
				$email = $confirm->email;
				$urbanism_id = $confirm->urbanism_id;
				$colony = Urbanism::where('id','=',$urbanism_id)->pluck('colony_id');
				
				$expiration = Expiration::where('colony_id','=',$colony)->first();
				$datetime2 = new DateTime($expiration->expiration);
				$datetime1 = new DateTime(date('Y-m-d'));
								
				$interval = $datetime1->diff($datetime2);
				$days_expiration = $interval->format('%a');

				Session::put('days_expiration', $days_expiration);
				
				$usuario = UserNeighbors::where('email','=',$email)->first();
				
				if($usuario){
					
					$rol_vecino = AssigmentRole::where('colony_id', '=', $colony)
										->where('user_id','=',$usuario->id)
										->where('role_id','=',6)
										->first();
					
					if($rol_vecino){
						    
							$notice_msg = 'Ya se encuentra como vecino en la Colonia, acceda ahora a Habitaria';
							return Redirect::action('UsersController@login')->with('notice', $notice_msg);
					
					}else{
					
						$neighbor = Neighbors::where('user_id','=', $usuario->id)->first();
						
						if($neighbor){
							
								$neighborP= NeighborProperty::where('neighbors_id','=',$neighbor->id)
															->where('urbanism_id','=',$urbanism_id)
															->first();
								
								if(!$neighborP)
								{									
									return Redirect::action('NeighborController@register_properties', array('neighbor' => $neighbor->id, 'urbanism_id' =>$urbanism_id ));
								}
								
						}else{
									return Redirect::action('NeighborController@register_neighbors', array('user' => $usuario->id, 'urbanism_id' =>$urbanism_id ));
						}
					
					}
				}
				else
				{
					
						$urbanism	 	= Urbanism::findOrFail($urbanism_id);
						$urbanism_name	= $urbanism->name;
						$urbanism_type	= $urbanism->urbanism_type_id;
						
						if($urbanism_type == 3){
							$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanism_id)->orderBy('id', 'ASC')->lists('description', 'id');
							$select		= '¿Piso donde vive?';
							$select_name= 'name_floor';
						}else{
							$catalog	= StreetCatalog::where('urbanism_id','=',$urbanism_id)->orderBy('id', 'ASC')->lists('name', 'id');
							$select		= '¿Calle donde vive?';
							$select_name= 'name_street';
						}
					   
						$notice_msg = Lang::get('confide::confide.alerts.confirmation_invitation');
						
						return View::make('dashboard.neighbors.create',['email'=>$email, 
																		'urbanism'=>$urbanism_name,
																		'urbanism_id'=>$urbanism_id,
																		'urbanism_type'=>$urbanism_type,
																		'catalog'=>$catalog,
																		'code'=>$code,
																		'select_name'=>$select_name,
																		'select' => ['' => $select],
																		'notice' => $notice_msg,
																		]);
				
				}														
		
		}else{
		
           $notice_msg = 'Acceda a Habitaria con su usuario creado';
           return Redirect::action('UsersController@login')->with('notice', $notice_msg);
            
        }
	
	}
  
	 public function confirm_data($code)
    {
		
		if( ! $code)
        {
			$error_msg = new InvalidConfirmationCodeException;
            return Redirect::action('UsersController@login')->with('error', $error_msg);
            
        }

        $confirm = InvitedNeighbors::where('Confirmation_code','=',$code)->first();
	

        if ( ! $confirm)
        {
			$error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')->with('error', $error_msg);
            
        }
	
		if(! $confirm->confirmed)
		{
			
		$email = $confirm->email;
		
		$reg_user 		= User::where('email','=',$email)->first();
		
		if($reg_user)
		{
				
				$reg_neighbor   = Neighbors::where('user_id','=',$reg_user->id)->first();				
				
				$property=  NeighborProperty::where('neighbors_id','=',$reg_neighbor->id)->first();

				$urbanism_id 	= $confirm->urbanism_id;
				$urbanism	 	= Urbanism::findOrFail($urbanism_id);
				$urbanism_name	= $urbanism->name;
				$urbanism_type	= $urbanism->urbanism_type_id;
				
				if($urbanism_type == 3){
					$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanism_id)->orderBy('id', 'ASC')->lists('description', 'id');
					$select		= ['' => '¿Piso donde vive?'];
					if($property->num_floor_id){
					$select		= BuildingCatalog::where('id','=',$property->num_floor_id)->orderBy('id', 'ASC')->lists('name', 'id');
					}
					$select_name= 'name_floor';
				}else{
					$catalog	= StreetCatalog::where('urbanism_id','=',$urbanism_id)->orderBy('id', 'ASC')->lists('name', 'id');
					$select		= ['' => '¿Calle donde vive?'];
					if($property->num_street_id){
					$select		= StreetCatalog::where('id','=',$property->num_street_id)->orderBy('id', 'ASC')->lists('name', 'id');
					}
					$select_name= 'name_street';
				}
			   
				$notice_msg = Lang::get('confide::confide.alerts.confirmation_invitation');
				
				return View::make('dashboard.neighbors.edit',['email'=>$email, 
																'urbanism'=>$urbanism_name,
																'urbanism_id'=>$urbanism_id,
																'code'=>$code,
																'urbanism_type'=>$urbanism_type,
																'catalog'=>$catalog,
																'neighbor'=>$reg_neighbor,
																'property'=>$property,
																'select_name'=>$select_name,
																'select' => $select,
																'notice' => $notice_msg,
																]);
		
		}else{
				
			return Redirect::action('ConfirmationController@confirm',$code);
			
			}
			
		}else{
		
           $notice_msg = 'Acceda a Habitaria con su usuario creado';
           return Redirect::action('UsersController@login')->with('notice', $notice_msg);
            
        }
		
	}  
	
	
	public function confirm_data_fam($code)
    {
		
		if( ! $code)
        {
			$error_msg = new InvalidConfirmationCodeException;
            return Redirect::action('UsersController@login')->with('error', $error_msg);
            
        }

        $confirm = InvitedNeighbors::where('Confirmation_code','=',$code)->first();
	

        if ( ! $confirm)
        {
			$error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')->with('error', $error_msg);
            
        }
	
		if(! $confirm->confirmed)
		{
			
		$email = $confirm->email;
		
		$reg_user 		= User::where('email','=',$email)->first();
		
		if($reg_user)
		{
				
				$reg_neighbor   = Neighbors::where('user_id','=',$reg_user->id)->first();				
				
				$property=  NeighborProperty::where('neighbors_id','=',$reg_neighbor->id)->first();

				$urbanism_id 	= $confirm->urbanism_id;
				$urbanism	 	= Urbanism::findOrFail($urbanism_id);
				$urbanism_name	= $urbanism->name;
				$urbanism_type	= $urbanism->urbanism_type_id;
				
				if($urbanism_type == 3){
					$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanism_id)->first();
				}else{
					$catalog	= StreetCatalog::where('urbanism_id','=',$urbanism_id)->first();
				}
			   
				$notice_msg = Lang::get('confide::confide.alerts.confirmation_invitation');
				
				return View::make('dashboard.neighbors.edit_fam',['email'=>$email, 
																'urbanism'=>$urbanism_name,
																'urbanism_id'=>$urbanism_id,
																'code'=>$code,
																'urbanism_type'=>$urbanism_type,
																'catalog'=>$catalog,
																'neighbor'=>$reg_neighbor,
																'property'=>$property,
																'notice' => $notice_msg,
																]);
		
		}else{
				
			return Redirect::action('ConfirmationController@confirm',$code);
			
			}
			
		}else{
		
           $notice_msg = 'Acceda a Habitaria con su usuario creado';
           return Redirect::action('UsersController@login')->with('notice', $notice_msg);
            
        }
		
	}
}


