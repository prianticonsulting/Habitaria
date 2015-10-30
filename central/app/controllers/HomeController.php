<?php

class HomeController extends BaseController {

	public function index()
    {
	
		if (Auth::check()) { 
	
				$user_id= Auth::user()->id;	

				$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
				$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
				
				$Status =  DB::connection('habitaria_dev')->select('SELECT Count(suggestions.id) as cantidad, suggestions.status FROM suggestions
GROUP BY suggestions.status');

				$Asunto =  DB::connection('habitaria_dev')->select('SELECT Count(suggestions.id) as cantidad, suggestions.asunto FROM suggestions
GROUP BY suggestions.asunto');

				return View::make('dashboard.home',['nombre'=>$breadcrumbs_data,
													'Status'=>$Status,
													'Asunto'=>$Asunto]);
															
		}else{
	
				return Redirect::action('UsersController@login');

		}
	}


	
}
