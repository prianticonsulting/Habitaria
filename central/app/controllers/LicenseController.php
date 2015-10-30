<?php


class LicenseController extends BaseController {

	
	public function index($colony)
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$colony_data = Colony::where('id','=',$colony)->first();
		
		$colony_name = $colony_data->name;

		$admin_colonia =  AssigmentRoleHab::where('role_id','=',2)->where('colony_id','=',$colony)->pluck('user_id');
		
		return View::make('dashboard.colonies.generate_license',[
															'nombre'=>$breadcrumbs_data,
															'colony'=>$colony,
															'colony_name'=>$colony_name,
															'admin_colonia'=>$admin_colonia
														]); 

	}
	
	public function license()
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$licenses = License::all();	
		
		$admin_colonies =  AssigmentRoleHab::where('role_id','=',2)->get();
		
		return View::make('dashboard.license.index',[
															'nombre'=>$breadcrumbs_data,
															'licenses'=>$licenses,
															'num' => 1,
															'admin'=> $admin_colonies
														]); 

	}

	public function create(){
	
		$data=Input::all();
		
		$license = new License;
		$license->months =Input::get('months');
		$license->code =Crypt::encrypt(Input::get('code'));
		$license->status = 0;
		$license->colony_id =Input::get('colony_id');
		
		if($license->save()){
			
			$user_id = Input::get('admin_colonia');
			
			$admin_user = DB::connection('habitaria_dev')->select('select email from users where id = ? ', [$user_id]);
			
			foreach ($admin_user as $user) {
				$admin_email = $user->email;
			}
			
			$admin_neighbor = Neighbors::where('user_id','=',$user_id)->first();
			
			$colony_data = Colony::where('id','=',$license->colony_id)->first();
		
			$colony_name = $colony_data->name;
		
			$data= array(
				'email'			    => $admin_email,
				'months'			=> $license->months,
				'code'				=> Crypt::decrypt($license->code),
				'colony' 			=> $colony_name,
				'admin'				=> $admin_neighbor->name.' '.$admin_neighbor->last_name
				);
			
				Mail::send('emails.cupon_license',$data, function ($message) use($admin_email){
							$message->subject('Licencia para HABITARIA');
							$message->to($admin_email);
				});	

				
			$notice_msg = 'Licencia enviada al administrador de la Colonia: '.$colony_name;
		
			return Redirect::action('LicenseController@report_license', $license->colony_id)->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');	
		}

	}
	
	public function report_license($colony)
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$colony_data = Colony::where('id','=',$colony)->first();
		
		$colony_name = $colony_data->name;
		
		$licenses = License::where('colony_id','=',$colony)->get();	
		
		return View::make('dashboard.license.report_license',[
															'nombre'=>$breadcrumbs_data,
															'colony_name'=>$colony_name,
															'licenses'=>$licenses,
															'num' => 1
														]); 

	}

	public function ver_cupon($id)
    {
		
		$license = License::where('id','=',$id)->first();	
		
		$code = Crypt::decrypt($license->code);
		$months = $license->months;

		return View::make('dashboard.license.send_license',[
															'months'	=>$months,
															'code'		=>$code,
															'license'	=>$id
														]); 

	}

	public function send_cupon($id)
    {
			
			$license = License::where('id','=',$id)->first();	

			$user_id =  AssigmentRoleHab::where('role_id','=',2)->where('colony_id','=',$license->colony_id)->pluck('user_id');
			
			$admin_user = DB::connection('habitaria_dev')->select('select email from users where id = ? ', [$user_id]);
			
			foreach ($admin_user as $user) {
				$admin_email = $user->email;
			}
			
			$admin_neighbor = Neighbors::where('user_id','=',$user_id)->first();
			
			$colony_data = Colony::where('id','=',$license->colony_id)->first();
		
			$colony_name = $colony_data->name;
		
			$data= array(
				'email'			    => $admin_email,
				'months'			=> $license->months,
				'code'				=> Crypt::decrypt($license->code),
				'colony' 			=> $colony_name,
				'admin'				=> $admin_neighbor->name.' '.$admin_neighbor->last_name
				);
			
				Mail::send('emails.cupon_license',$data, function ($message) use($admin_email){
							$message->subject('Licencia para HABITARIA');
							$message->to($admin_email);
				});	

				
			$notice_msg = 'Licencia enviada al administrador de la Colonia: '.$colony_name;
		
			return Redirect::back()->with('error', false)
					->with('msg', $notice_msg)->with('class', 'info');	

	}
	
}
