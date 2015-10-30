<?php


class PromoController extends BaseController {

	
	public function index($colony)
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$colony_data = Colony::where('id','=',$colony)->first();
		
		$colony_name = $colony_data->name;

		$admin_colonia =  AssigmentRoleHab::where('role_id','=',2)->where('colony_id','=',$colony)->pluck('user_id');
		
		return View::make('dashboard.colonies.generate_promo',[
															'nombre'=>$breadcrumbs_data,
															'colony'=>$colony,
															'colony_name'=>$colony_name,
															'admin_colonia'=>$admin_colonia
														]); 

	}
	
	public function promos()
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$promos = Promo::all();	
		
		$admin_colonies =  AssigmentRoleHab::where('role_id','=',2)->get();
		
		return View::make('dashboard.promos.index',[
															'nombre'=>$breadcrumbs_data,
															'promos'=>$promos,
															'num' => 1,
															'admin'=> $admin_colonies
														]); 

	}

	public function create(){
	
		$data=Input::all();
		
		$promo = new Promo;
		$promo->days =Input::get('days');
		$promo->code =Crypt::encrypt(Input::get('code'));
		$promo->status = 0;
		$promo->colony_id =Input::get('colony_id');
		
		if($promo->save()){
			
			$user_id = Input::get('admin_colonia');
			
			$admin_user = DB::connection('habitaria_dev')->select('select email from users where id = ? ', [$user_id]);
			
			foreach ($admin_user as $user) {
				$admin_email = $user->email;
			}
			
			$admin_neighbor = Neighbors::where('user_id','=',$user_id)->first();
			
			$colony_data = Colony::where('id','=',$promo->colony_id)->first();
		
			$colony_name = $colony_data->name;
		
			$data= array(
				'email'			    => $admin_email,
				'days'				=> $promo->days,
				'code'				=> Crypt::decrypt($promo->code),
				'colony' 			=> $colony_name,
				'admin'				=> $admin_neighbor->name.' '.$admin_neighbor->last_name
				);
			
				Mail::send('emails.cupon_promo',$data, function ($message) use($admin_email){
							$message->subject('Promo de HABITARIA');
							$message->to($admin_email);
				});	

				
			$notice_msg = 'Promo enviada al administrador de la Colonia: '.$colony_name;
		
			return Redirect::action('PromoController@report_promo', $promo->colony_id)->with('error', false)
															 ->with('msg', $notice_msg)->with('class', 'info');	
		}

	}
	
	public function report_promo($colony)
    {
	
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;		
		
		$colony_data = Colony::where('id','=',$colony)->first();
		
		$colony_name = $colony_data->name;
		
		$promos = Promo::where('colony_id','=',$colony)->get();	
		
		return View::make('dashboard.promos.report_promo',[
															'nombre'=>$breadcrumbs_data,
															'colony_name'=>$colony_name,
															'promos'=>$promos,
															'num' => 1
														]); 

	}

	public function ver_cupon($id)
    {
		
		$promo = Promo::where('id','=',$id)->first();	
		
		$code = Crypt::decrypt($promo->code);
		$days = $promo->days;

		return View::make('dashboard.promos.send_promo',[
															'days'	=>$days,
															'code'	=>$code,
															'promo'	=>$id
														]); 

	}

	public function send_cupon($id)
    {
			
			$promo = Promo::where('id','=',$id)->first();	

			$user_id =  AssigmentRoleHab::where('role_id','=',2)->where('colony_id','=',$promo->colony_id)->pluck('user_id');
			
			$admin_user = DB::connection('habitaria_dev')->select('select email from users where id = ? ', [$user_id]);
			
			foreach ($admin_user as $user) {
				$admin_email = $user->email;
			}
			
			$admin_neighbor = Neighbors::where('user_id','=',$user_id)->first();
			
			$colony_data = Colony::where('id','=',$promo->colony_id)->first();
		
			$colony_name = $colony_data->name;
		
			$data= array(
				'email'			    => $admin_email,
				'days'				=> $promo->days,
				'code'				=> Crypt::decrypt($promo->code),
				'colony' 			=> $colony_name,
				'admin'				=> $admin_neighbor->name.' '.$admin_neighbor->last_name
				);
			
				Mail::send('emails.cupon_promo',$data, function ($message) use($admin_email){
							$message->subject('Promo de HABITARIA');
							$message->to($admin_email);
				});	

				
			$notice_msg = 'Promo enviada al administrador de la Colonia: '.$colony_name;
		
			return Redirect::back()->with('error', false)
					->with('msg', $notice_msg)->with('class', 'info');	

	}		
}
