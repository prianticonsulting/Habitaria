<?php

class ColonyController extends BaseController
{
	   
    public function wizard($code)
    { 	
		
		if (Confide::confirm($code)) {
		
		$user= User::where('confirmation_code','=',$code)->pluck('email');
		
		$user_auth= User::where('confirmation_code','=',$code)->first();
		
		Auth::login($user_auth);
		
		if (Auth::check()) { 		
		
			$urbanism_types= UrbanismType::orderBy('id', 'ASC')->lists('type', 'id');
        
			$countries	= Country::orderBy('id', 'ASC')->lists('name', 'id');
		
			$states	= State::orderBy('id', 'ASC')->lists('name', 'id');
			
			$country_default= 'México';
			
			$selected_country = Country::where('name', '=', $country_default)->first();
			
			return View::make('dashboard.colonies.config.initial_config',['urbanism_types'=>$urbanism_types,
															 'user'=>$user,
															 'countries'=>$countries,
															 'states'=>$states,
															 'code'=>$code,
															 'selected_country'=>[$selected_country->id],
															 'select' 	=> ['' => 'Seleccione tipo de desarrollo'],
															 'select_1' => ['' => 'Seleccione País'],
															 'select_2' => ['' => 'Seleccione Estado'],
															 'select_3' => ['' => 'Seleccione Ciudad']
															 ]); 
		}
		 
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }


	}
	
	public function select_colonia()
	{	
		$user_id= Auth::user()->id;
		
		$neighbor_id = Neighbors::where('user_id','=', $user_id)->pluck('id');
		
		$neighbor 	= NeighborProperty::with('Urbanism.Colony')->where('neighbors_id','=',$neighbor_id)->get();

		return View::make('dashboard.colonies.admin.select_colonia',['neighbor'=>$neighbor]);
	}
	
	public function colsel()
	{	
		Session::put('colonia', Input::get('colonias'));
				
		$expiration = Expiration::where('colony_id','=',Input::get('colonias'))->where('status','=',1)->first();
		
		Session::put('days_expiration', 0); 
		Session::put('lic_fecha_expiration', 0); 
		
		if($expiration){
			
		$datetime2 = new DateTime($expiration->expiration);
		$datetime1 = new DateTime(date('Y-m-d'));
		
		$interval = $datetime1->diff($datetime2);
		$days_expiration = $interval->format('%a');

		Session::put('days_expiration', $days_expiration); 
		
			if($days_expiration <= 0){
					return Redirect::route('active.promo');
			}else{
				return Redirect::route('home');
			}
		
		}else{
			
			$lic_expiration = LicenseExpiration::where('colony_id','=',Input::get('colonias'))->first();
			
			if($lic_expiration){
				
				$datetime2 = new DateTime($lic_expiration->expiration);
				$datetime1 = new DateTime(date('Y-m-d'));
				
				$interval = $datetime1->diff($datetime2);
				$days_expiration = $interval->format('%a');

				Session::put('lic_expiration', $days_expiration); 
				Session::put('lic_fecha_expiration', $lic_expiration->expiration); 
				
				if($days_expiration <= 0){
						return Redirect::route('active.license');
				}else{
					return Redirect::route('home');
				}
				
			}else{
				return Redirect::route('home');
			}
		}
										
	}
	
	public function getStates()
	{		

		$country = Input::get('country');
	 
		$states = State::where('country_id', '=', $country)->get();

        return Response::json($states);
	
	}
	

	public function getCities()
	{
	
		$state = Input::get('state');
	 
		$cities = City::where('state_id', '=', $state)->get();

        return Response::json($cities);
		
	}
	
    public function config_index()
    { 	
		
		$attendant_id= Auth::user()->id;
		
		$attendant	 =  Neighbors::with('NeighborProperty')->findOrFail($attendant_id);
		
        $urbanism_types= UrbanismType::orderBy('id', 'ASC')->lists('type', 'id');
        
        $countries	= Country::orderBy('id', 'ASC')->lists('name', 'id');
        
        return View::make('dashboard.colonies.config.index',['urbanism_types'=>$urbanism_types, 
															 'attendant'=>$attendant,
															 'countries'=>$countries,
															 'select' 	=> ['' => 'Seleccione tipo de desarrollo'],
															 'select_1' => ['' => 'Seleccione País'],
															 'select_2' => ['' => 'Seleccione Estado'],
															 'select_3' => ['' => 'Seleccione Ciudad']
															 ]);
	}
	
