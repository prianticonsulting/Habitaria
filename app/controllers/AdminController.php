<?php

class AdminController extends BaseController
{

    public function permission_index()
    {
		$president_id= Auth::user()->id;
		
		$users	= User::with('AssigmentRole')->with('Neighbors')->paginate(10);
		
		$president_urbanism= Neighbors::with('NeighborProperty')->findOrFail($president_id);
		
		foreach($president_urbanism->NeighborProperty as $row){
			
			$urbanism_id	= $row->urbanism_id;	
			$neighbors		= NeighborProperty::where('urbanism_id','=',$urbanism_id)->get();
		}

		
		$roles		= Role::orderBy('id', 'ASC')->lists('name', 'id');

		return View::make('dashboard.admin.permission.index',	['select' => ['' => 'Seleccione'], 
																'neighbors'=>$neighbors, 
																'roles'=>$roles,
																'users'=>$users]);
    }
   
    public function permission_tree()
    {

		$attendant_id= Auth::user()->id;
		
		$attendant	 =  Neighbors::with('NeighborProperty')->findOrFail($attendant_id);
		
		return View::make('dashboard.admin.permission.tree', [ 'attendant' => $attendant ]);
		
    }
	
}
