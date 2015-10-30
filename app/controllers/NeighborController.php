<?php

class NeighborController extends BaseController
{

    public function profile()
    {
		$neighbor_id = Auth::user()->id;
		
		$colonia = Session::get("colonia");
		$urbanismUsers= Urbanism::where('colony_id', '=',$colonia)->first();
		$neighbor=  Neighbors::with('NeighborProperty')->where('user_id','=',$neighbor_id)->first();
		$role = AssigmentRole::where('user_id','=',$neighbor_id)->where('colony_id','=',$colonia)->first();
		$neighbor_role	= ucfirst($role->Role->name);											
							
		$licencia = License::where('colony_id','=',$colonia)->first();		
		$expiration_license = LicenseExpiration::where('colony_id','=',$colonia)->first();
		$photo_user= UserPhoto::where('user_id','=',$neighbor_id)->where('colony_id','=',$colonia)->pluck('filename');
		
        return View::make('dashboard.neighbors.profile',['neighbor'	=>$neighbor,														 
														 'colonia_nombre' =>$urbanismUsers->Colony->name,
														 'urbanism' =>$urbanismUsers->Colony->name,
														 'role' =>$neighbor_role,
														 'licencia' => $licencia,
														 'photo_user' => $photo_user,
														 'expiration_license' => $expiration_license]);
    }
    
    
    
    public function tmp_store()
	{
		try{
			Session::put('name'		, Input::get('firstname'));
			Session::put('lastname'	, Input::get('firstname'));
			Session::put('email'	, Input::get('email'));
			Session::put('phone'	, Input::get('phone'));
			Session::put('catalog'	, ($select_name=='name_floor')? 'name_floor':'name_street');
			
			return View::make('dashboard.neighbors.register');
		
		}catch (Exception $exc) {

            echo $exc->getMessage() . "  line " . $exc->getLine();
			exit;
            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }	
		
	}
	
    public function store()
	{
			$post = Input::All();
		
			$urbanismNeigh = Input::get('urbanism');
			
			$user = new UserNeighbors;
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->status_id= '1';
            $user->confirmed= '1';
            $user->confirmation_code     = md5(uniqid(mt_rand(), true));
            $user->save();
			
			$last_user_add = $user->id;
			
			$role = Role::where('name','=','vecino')->first();
			
			$urbanism = Urbanism::findOrFail(Input::get('urbanism'));
			
			$rol = new AssigmentRole;
            $rol->user_id   	= $last_user_add;
            $rol->role_id 		= $role->id;
			$rol->colony_id 	= $urbanism->colony_id;
            $rol->save();		         
			
			$neighbor = new Neighbors;
			$neighbor->user_id     =  $last_user_add;
			//$neighbor->urbanism_id =  Input::get('urbanism');
			$neighbor->name        = Input::get('firstname');
			$neighbor->last_name   = Input::get('lastname');
			$neighbor->phone       = Input::get('phone');
			$neighbor->save();
			
			$last_neighbor_add = $neighbor->id;

			$urbanism_type = Input::get('urbanism_type');	
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id= $last_neighbor_add;
			$neighbor_properties->urbanism_id= Input::get('urbanism');
			
			$num_floor_id = null;
            $num_street_id = null;
			
			if($urbanism_type == 3){
			$num_floor_id = Input::get('name_floor');
			$neighbor_properties->num_floor_id = $num_floor_id;
			}else{
			$num_street_id = Input::get('name_street');	
			$neighbor_properties->num_street_id = $num_street_id;	
			}
			$house = Input::get('num_house_or_apartment');
			$neighbor_properties->num_house_or_apartment = $house;
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
        
			$user_auth= User::where('id','=',$last_user_add)->first();
			
			$confirm = InvitedNeighbors::where('Confirmation_code','=',Input::get('code'))->first();
			
			$confirm->confirmed = true;
			$confirm->update(['id']);
					
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();
					   
			$user= Neighbors::where('id','=',$last_neighbor_add)->pluck('user_id');
			
			$user_auth= User::where('id','=',$user)->first();
			
			Auth::login($user_auth);
			
			if (Auth::check()) { 		
					
					Session::put('colonia', $colonies->id);
					return Redirect::action('HomeController@index');
			
			}else{ 
			
					return Redirect::action('UsersController@login');	
			
			}					
        
	}
    
	public function admin_neighbor()
	{
			
			$admin_colonia = Input::get('admin_colonia'); 
			
			$admin_neighbor = Neighbors::where('id','=', $admin_colonia)->first();
			
			$urbanism_id 	= Input::get('urbanismo');
			$urbanism	 	= Urbanism::findOrFail($urbanism_id);
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
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanism_id)
					   ->first();
			