	public function edit_informacion()
    { 	
	
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");				
		
		$colony= Colony::findOrFail($colonia);

		$urbanism= Urbanism::where('colony_id', '=',$colony->id )->first();				
		
		$urb_type 	 =  DB::table('urbanism_types')->where('id', $urbanism->urbanism_type_id)->first();
		
		$city 		 =  DB::table('cities')->where('id', $colony->location_id)->first();
		
		$state		 =  DB::table('states')->where('id', $city->state_id)->first();
		
		$country 	 =  DB::table('countries')->where('id', $state->country_id)->first();

        $urbanism_types= UrbanismType::orderBy('id', 'ASC')->lists('type', 'id');
        
        $countries	= Country::orderBy('id', 'ASC')->lists('name', 'id');
        
		$states		= State::orderBy('id', 'ASC')->lists('name', 'id');
		
		$cities 	=  City::where('state_id', '=', $state->id)->orderBy('id', 'ASC')->lists('name', 'id');
		
		$breadcrumbs	= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data	=	$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";
		
        return View::make('dashboard.colonies.config.info',[
															 'urbanism_types'=>$urbanism_types, 
															 'usuario'=>$breadcrumbs_data,
															 'colony'=>$colony,
															 'urbanism'=>$urbanism,
															 'countries'=>$countries,
															 'states'=>$states,
															 'cities'=>$cities,
															 'select' 	=> [ $urb_type->id => $urb_type->type ],
															 'select_1' => [ $country->id => $country->name],
															 'select_2' => [ $state->id => $state->name],
															 'select_3' => [ $city->id => $city->name]
															 ]);
	}
	
	public function edit_ubic()
    { 	
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");
	
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
	
		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;
		
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";
		
		$urbanism_type	= $urbanism->urbanism_type_id;
			
			if($urbanism_type == 3){
				$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanismo)->orderBy('id', 'ASC')->get();
				$select_name= 'name_floor';
				$piso_calle = 'Pisos';
			}else{
				$catalog	= StreetCatalog::where('urbanism_id','=',$urbanismo)->orderBy('id', 'ASC')->get();
				$select_name= 'name_street';
				$piso_calle = 'Calles';
			}
		
