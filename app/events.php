<?php
 
    Event::listen('illuminate.controller',function() {
    	
    	$accion='';
    	switch (Request::path()) {

    		case 'dashboard/rol/create':
    			$accion = "Visito la opcion Roles";
    			break;
    		case 'dashboard/home' :
    			$accion = "Visito el inicio";
    			break;
    		case 'dashboard/user/logs' :
    			$accion = "Visito los Logs de Usuarios";
    			break;
    		case 'dashboard/account-states' :
    			$accion = "Visito Mi Estado de Cuenta";
    			break;
    		case 'dashboard/payments/record' :
    			$accion = "Visito Mi Historial";
    			break;
    		case 'dashboard/payments/neighbors' :
    			$accion = "Visito Mis Vecinos";
    			break;
    		case 'dashboard/incomes/charge' :
    			$accion = "Visito Ingresos Cobrar";
    			break;
    		case 'dashboard/incomes/record' :
    			$accion = "Visito Ingresos Historial";
    			break;
    		case 'dashboard/incomes/charge/balances' :
    			$accion = "Visito Ingresos Saldos";
    			break;
    		case 'dashboard/expenses' :
    			$accion = "Visito Egresos Registrar Gasto";
    			break;

    			



   		}
   		
   		if ($accion != '' and Auth::check()) {
			
      $colonia 	= Session::get("colonia");		
			$urbanism	= Urbanism::where('colony_id','=',$colonia)->first();
   		
      	Logs::create([
   						'user'        => Auth::user()->Neighbors->name.' '.Auth::user()->Neighbors->last_name,
   						'rol_user'    => Role::find(Auth::user()->AssigmentRole[0]->role_id)->name,
   						'urbanism_id' => $urbanism->id,
						  'user_email'  => Auth::user()->email,
   						'accion'      => $accion,
   						'fecha'       => (new DateTime)->format('d-m-Y H:i:s')
   			]);
   		}
    	    	
   		
   		return false;
    });

   
    Event::fire('illuminate.controller');
   
   	Event::listen('logs',function($accion)
	   {
	   	$colonia 	= Session::get("colonia");		
		$urbanism	= Urbanism::where('colony_id','=',$colonia)->first();
	   	Logs::create([
	   						'user'        => Auth::user()->Neighbors->name.' '.Auth::user()->Neighbors->last_name,
	   						'rol_user'    => Role::find(Auth::user()->AssigmentRole[0]->role_id)->name,
	   						'urbanism_id' => $urbanism->id,
							'user_email'  => Auth::user()->email,
	   						'accion'      => $accion,
	   						'fecha'       => (new DateTime)->format('d-m-Y H:i:s')
	   			]);


	   });

