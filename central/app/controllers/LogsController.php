<?php


class LogsController extends BaseController {

	public function index()
    {
		$user_id= Auth::user()->id;
		
		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;	

        $logs = Logs::all();

		return View::make('dashboard.logs.index',[
															'nombre'=>$breadcrumbs_data,
															'logs' => $logs
														]);
    }

}