        return View::make('dashboard.colonies.config.ubic',['usuario' => $breadcrumbs_data, 
															'catalog' => $catalog, 
															'piso_calle' => $piso_calle
															]);
	}
	
	public function edit_cuota()
    { 	
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";	

        $cuotas  = DB::table('monthly_fee')
						->select(DB::raw('FORMAT(monthly_fee.amount,2) as amount'),'monthly_fee.since as since','monthly_fee.until as until')
						->where('monthly_fee.urbanism_id','=',$urbanism->id)
						->orderBy('monthly_fee.id', 'DESC')->get();
		
		$ult_cuota = MonthlyFee::where('urbanism_id','=',$urbanism->id)
								->orderBy('created_at', 'DESC')->first();
		
		//$until= $ult_cuota->until;
		
		//$since = date("Y-m",strtotime("$until +1 month"));

		//$new_since = $since."-01";
		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
        return View::make('dashboard.colonies.config.cuota',['usuario' 	  	  =>  	$breadcrumbs_data, 
															 'cuotas'    	  => 	$cuotas,
															 'meses' 		  =>  	$meses,
															 'urbanism_id' 	  =>	$urbanism->id
															 //'vigencia' 	  =>  $new_since,
															 ]);
	}
	
	public function edit_inv()
    { 	
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$attendant = Neighbors::where('user_id','=', $user_id)->first();
		
		$neighbors_invited 	= InvitedNeighbors::where('neighbor_id','=', $attendant->id)
								->where('confirmed','=', 0)
								->where('urbanism_id','=', $urbanism->id)
								->lists('email');

		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";	
		
        return View::make('dashboard.colonies.config.inv',[	'usuario'=>$breadcrumbs_data, 
															'urbanism_id' => $urbanism->id,
															'admin' => $attendant->id,
															'invitations' => $neighbors_invited ]);
	}

	public function reg_vecino()
    { 	
		
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanism_type	= $urbanism->urbanism_type_id;
			
		$attendant = Neighbors::where('user_id','=', $user_id)->first();
					
			if($urbanism_type == 3){
				$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanism->id)->orderBy('id', 'ASC')->lists('description', 'id');
				$select		= '¿Piso donde vive?';
				$select_name= 'name_floor';
			}else{
				$catalog	= StreetCatalog::where('urbanism_id','=',$urbanism->id)->orderBy('id', 'ASC')->lists('name', 'id');
				$select		= '¿Calle donde vive?';
				$select_name= 'name_street';
			}
		
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";	
		
        return View::make('dashboard.colonies.config.reg',[ 'usuario'=>$breadcrumbs_data,
        													'urbanism' =>$urbanism->name,
													  		'urbanism_id' =>$urbanism->id,
													  		'urbanism_type'=>$urbanism_type,
															'catalog'=>$catalog,
															'select_name'=>$select_name,
															'select' => ['' => $select],
															'']);
	}
	
	public function reg_familiar()
    { 	
		
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanism_type	= $urbanism->urbanism_type_id;
			
		$attendant = Neighbors::where('user_id','=', $user_id)->first();
					
			if($urbanism_type == 3){
				$catalog	= BuildingCatalog::where('urbanism_id','=',$urbanism->id)->orderBy('id', 'ASC')->lists('description', 'id');
				$select		= '¿Piso donde vive?';
				$select_name= 'name_floor';
			}else{
				$catalog	= StreetCatalog::where('urbanism_id','=',$urbanism->id)->orderBy('id', 'ASC')->lists('name', 'id');
				$select		= '¿Calle donde vive?';
				$select_name= 'name_street';
			}
			
		$neighbor_properties = NeighborProperty::where('neighbors_id','=', $attendant->id)->first();
		
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->name." ]";	
		
        return View::make('dashboard.colonies.config.reg_familiar',[ 'usuario'=>$breadcrumbs_data,
        													'urbanism' =>$urbanism->name,
													  		'urbanism_id' =>$urbanism->id,
													  		'urbanism_type'=>$urbanism_type,
															'catalog'=>$catalog,
															'select_name'=>$select_name,
															'select' => ['' => $select],
															'neighbor_properties'=>$neighbor_properties,
															'']);
	}
	
	public function nueva_colonia()
    { 	
	
		$colonia = Session::get("colonia");
	
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$user_id= Auth::user()->id;
		
		$user_admin = Neighbors::where('user_id','=', $user_id)->first();
		
		$code = Auth::user()->confirmation_code;
		
		$urbanism_types= UrbanismType::orderBy('id', 'ASC')->lists('type', 'id');
        
			$countries	= Country::orderBy('id', 'ASC')->lists('name', 'id');
		
			$states	= State::orderBy('id', 'ASC')->lists('name', 'id');
			
			$country_default= 'México';
			
			$selected_country = Country::where('name', '=', $country_default)->first();
			
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->name." ]";
			
			return View::make('dashboard.colonies.config.nueva_colonia',['urbanism_types'=>$urbanism_types,
															 'user'=>$breadcrumbs_data,
															 'user_admin'=>$user_admin,
															 'countries'=>$countries,
															 'states'=>$states,
															 'code'=>$code,
															 'selected_country'=>[$selected_country->id],
															 'select' 	=> ['' => 'Seleccione tipo de desarrollo'],
															 'select_1' => ['' => 'Seleccione País'],
															 'select_2' => ['' => 'Seleccione Estado'],
															 'select_3' => ['' => 'Seleccione Ciudad']
															 ]);
	}

	public function get_wizard()
    { 	
	
		$user_id= Auth::user()->id;
		
		$user = Auth::user()->email;
		
		$user_admin = Neighbors::where('user_id','=', $user_id)->first();
		
		$code = Auth::user()->confirmation_code;
		
		$urbanism_types= UrbanismType::orderBy('id', 'ASC')->lists('type', 'id');
        
			$countries	= Country::orderBy('id', 'ASC')->lists('name', 'id');
		
			$states	= State::orderBy('id', 'ASC')->lists('name', 'id');
			
			$country_default= 'México';
			
			$selected_country = Country::where('name', '=', $country_default)->first();
			
			return View::make('dashboard.colonies.admin.create_colony',['urbanism_types'=>$urbanism_types,
																		 'user'=>$user,
																		 'user_admin'=>$user_admin,
																		 'countries'=>$countries,
																		 'states'=>$states,
																		 'code'=>$code,
																		 'selected_country'=>[$selected_country->id],
																		 'select' 	=> ['' => 'Seleccione tipo de desarrollo'],
																		 'select_1' => ['' => 'Seleccione País'],
																		 'select_2' => ['' => 'Seleccione Estado'],
																		 'select_3' => ['' => 'Seleccione Ciudad']
																		 ]);
	}
	

	public function config_store()
	{
			$user_id= Auth::user()->id;
			$num_street_id=NULL;
			$num_floor_id= NULL;
			$data=Input::all();
			$name_floor= Input::get('name_floor');
			$name_street= Input::get('name_street');
		//~====================SAVE STEP 1===============================	

			$colony= new Colony;
			$colony->location_id	= Input::get('city');
			$colony->name			= Input::get('colony_name');
			
			if($colony->save()){
			
			$created_colony = date('Y-m-j', strtotime($colony->created_at));
			
			$newExpiration = strtotime ( '+1 month' , strtotime ( $created_colony ) ) ;
			$newExpiration = date ( 'Y-m-j' , $newExpiration );

			$expiration = new Expiration;
			$expiration->colony_id 	= $colony->id;
			$expiration->expiration = $newExpiration;
			$expiration->status 	= 1;
			$expiration->save();
			
			$expiration_lic = new LicenseExpiration;
			$expiration_lic->colony_id 	= $colony->id;
			$expiration_lic->expiration = null;
			$expiration_lic->save();
			
			$datetime2 = new DateTime($expiration->expiration);
			$datetime1 = new DateTime(date('Y-m-d'));
								
			$interval = $datetime1->diff($datetime2);
			$days_expiration = $interval->format('%a');

			Session::put('days_expiration', $days_expiration);
				
			$role = AssigmentRole::where('user_id','=',$user_id)->where('role_id','=',2)->where('colony_id','=',0)->first();
			
				if($role){
				$rol = AssigmentRole::findOrFail($role->id);
				$rol->colony_id 	= $colony->id;
				$rol->update(['id']);	
				}else{
					$rol = new AssigmentRole;
					$rol->user_id 	= $user_id;
					$rol->role_id 		= 2;
					$rol->colony_id 	= $colony->id;
					$rol->save();
				}
			
			}
			
			$last_colony_add = $colony->id;
			
			$urbanism= new Urbanism;
			$urbanism->colony_id		= $last_colony_add;
			$urbanism->urbanism_type_id	= Input::get('urbanism_type');
			//$urbanism->name				= Input::get('urbanism_name');
			$urbanism->save();

			$last_urbanism_add 	= $urbanism->id;
			
			$user_id= Auth::user()->id;
			
			$neighbor = Neighbors::where('user_id','=',$user_id)->pluck('id');
			
			if(!$neighbor)
			{
				$admin_colonies= new Neighbors;
				$admin_colonies->user_id	= $user_id;
				$admin_colonies->name		= Input::get('admin_name');
				$admin_colonies->last_name	= Input::get('admin_lname');
				$admin_colonies->phone		= Input::get('admin_phone');
				$admin_colonies->save();
				
				$last_adminColonies_add  = $admin_colonies->id;
			}
			if ($neighbor)
			{
				$last_adminColonies_add  = $neighbor;
			}
			
			$streets= $data['streets'];

			if($urbanism->urbanism_type_id == 3){
				foreach($streets as $Building_name){
					$Building= new BuildingCatalog;
					$Building->urbanism_id	= $last_urbanism_add;
					$Building->description	= $Building_name;
					$Building->save();
					
					if ($Building_name == $name_floor) {
						
						$num_floor_id =$Building->id;
					}
			
						
					
			}
			}else{
				foreach($streets as $street_name){
					
					$street= new StreetCatalog;
					$street->urbanism_id	= $last_urbanism_add;
					$street->name			=$street_name;
					$street->save();

					if ($street_name == $name_street) {
							$num_street_id=$street->id;
					}
							
					
					
				}
			}
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id  		 = $last_adminColonies_add;
			$neighbor_properties->urbanism_id   		 = $last_urbanism_add;
			$neighbor_properties->num_street_id 		 = $num_street_id;
			$neighbor_properties->num_floor_id  		 = $num_floor_id;
			$neighbor_properties->num_house_or_apartment = Input::get('num_house_or_apartment');
			$neighbor_properties->status = 1;
			$neighbor_properties->save();
			
		//~====================SAVE STEP 2===============================
			$monthly_fee= new MonthlyFee;
			
			$monthly_fee->urbanism_id=$last_urbanism_add;
			$monthly_fee->amount 	= Input::get('monthly_fee');
			$monthly_fee->since	 	= date("Y-m")."-01";
			$monthly_fee->until	 	= NULL;
			$monthly_fee->save();

		//~====================SAVE STEP 3===============================	
		
			//~====================sub cuentas egreso e ingreso por defecto ===============================
			
			$subAccounts_ingreso= new SubAccount;
			$subAccounts_ingreso->account_id = 1;
			$subAccounts_ingreso->urbanism_id = $urbanism->id;
			$subAccounts_ingreso->description = 'Pago de cuota mensual';
			$subAccounts_ingreso->save();
			
			$subAccount_egreso= new SubAccount;
			$subAccount_egreso->account_id = 2;
			$subAccount_egreso->urbanism_id = $urbanism->id;
			$subAccount_egreso->description = 'Nómina de guardias';
			$subAccount_egreso->save();
			
			$cobrador = Collector::where('user_id','=',$user_id)->where('urbanism_id','=',$urbanism->id)->pluck('id');
			
			if(!$cobrador)
			{
			$collector= new Collector;
			$collector->user_id = $user_id;
			$collector->urbanism_id = $urbanism->id;
			$collector->save();
			}
		
			$campoEmail = Input::get('email');
			
			if ($campoEmail)
			{
				$invited_neighbors= $data['mails'];
				
				$invited_id=  md5(uniqid(mt_rand(), true));
				
				foreach($invited_neighbors as $neighbor_email){
					
					$encrypted = Crypt::encrypt(md5(uniqid(mt_rand(), true)));
					
					$invited= new InvitedNeighbors;
					
					$invited->neighbor_id = $last_adminColonies_add;
					$invited->invited_id = $invited_id;
					$invited->urbanism_id= $last_urbanism_add;
					$invited->email 	 = $neighbor_email;
					$invited->confirmed  = false;
					$invited->confirmation_code= $encrypted;
					$invited->save();		
				}
			
				return Redirect::action('HomeController@sendMailInvitation', array('invited_id' => $invited_id, 'admin_colonia' => $last_adminColonies_add , 'urbanismo' => $last_urbanism_add));
			
			}
			
			else
			{
				return Redirect::action('NeighborController@admin_neighbor', array('admin_colonia' => $last_adminColonies_add,'urbanismo'=>$last_urbanism_add));
			}
			
	}

	public function editColonyInfo()
	{
				$data=Input::all();
				$user_id= Auth::user()->id;
				$colonia = Session::get("colonia");
				
				
				$neighbors 	= Neighbors::join('neighbors_properties','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
								->join('urbanisms','urbanisms.id' , '=', 'neighbors_properties.urbanism_id')
								->join('colonies','colonies.id' , '=', 'urbanisms.colony_id')
								 ->select('urbanisms.id as urbanisms_id','neighbors.id as neighbors_id','neighbors_properties.id as neighbors_properties_id','colonies.id as colonies_id')
								->where('colonies.id','=',$colonia)
								->where('user_id','=',$user_id)
								->first();
				
				$colony=Colony::findOrFail($neighbors->colonies_id);
				$colony->location_id	= Input::get('city');
				$colony->name			= Input::get('colony_name');
				$colony->update(['id']);

				$urbanism = Urbanism::findOrFail($neighbors->urbanisms_id);				
				$urbanism->urbanism_type_id	= Input::get('urbanism_type');
				$urbanism->update(['id']);
				
				
		$notice_msg = 'Datos guardados exitosamente';	
		return Redirect::action('ColonyController@edit_informacion')->with('error', false)
																	->with('msg', $notice_msg)->with('class', 'info');
	}
	
	public function editColonyUbic()
	{
			$data=Input::all();
			
			$colonia = Session::get("colonia");
	
			$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
			$urbanism_type	= $urbanism->urbanism_type_id;
		
			$streets= $data['streets'];

			if($urbanism->urbanism_type_id == 3){
				foreach($streets as $Building_name){
					
					$Building= new BuildingCatalog;
			
					$Building->urbanism_id	= $urbanism->id;
					$Building->description	= $Building_name;
					$Building->save();
			}
			}else{
				foreach($streets as $street_name){
					
					$street= new StreetCatalog;
			
					$street->urbanism_id	= $urbanism->id;
					$street->name			= $street_name;
					$street->save();
				}
			}
			
			$notice_msg = 'Datos guardados exitosamente';
		
			return Redirect::action('ColonyController@edit_ubic')->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');

	}
	
    public function store_vecino()
	{
			$colonia = Session::get("colonia");
		
			$post = Input::All();
		
			$invited_id =  md5(uniqid(mt_rand(), true));

			$encrypted = Crypt::encrypt(md5(uniqid(mt_rand(), true)));
			
			$user_id= Auth::user()->id;		
			$user_admin = Neighbors::where('user_id','=', $user_id)->first();
			
			$invited= new InvitedNeighbors;
				
			$invited->neighbor_id = $user_admin->id;
			$invited->invited_id = $invited_id;
			$invited->urbanism_id= Input::get('urbanism');
			$invited->email 	 = Input::get('email');
			$invited->confirmed  = 0;
			$invited->confirmation_code= $encrypted;
			$invited->save();		
			
			$user = new UserNeighbors;
            $user->email    = Input::get('email');
            $user->status_id= '1';
            $user->confirmed= '1';
            $user->confirmation_code     = md5(uniqid(mt_rand(), true));
            $user->save();
			
			$last_user_add = $user->id;
			
			$role = Role::where('name','=','vecino')->first();
			
			$rol = new AssigmentRole;
            $rol->user_id    = $last_user_add;
            $rol->role_id    = $role->id;
            $rol->colony_id  = $colonia;
			$rol->save();		         
			
			$neighbor = new Neighbors;
			$neighbor->user_id     =  $last_user_add;
			$neighbor->name        =  Input::get('firstname');
			$neighbor->last_name   =  Input::get('lastname');
			$neighbor->phone       =  Input::get('phone');
			$neighbor->save();
			
			$last_neighbor_add = $neighbor->id;
			
			$urbanism_type = Input::get('urbanism_type');	
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id= $last_neighbor_add;
			$neighbor_properties->urbanism_id= Input::get('urbanism');
			
			if($urbanism_type == 3){
			$neighbor_properties->num_floor_id= Input::get('name_floor');
			}else{
			$neighbor_properties->num_street_id= Input::get('name_street');	
			}
			
			$neighbor_properties->num_house_or_apartment= Input::get('num_house_or_apartment');
			$neighbor_properties->save();
			
			$neighbor_reg = InvitedNeighbors::where('invited_id','=', $invited_id)->first();
			
			$urbanism = Urbanism::where('id','=', $neighbor_reg->urbanism_id)->first();
			
			$email=$neighbor_reg->email;
			
			$data= array(
				'email'			    => $email,
				'link'				=> 'ConfirmationController@confirm_data',
				'code'				=> $neighbor_reg->confirmation_code,
				'name_inv'     		=> $user_admin->name,
				'lname_inv'     	=> $user_admin->last_name,
				'urbanism' 			=> $urbanism->name
				);
			
				Mail::send('emails.confirm_neighbors',$data, function ($message) use($email){
							$message->subject('Invitación HABITARIA');
							$message->to($email);
				});	

				
			$notice_msg = 'Datos guardados exitosamente';
		
			return Redirect::action('ColonyController@reg_vecino')->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');
	}
	
	public function store_familiar()
	{
			$colonia = Session::get("colonia");
			$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
			
			$post = Input::All();
		
			$invited_id =  md5(uniqid(mt_rand(), true));

			$encrypted = Crypt::encrypt(md5(uniqid(mt_rand(), true)));
			
			$user_id= Auth::user()->id;		
			$user_admin = Neighbors::where('user_id','=', $user_id)->first();
			
			$invited= new InvitedNeighbors;
				
			$invited->neighbor_id = $user_admin->id;
			$invited->invited_id = $invited_id;
			$invited->urbanism_id= Input::get('urbanism');
			$invited->email 	 = Input::get('email');
			$invited->confirmed  = 0;
			$invited->confirmation_code= $encrypted;
			$invited->save();		
			
			$user = new UserNeighbors;
            $user->email    = Input::get('email');
            $user->status_id= '1';
            $user->confirmed= '1';
            $user->confirmation_code     = md5(uniqid(mt_rand(), true));
            $user->save();
			
			$last_user_add = $user->id;
			
			$role = Role::where('name','=','vecino')->first();
			
			$rol = new AssigmentRole;
            $rol->user_id   = $last_user_add;
            $rol->role_id   = $role->id;
			$rol->colony_id = $colonia;
            $rol->save();		         
			
			$neighbor = new Neighbors;
			$neighbor->user_id     =  $last_user_add;
			$neighbor->name        =  Input::get('firstname');
			$neighbor->last_name   =  Input::get('lastname');
			$neighbor->phone       =  Input::get('phone');
			$neighbor->save();
			
			$last_neighbor_add = $neighbor->id;
			
			$urbanism_type = Input::get('urbanism_type');	
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id= $last_neighbor_add;
			$neighbor_properties->urbanism_id= Input::get('urbanism');
			
			$num_floor_id = null;
            $num_street_id = null;
			
			if($urbanism_type == 3){
			$num_floor_id = Input::get('piso');	
			$neighbor_properties->num_floor_id= $num_floor_id;
			}else{
			$num_street_id = Input::get('calle');	
			$neighbor_properties->num_street_id= $num_street_id;	
			}
			
			$house = Input::get('casa');
			$neighbor_properties->num_house_or_apartment= $house;
			
			$buscardomicilio = NeighborProperty::select('neighbors_properties.id')
                       ->where('neighbors_properties.urbanism_id','=',$urbanism->id)
                       ->where('neighbors_properties.num_floor_id','=',$num_floor_id)
                       ->where('neighbors_properties.num_street_id','=',$num_street_id)
                       ->where('neighbors_properties.num_house_or_apartment','=',$house)
                       ->first();
            
            if($buscardomicilio)
            {$status = 0;}
            else
            {$status = 1;}
			
			$neighbor_properties->status= $status;
			$neighbor_properties->save();
			
			$neighbor_reg = InvitedNeighbors::where('invited_id','=', $invited_id)->first();
			
			$urbanism = Urbanism::where('id','=', $neighbor_reg->urbanism_id)->first();
			
			$email=$neighbor_reg->email;
			
			$data= array(
				'email'			    => $email,
				'link'				=> 'ConfirmationController@confirm_data_fam',
				'code'				=> $neighbor_reg->confirmation_code,
				'name_inv'     		=> $user_admin->name,
				'lname_inv'     	=> $user_admin->last_name,
				'urbanism' 			=> $urbanism->name
				);
			
			Mail::send('emails.confirm_neighbors',$data, function ($message) use($email){
							$message->subject('Invitación HABITARIA');
							$message->to($email);
				});	

			$notice_msg = 'Datos guardados exitosamente';
		
			return Redirect::action('ColonyController@reg_familiar')->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');
	}
	
	  public function store_cuota()
	{
			$post = Input::All();
			
			$urbanism_id = Input::get('urbanism');

			$fecha_actual = date("Y-m")."-01";
			$until_fecha = strtotime ( '-1 day' , strtotime ( $fecha_actual ) ) ;
			
			$cuota_ant = MonthlyFee::where('urbanism_id','=',$urbanism_id)
								    ->orderBy('created_at', 'DESC')->first();
							
			$cuota_ant->until	= date ( 'Y-m-d' , $until_fecha );
			$cuota_ant->update(['id']);	
			
			$monthly_fee= new MonthlyFee;
			
			$monthly_fee->urbanism_id = $urbanism_id;
			$monthly_fee->amount 	  = Input::get('monthly_fee');
			$monthly_fee->since	 	  = $fecha_actual;
			$monthly_fee->until	 	  = NULL;
			$monthly_fee->save();
			
			$notice_msg = 'Cuota agregada exitosamente';
		
			return Redirect::action('ColonyController@edit_cuota')->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');
	
	}

	public function edit_streets()
	{	
		
		$id = Input::get('pk');	
		$value = Input::get('value');
		
		$street = StreetCatalog::where('id','=',$id)->first();							
		$street->name = $value;
			
		if($street->save()) 
        return Response::json(array('id'=>$id, 'msg'=>'Datos guardados exitosamente'));
		else 
        return Response::json(array('id'=>$id, 'msg'=>'Error al tratar de guardar los datos'));
	
	}

	public function edit_building()
	{
			
		$id = Input::get('pk');
		$value = Input::get('value');
		
		$building = BuildingCatalog::where('id','=',$id)->first();							
		$building->description	= $value;
		
		if($building->save()) 
        return Response::json(array('id'=>$id, 'msg'=>'Datos guardados exitosamente'));
		else 
        return Response::json(array('id'=>$id, 'msg'=>'Error al tratar de guardar los datos'));		
	
	}

	public function send_inv()
	{
		$data = Input::All();
			 
		$invited_id=  md5(uniqid(mt_rand(), true));
		
		$invited_neighbors= $data['mails'];
		
		foreach($invited_neighbors as $neighbor_email){
				
			$encrypted = Crypt::encrypt(md5(uniqid(mt_rand(), true)));
				
			$invited= new InvitedNeighbors;
				
			$invited->neighbor_id = Input::get('admin_colonia');
			$invited->invited_id = $invited_id;
			$invited->urbanism_id= Input::get('urbanism_id');
			$invited->email 	 = $neighbor_email;
			$invited->confirmed  = false;
			$invited->confirmation_code= $encrypted;
			$invited->save();	
			
		}
			
		$neighbors 	= InvitedNeighbors::where('invited_id','=', $invited_id)->get();
		
		$admin_colonia = Neighbors::where('id','=', Input::get('admin_colonia'))->first();

		$urbanism = Urbanism::where('id','=', Input::get('urbanism_id'))->first(); 				
			
		foreach($neighbors as $inv_neighbor){
				
				$email = $inv_neighbor->email;
		
				$data= array(
				'email'				=> $email,
				'link'				=> 'ConfirmationController@confirm',
				'code'				=> $inv_neighbor->confirmation_code,
				'name_inv'     		=> $admin_colonia->name,
				'lname_inv'     	=> $admin_colonia->last_name,
				'urbanism' 			=> $urbanism->Colony->name
				);
			
				Mail::send('emails.confirm_neighbors',$data, function ($message) use($email){
							$message->subject('Invitación HABITARIA');
							$message->to($email);
				});	
			}
	
		$notice_msg = "Vecinos invitados con éxito";
		return Redirect::action('ColonyController@edit_inv')->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');
		
	}


	public function emails($value='')
	{
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$neighbor = Neighbors::where('user_id','=', $user_id)->first();
		
		$neighbors = NeighborProperty::with('Neighbors')
						->where('urbanism_id','=', $urbanism->id)
						->where('neighbors_id', '!=', $neighbor->id)
						->get();
		
		$roles=Role::where('id','<>',1)->get();
		foreach ($roles as $rol ) {
				  	$optionsRoles[$rol->id] = ucfirst( $rol->name );
				  }	  
		$correos['Todos'] = 'Todos';
		$correos['Roles'] = $optionsRoles;
		
		if(sizeof($neighbors) != 0)
		{
			foreach ($neighbors as $neighbor) {
					$optionsCorreosVecinos[$neighbor->Neighbors->User->id] =  $neighbor->Neighbors->User->email;
			}
			
			$correos['Vecinos'] = $optionsCorreosVecinos;
		}
		
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
					
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";
	
        return View::make('dashboard.colonies.config.emails',[	'usuario'=>$breadcrumbs_data, 
																'urbanism' => $urbanism->id,
																'admin' => $neighbor->id,
																'correos'  => $correos
															 ]);
	}

	public function sendEmails()
		{
			$colonia = Session::get("colonia");
			$coloniaName = Colony::find($colonia);
			$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
			$state	=  State::where('id', $coloniaName->City->state_id)->first()->name;
			$ciudad = $coloniaName->City->name;
			$contenido= Input::get('contenido');
			$user_id=Input::get('email');
			$asunto= Input::get('asunto');
			$admin_colonia = Neighbors::where('user_id','=', Auth::user()->id )->first();
			$optGroup = Input::get('optGroup');

			
						
			if ($user_id == 'Todos' && $optGroup == NULL) {
				
					$neighbors = NeighborProperty::with('Neighbors')->where('urbanism_id','=', $urbanism->id)
						->where('neighbors_id', '!=', $admin_colonia->id)
						->get();
						
					foreach ($neighbors as $neighbor) {

							$email=$neighbor->Neighbors->User->email;
				
						
							$data= array(
							'email'				=> $email,
							'link'				=> 'ConfirmationController@confirm',
							'code'				=> "jhhjdhsdhhdsjhdsh",
							'name_inv'     		=> $admin_colonia->name,
							'lname_inv'     	=> $admin_colonia->last_name,
							'urbanism' 			=> $urbanism->name,
							'contenido'         => $contenido,
							'asunto'            => $asunto,
							'coloniaName'       => $coloniaName,
							'estado'            => $state,
							'ciudad'            => $ciudad
							);
						
							Mail::send('emails.email_masivos',$data, function ($message) use($email,$asunto){
										$message->subject($asunto);
										$message->to($email);
							});
					}

			}

			if($optGroup == 'Vecinos'){

				$email=User::findOrFail($user_id)->email;
				
						
				$data= array(
				'email'				=> $email,
				'link'				=> 'ConfirmationController@confirm',
				'code'				=> "jhhjdhsdhhdsjhdsh",
				'name_inv'     		=> $admin_colonia->name,
				'lname_inv'     	=> $admin_colonia->last_name,
				'urbanism' 			=> $urbanism->name,
				'contenido'         => $contenido,
				'asunto'            => $asunto,
				'coloniaName'       => $coloniaName,
				'estado'            => $state,
				'ciudad'            => $ciudad
				);
			
				Mail::send('emails.email_masivos',$data, function ($message) use($email,$asunto){
							$message->subject($asunto);
							$message->to($email);
				});
			}
			if($optGroup == 'Roles'){

				$neighbors = NeighborProperty::join('neighbors','neighbors.id','=','neighbors_properties.neighbors_id')							
							->join('assigned_roles','neighbors.user_id', '=', 'assigned_roles.user_id')
							
							->where('assigned_roles.colony_id', '=', $colonia)
							->where('urbanism_id','=', $urbanism->id)
							->where('assigned_roles.role_id', '=', $user_id)

							->get();
							
					foreach ($neighbors as $neighbor) {

							$email=$neighbor->Neighbors->User->email;
				
						
							$data= array(
							'email'				=> $email,
							'link'				=> 'ConfirmationController@confirm',
							'code'				=> "jhhjdhsdhhdsjhdsh",
							'name_inv'     		=> $admin_colonia->name,
							'lname_inv'     	=> $admin_colonia->last_name,
							'urbanism' 			=> $urbanism->name,
							'contenido'         => $contenido,
							'asunto'            => $asunto,
							'coloniaName'       => $coloniaName,
							'estado'            => $state,
							'ciudad'            => $ciudad
							);
						
							Mail::send('emails.email_masivos',$data, function ($message) use($email,$asunto){
										$message->subject($asunto);
										$message->to($email);
							});
					}
			}
			
		}

		public function suggestion()
			{
				$user_id= Auth::user()->id;
		
				$colonia = Session::get("colonia");

				$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
				
				$neighbor = Neighbors::where('user_id','=', $user_id)->first();
				
				$neighbors = NeighborProperty::with('Neighbors')->where('urbanism_id','=', $urbanism->id)
						->where('neighbors_id', '!=', $neighbor->id)
						->get();

								
				$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
							
				$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";
				
				$suggestions= DB::table('suggestions')->select('suggestions.id','suggestions.user_id','neighbors.name','neighbors.last_name','suggestions.asunto','suggestions.contenido','suggestions.id_mensaje','suggestions.mark','suggestions.created_at')->join('neighbors','neighbors.user_id' , '=', 'suggestions.user_id')->where('id_receptor','=',$user_id)->where('tray','<>',0)->orderBy('created_at', 'desc')->paginate(10);
				$count= Suggestion::where('id_receptor','=',$user_id)->where('tray','<>',0)->where('mark','<>','read')->count();
				$suggestionsSent= Suggestion::where('user_id','=',$user_id)->where('tray','<>',0)->get();
				
		        return View::make('dashboard.colonies.suggestions.suggestion',[	'usuario'=>$breadcrumbs_data, 
																'urbanism'    => $urbanism->id,
																'admin'       => $neighbor->id,
																'suggestions' => $suggestions,
																'count'       => $count,
																'suggestionsSent' => $suggestionsSent,
																'contador' => 1
																
															 ]);
			}	
}	

