<?php

class ColonyController extends BaseController {

	
	public function index()
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
				
		$colonies_inactive = Expiration::where('status','=',1)->get();
					 
		$admin_colonies =  AssigmentRoleHab::where('role_id','=',2)->get();			

		return View::make('dashboard.colonies.inactive',[
															'nombre'=>$breadcrumbs_data,
															'colonies'=> $colonies_inactive,
															'admin'=> $admin_colonies
														]); 

	}
	
	public function index_lic()
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
				
		$colonies_active = LicenseExpiration::where('expiration','!=','0000-00-00')->get();
				
		$admin_colonies =  AssigmentRoleHab::where('role_id','=',2)->get();			

		return View::make('dashboard.colonies.active',[
															'nombre'=>$breadcrumbs_data,
															'colonies'=> $colonies_active,
															'admin'=> $admin_colonies
														]); 

	}
	
}