			Session::put('colonia', $colonies->id);
			return Redirect::action('HomeController@index');
		
	}
	
	public function store_admin()
	{		
			$post = Input::All();			
			
			$urbanismNeigh = Input::get('urbanism');
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id= Input::get('neighbor');
			$neighbor_properties->urbanism_id= $urbanismNeigh;
			
			$urbanism_type = Input::get('urbanism_type');	
			
			$num_floor_id = null;
			$num_street_id = null;
			
			if($urbanism_type == 3){
			$num_floor_id = Input::get('name_floor');
			$neighbor_properties->num_floor_id= $num_floor_id;
			}else{
			$num_street_id = Input::get('name_street');
			$neighbor_properties->num_street_id= $num_street_id;	
			}
			
			$house = Input::get('num_house_or_apartment');
			
			$neighbor_properties->num_house_or_apartment= $house;
			$buscardomicilio = NeighborProperty::select('neighbors_properties.id')
                       ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
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
		
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();
					   
			Session::put('colonia', $colonies->id);
		
			return Redirect::action('HomeController@index');			
        
	}
   

    public function store_update()
	{
			$post 		= 	Input::All();
			$email  	= 	Input::get('email');
			
			$user_id		=	User::where('email','=',$email)->pluck('id');
			$neighbor_add	= 	Neighbors::where('user_id','=',$user_id)->first();					
			$neighbor_pro	= 	NeighborProperty::where('neighbors_id','=',$neighbor_add->id)->first();
			
			$user = UserNeighbors::findOrFail($user_id);
            $user->password = Hash::make(Input::get('password'));
            $user->update(['id']);
			
			$last_user_add = $user->id;				         
			
			$neighbor = Neighbors::findOrFail($neighbor_add->id);
			$neighbor->name        = Input::get('firstname');
			$neighbor->last_name   = Input::get('lastname');
			$neighbor->phone       = Input::get('phone');
			$neighbor->update(['id']);
			
			$last_neighbor_add = $neighbor->id;

			$urbanism_type = Input::get('urbanism_type');	
			
			$neighbor_properties =  NeighborProperty::findOrFail($neighbor_pro->id);
			if($urbanism_type == 3){
			$neighbor_properties->num_floor_id= Input::get('name_floor');
			}else{
			$neighbor_properties->num_street_id= Input::get('name_street');	
			}
			$neighbor_properties->num_house_or_apartment= Input::get('num_house_or_apartment');
			$neighbor_properties->update(['id']);     			
			
			$confirm = InvitedNeighbors::where('Confirmation_code','=',Input::get('code'))->first();
			
			$confirm->confirmed = true;
			$confirm->update(['id']);
			
			$urbanismNeigh = $neighbor_properties->urbanism_id;
			
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();

			$user_auth= User::where('id','=',$last_user_add)->first();
			
			Auth::login($user_auth);
			
			if (Auth::check()) { 		
				
				Session::put('colonia', $colonies->id);
				return Redirect::action('HomeController@index');
			
			}else{ 
			
				return Redirect::action('UsersController@login');	
			
			}				
        
	}
	
	public function store_update_fam()
	{
			$post 		= 	Input::All();
			$email  	= 	Input::get('email');
			
			$user_id		=	User::where('email','=',$email)->pluck('id');
			$neighbor_add	= 	Neighbors::where('user_id','=',$user_id)->first();					
			$neighbor_pro	= 	NeighborProperty::where('neighbors_id','=',$neighbor_add->id)->first();
			
			$user = UserNeighbors::findOrFail($user_id);
            $user->password = Hash::make(Input::get('password'));
            $user->update(['id']);
			
			$last_user_add = $user->id;				              			
			
			$neighbor = Neighbors::findOrFail($neighbor_add->id);
			$neighbor->name        = Input::get('firstname');
			$neighbor->last_name   = Input::get('lastname');
			$neighbor->phone       = Input::get('phone');
			$neighbor->update(['id']);
			
			$confirm = InvitedNeighbors::where('Confirmation_code','=',Input::get('code'))->first();
			
			$confirm->confirmed = true;
			$confirm->update(['id']);
			
			$urbanismNeigh = $neighbor_pro->urbanism_id;
			
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();

			$user_auth= User::where('id','=',$last_user_add)->first();
			
			Auth::login($user_auth);
			
			if (Auth::check()) { 		
				
				Session::put('colonia', $colonies->id);
				return Redirect::action('HomeController@index');
			
			}else{ 
			
				return Redirect::action('UsersController@login');	
			
			}				
        
	}
	
	public function register_properties()
    {
			$neighbor		= 	Input::get('neighbor');
			$urbanism_id	=	Input::get('urbanism_id');
			
			$neighbor   = Neighbors::where('id','=',$neighbor)->first();

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
			
			return View::make('dashboard.neighbors.register_properties',[ 'neighbor'=>$neighbor,
																		  'urbanism'=>$urbanism,
																		  'urbanism_type'=>$urbanism_type,
																		  'catalog'=>$catalog,
																		  'select_name'=>$select_name,
																		  'select' => ['' => $select]
																	]);

		
	}  
	
	public function store_register_properties()
	{		
			$post = Input::All();			
			
			$urbanismNeigh = Input::get('urbanism');
			
			$neighbor_properties = new NeighborProperty;
			$neighbor_properties->neighbors_id= Input::get('neighbor');
			$neighbor_properties->urbanism_id= $urbanismNeigh;
			
			$urbanism_type = Input::get('urbanism_type');	
			
			if($urbanism_type == 3){
			$neighbor_properties->num_floor_id= Input::get('name_floor');
			}else{
			$neighbor_properties->num_street_id= Input::get('name_street');	
			}
			
			$neighbor_properties->num_house_or_apartment= Input::get('num_house_or_apartment');	
		
			if($neighbor_properties->save()){
				
				$role 	  = Role::where('name','=','vecino')->first();
				$user_id  = Neighbors::where('id','=',Input::get('neighbor'))->pluck('user_id');
				$colony   = Urbanism::where('id','=',Input::get('urbanism'))->pluck('colony_id');
				
				$rol = new AssigmentRole;
				$rol->user_id   	= $user_id;
				$rol->role_id 		= $role->id;
				$rol->colony_id 	= $colony;
				$rol->save();
				
			}
			
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();
		
			$user= Neighbors::where('id','=',Input::get('neighbor'))->pluck('user_id');
			
			$user_auth= User::where('id','=',$user)->first();
			
			Auth::login($user_auth);
			
			if (Auth::check()) { 		
				
				Session::put('colonia', $colonies->id);
				return Redirect::action('HomeController@index');
			
			}else{ 
			
				return Redirect::action('UsersController@login');	
			
			}				
        
	}
		
	public function register_neighbors()
    {
			$user			= 	Input::get('user');
			$urbanism_id	=	Input::get('urbanism_id');
	
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

			return View::make('dashboard.neighbors.create_register',[ 	
																		'urbanism'=>$urbanism_name,
																		'urbanism_id'=>$urbanism_id,
																		'urbanism_type'=>$urbanism_type,
																		'catalog'=>$catalog,
																		'user'=>$user,
																		'select_name'=>$select_name,
																		'select' => ['' => $select],
																		]);

		
	}

	public function store_register_neighbors()
	{
			$post = Input::All();

			$urbanismNeigh = Input::get('urbanism');

			$neighbor = new Neighbors;
			$neighbor->user_id     =  Input::get('user_id');
			//$neighbor->urbanism_id =  Input::get('urbanism');
			$neighbor->name        = Input::get('firstname');
			$neighbor->last_name   = Input::get('lastname');
			$neighbor->phone       = Input::get('phone');
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
	
        	if($neighbor_properties->save()){
				
				$role 	  = Role::where('name','=','vecino')->first();
				$colony   = Urbanism::where('id','=',Input::get('urbanism'))->pluck('colony_id');
	
				$rol = new AssigmentRole;
				$rol->user_id    = Input::get('user_id');
				$rol->role_id = $role->id;
				$rol->colony_id = $colony;
				$rol->save();
				
			}
			
			$colonies = Colony::select('colonies.id')
					   ->join('urbanisms','urbanisms.colony_id','=','colonies.id')
					   ->join('neighbors_properties','urbanisms.id','=','neighbors_properties.urbanism_id')
					   ->where('neighbors_properties.urbanism_id','=',$urbanismNeigh)
					   ->first();

			$user= Neighbors::where('id','=',$last_neighbor_add)->pluck('user_id');
			
			$user_auth= User::where('id','=',$user)->first();
			
			Auth::login($user_auth);
			
			if (Auth::check()) { 		
				
				Session::put('colonia', $colonies->id);
				return Redirect::action('HomeController@index');
			
			}else{ 
			
				return Redirect::action('UsersController@login');	
			
			}					
        
	}

	public function fotoPerfil()
    {

    	if (Request::ajax())
		{
    		
    		$file = Input::file('photo');
    		$user_id = Auth::user()->id;
    		$colony_id  = Session::get("colonia");
       		$userPhoto= UserPhoto::where('user_id','=',$user_id)->where('colony_id','=',$colony_id)->first();
       		$public_filename= $file->getClientOriginalName();
			$filename = uniqid().'_'.str_random(6).'_'.$file->getClientOriginalName();
       		if(!is_dir("uploads/users/avatars/")) {
        			mkdir("uploads/users/avatars/", 0777);
       		}

       		if($userPhoto){
       			$archivo="uploads/users/avatars/".$userPhoto->filename;
       			if(File::exists($archivo)){
       					unlink("uploads/users/avatars/".$userPhoto->filename);
		       	}
       			$userPhoto->public_filename = $public_filename;
		       	$userPhoto->filename = $filename;
		       	$userPhoto->colony_id = $colony_id;
		       	$userPhoto->update();
       			
       		}else{
       			
       			UserPhoto::create(['user_id' => $user_id,'public_filename' => $public_filename,'filename' =>  $filename, 'colony_id' => $colony_id ]);
      		}

       		if ($file->move("uploads/users/avatars/",$filename)) {
       		 	return 'Foto Subida Exitosamente!';
			
       		}else{
       			return '¡Algo salió mal! con la Carga de la Foto!';
			 	
       		}
		}
    }
	
}


