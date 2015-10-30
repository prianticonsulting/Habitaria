<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function index()
    {
	if (Auth::check()) { 
	
	$user_id= Auth::user()->id;
	
	$colonia = Session::get("colonia");
	
	//obtener el rol que desempeña en la colonia
	$rol_id = AssigmentRole::where('user_id','=',$user_id)
						->where('colony_id','=',$colonia)->pluck('role_id');
	
	Session::put("rol_usuario",$rol_id);	
	
	$permisos = array();

	$permisos = DB::table('permission_role')->where("role_id","=",$rol_id)
							  ->select("permission_role.id","permission_role.state")
							  ->orderBy("permission_role.id")
							  ->get();
							  
	Session::put("dato",$permisos);	
	
	$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
	
	$urbanismo = $urbanism->id;
	$urb_name = $urbanism->Colony->name;

	$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
	$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

	$Total = DB::table('neighbors_properties')
                     ->select(DB::raw('Count(neighbors_properties.id) as total'))
					 ->where('neighbors_properties.urbanism_id', '=', $urbanismo)
                     ->get();
	$Total=$Total[0]->total;
	
	$PorAceptar = DB::table('invited_neighbors')
                     ->select(DB::raw('count(invited_neighbors.id) as porAceptar'))
                     ->where('invited_neighbors.confirmed', '=', 0)
					 ->where('invited_neighbors.urbanism_id', '=', $urbanismo)
                     ->get();
	$PorAceptar=$PorAceptar[0]->porAceptar;
	
	$Aceptadas = DB::table('invited_neighbors')
                     ->select(DB::raw('count(invited_neighbors.id) as Aceptadas'))
                     ->where('invited_neighbors.confirmed', '=', 1)
					 ->where('invited_neighbors.urbanism_id', '=', $urbanismo)
                     ->get();
	$Aceptadas=$Aceptadas[0]->Aceptadas;
	
	$ano = date("Y");
	
	$monthly_all= MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
				  ->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
	   			  ->get();
	
	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Decem");
	
	$cuotas = array();
		
		foreach ($monthly_all as $cuota_mensual){
				
				$ini = (int) date("m",strtotime($cuota_mensual->since));
				$fin = (int) date("m",strtotime($cuota_mensual->until));
				
				if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }
				
				for($i=$ini; $i<=$fin; $i++){
					
						$cuotas[$months[$i-1]] = $cuota_mensual->amount;
				}
				
		}
	
	$j = (int) date("m");
	
	$monthly_fee = $cuotas[$months[$j-1]];
	
	$mes = date("M");
	
	$pagoMensual = PaymentStates::join('neighbors_properties', 'payment_states.neighbor_property_id', '=', 'neighbors_properties.id')
			->where($mes,'>=',$monthly_fee)
			->where('neighbors_properties.urbanism_id','=',$urbanismo)
            ->select(DB::raw('count(neighbors_properties.id) as cant'))
            ->get();
	
	if($pagoMensual)
	{$pagoMensual = $pagoMensual[0]->cant;}
	else
	{$pagoMensual = 0;}	
	
	$Egresos = Expense::join('sub_accounts', 'expenses.sub_account_id', '=', 'sub_accounts.id')
            ->where('expenses.urbanism_id','=',$urbanismo)
            ->select(DB::raw('sum(expenses.amount) as amount'),'sub_accounts.description')
			->groupBy('sub_accounts.description')
            ->get();
			
	$Ingresos = Payment::join('sub_accounts', 'payments.sub_account_id', '=', 'sub_accounts.id')
			->join('neighbors_properties', 'payments.neighbor_property_id', '=', 'neighbors_properties.id')
			->where('neighbors_properties.urbanism_id','=',$urbanismo)
            ->select(DB::raw('sum(payments.amount) as amount'),'sub_accounts.description')
			->groupBy('sub_accounts.description')
            ->get();
			
	$EgresosMensual = Expense::where('expenses.urbanism_id','=',$urbanismo)
            ->select(DB::raw('sum(expenses.amount) as amount'),DB::raw('DATE_FORMAT(expenses.created_at,\'%m\') as mes'))
			->groupBy(DB::raw('Month(expenses.created_at)'))
            ->get();
			
	$IngresosMensual = Payment::join('neighbors_properties', 'payments.neighbor_property_id', '=', 'neighbors_properties.id')
			->where('neighbors_properties.urbanism_id','=',$urbanismo)
            ->select(DB::raw('sum(payments.amount) as amount'),DB::raw('DATE_FORMAT(payments.created_at,\'%m\') as mes'))
			->groupBy(DB::raw('Month(payments.created_at)'))
            ->get();

		return View::make('dashboard.home',[
											'Total'=>$Total,
											'PorAceptar'=>$PorAceptar,
											'Aceptadas'=>$Aceptadas,
											'monthly_fee'=>$monthly_fee,
											'pagoMensual'=>$pagoMensual,
											'Egresos'=>$Egresos,
											'Ingresos'=>$Ingresos,
											'EgresosMensual'=>$EgresosMensual,
											'IngresosMensual'=>$IngresosMensual,
											'Nombre'=>$breadcrumbs_data]);
   
		
		}else{
	
		return Redirect::action('UsersController@login');

		}
	}

	public function showWelcome()
	{
		return View::make('hello');
	}
	
	public function sendMailInvitation() {

			$last_invited_add = Input::get('invited_id');
			
			$inv_admin = Input::get('admin_colonia');
			
			$admin_colonia = Neighbors::where('id','=', $inv_admin)->first();
			
			$neighbors 	= InvitedNeighbors::where('invited_id','=', $last_invited_add)->get();

			$urbanism_id = Input::get('urbanismo');

			$urbanism = Urbanism::findOrFail($urbanism_id);
				
			$code=Session::get('code');
			
			foreach($neighbors as $inv_neighbor){
				
				$email = $inv_neighbor->email;
		
				$data= array(
				'email'				=> $email,
				'link'				=> 'ConfirmationController@confirm',
				'code'				=> $inv_neighbor->confirmation_code,
				'name_inv'     		=> $admin_colonia->name,
				'lname_inv'     	=> $admin_colonia->last_name,
				'urbanism' 			=> $urbanism->name
				);
			
				Mail::send('emails.confirm_neighbors',$data, function ($message) use($email){
							$message->subject('Invitación HABITARIA');
							$message->to($email);
				});	
			}
			
			$notice_msg = "<h4>A concluido el proceso de registro</h4><p>Vecinos invitados con éxito</p>";
			
			return Redirect::action('NeighborController@admin_neighbor', array('admin_colonia' => $inv_admin,'urbanismo'=>$urbanism_id));	
	}
}
