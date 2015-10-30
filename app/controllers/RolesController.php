<?php 

class RolesController extends Controller
{
	public function vistaCrear () {
		$roles = Role::all();
		$user_id=Auth::user()->id;
		$colonia = Session::get("colonia");
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$urbanism->colony->name."]";
		return View::make("dashboard.roles.crearRol")->with(array("roles" => $roles, 'breadcrumbs_data' => $breadcrumbs_data));
	}
	public function vistaAsignar () {
		
		$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");
		
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;
		
		$users = Neighbors::select('neighbors.user_id','roles.name','users.email','neighbors_properties.urbanism_id','assigned_roles.role_id')
							->where("neighbors_properties.urbanism_id","=",$urbanismo)
							->where("assigned_roles.colony_id","=",$colonia)
							->join("users","neighbors.user_id","=","users.id")
							->join("assigned_roles","assigned_roles.user_id","=","users.id")
							->join("roles","assigned_roles.role_id","=","roles.id")
							->join("neighbors_properties","neighbors_properties.neighbors_id","=","neighbors.id")
							->get();
	
		$roles = Role::all();
		
		$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();
		
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";
		
		return View::make("dashboard.roles.asignarRol")->with(array("users" => $users,"roles" => $roles, 'breadcrumbs_data' => $breadcrumbs_data));
	}
	public function vistaPermisos () {
		$roles = Role::select("id","name")->orderBy("id")->get();
		$permisos = PermissionRole::where("role_id","=","2")
									->select("id","state")
									->orderBy("id")
									->get();

		$user_id=Auth::user()->id;
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();
		$colonia = Session::get("colonia");
		
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";
		
		return View::make("dashboard.roles.rolPermisos")->with(array("roles" => $roles,"permisos" => $permisos, 'breadcrumbs_data' => $breadcrumbs_data));
	}
	public function tablaRolesPermiso () {
		$id = Input::get("id");
		$roles = Role::select("id","name")->orderBy("id")->get();
		$permisos = PermissionRole::where("role_id","=",$id)
									->select("id","state")
									->orderBy("id")
									->get();
		$html = View::make("dashboard.roles.rolesTablaPermisos")->with(array("roles" => $roles,"permisos" => $permisos,"role" => Input::get("role"),"id" => $id));
		$datos = (string) $html;
		return Response::json(array(
			"datos" => $datos
		));
	}
	public function cambiarPermisos () {
		/*$id = Input::get("id");
		$state = Input::get("state");*/
		

		$colonia = Session::get("colonia");
		$coloniaName = Colony::find($colonia);
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		$datos = (string) Input::get("datos");
		$rol   =  Input::get('rol');
		$array = explode(",", $datos);
		$num = count($array);
		
		for ($i = 0; $i < $num; $i++) {
			$permisos = explode(".", $array[$i]);
			$id = (int) $permisos[0];
			$estado = (int) $permisos[1];
			
			$permiso = PermissionRole::find($id);	
			$permiso->state = $estado;
			$permiso->save();
		}
		// $permiso = PermissionRole::find($id);
		// $permiso->state = $state;
		// $permiso->save();
		return Response::json(array(
			"estado" => 1
		));
	}
	public function crearRol () {
		$rol = Input::all();
		$reglas = array(
			"rol" => "required|alpha"
		);
		$mensajes = array(
			"rol.required" => "Ingrese un Rol",
			"rol.alpha" => "Solo se permiten letras"
		);
		$validar = Validator::make($rol,$reglas,$mensajes);
		if ($validar->passes()) {
			$role = new Role();
			$role->name = Input::get("rol");
			$role->save();
			$permisos = Permission::get();
			foreach($permisos as $permiso) {
				$rol = new PermissionRole();
				$rol->role_id = $role->id;
				$rol->state = 0;
				$rol->permission_id = $permiso['id'];	
				$rol->save();
			}
			$html = (string) View::make("dashboard.roles.rolesTablaRoles")->with(array("roles" => Role::all()));
			return Response::json(array(
				"estado" => 1,
				"html" => $html
			));
		} else {
			return Response::json(array(
				"estado" => 2,
				"error" => $validar->getMessageBag()->toArray()
			));
		}
	}
	public function asignarRol () {
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
		
		$datos = (string) Input::get("rol");
		$array = explode(",",$datos);
		$num = count($array);
		for ($i = 0; $i < $num; $i++) {
			$roles = explode(".", $array[$i]);
			$id = (int) $roles[1];
			$rol = (int) $roles[0];
			$urb = (int) $roles[2];
			//$permisos = Permisos::all();
			//$permisos = Permisos::find($id);
			Permisos::where("user_id","=",$id)->where("colony_id","=",Session::get("colonia"))->update(array("role_id" => $rol));
			$BuscarCollector = Collector::where("user_id","=",$id)->where('urbanism_id','=',$urbanism->id)->orderBy('updated_at', 'desc')->first();
			
			if($rol == 2 || $rol == 3 || $rol == 4 || $rol == 5)
				{
					if(!$BuscarCollector)
						{  
							$Collector= new Collector;
							$Collector->user_id				= $id;
							$Collector->urbanism_id			= $urb;
							$Collector->save();
						}
				}
			if($rol == 6)
				{
					if($BuscarCollector)
						{  
							$cobrador= Collector::findOrFail($BuscarCollector->id);
							$cobrador->delete(['id']);
						}
				}
			//$permisos->role_id = $rol;
			//$permisos->save();
		}
		return Response::json(array(
			"estado" => 1
		));
	}
	public function eliminarRol () {
		$rol = Input::get("rol");
		$roles = Permisos::where("role_id","=",$rol)->get();
		if(count($roles) > 0) {
			return Response::json(array(
				"estado" => "1"
			));	
		} else {
			$role = Role::find($rol);
			$role->delete();
			$permisos = Roles::find($rol);
			$permisos->delete();
			$html = (string) View::make("dashboard.roles.rolesTablaRoles")->with(array("roles" => Role::all()));
			return Response::json(array(
				"estado" => "2",
				"html" => $html
			));
		}
	}
}
 ?>