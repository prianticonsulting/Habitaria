<?php

class SuggestionController extends BaseController {

	public function sugerencias()
    {
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
		
		$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->orderBy('created_at', 'desc')->paginate(10);
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		// $notificaciones = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->get();
		return View::make('dashboard.suggestions.suggestions',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1]);
	}

	public function sugerenciasEnviadas()
    {
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
		
		$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',2)->where('tray','<>',0)->orderBy('created_at', 'desc')->paginate(10);
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		$notificaciones = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->get();
		return View::make('dashboard.suggestions.suggestions_sent',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'notificaciones' => $notificaciones]);
	}

	
	public function sugerenciasPapelera()
    {
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
		
		$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',2)->where('tray','=',0)->orderBy('created_at', 'desc')->paginate(10);
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		$notificaciones = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->get();
		return View::make('dashboard.suggestions.suggestions_trash',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'notificaciones' => $notificaciones]);
	}
	
	public function sugerenciasView($id_mensaje)
    {
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
		
		$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('id_mensaje','=',$id_mensaje)->first();
		DB::connection('habitaria_dev')->table("suggestions")->where('id_mensaje','=',$id_mensaje)->update(['mark' =>  'read','status' => 'Pendiente']);
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		$notificaciones = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->get();
		$neighbors= DB::connection('habitaria_dev')->table("neighbors")
                                                                            ->join('neighbors_properties', 'neighbors.id', '=', 'neighbors_properties.neighbors_id')
                                                                            ->join('urbanisms', 'neighbors_properties.urbanism_id', '=', 'urbanisms.id')
                                                                            ->select('neighbors.name as name', 'neighbors.last_name', 'urbanisms.name as urbanisms')
                                                                            ->where('user_id','=',$suggestions->user_id)->first();
		return View::make('dashboard.suggestions.suggestions_view',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'notificaciones' => $notificaciones, 'neighbors' => $neighbors]);
	}

	public function save()
	{		

		$suggestions=[
				'user_id'     => Auth::user()->id,
				'bd_inbox'    => Input::get('bd_inbox'),
				'asunto'      => Input::get('asunto'),				
				'contenido'   => Input::get('contenido'),
				'tray'        => Input::get('tray'),
				'status'      => Input::get('status'),
				'id_receptor' => Input::get('id_receptor'),
				'id_mensaje'  => uniqid('msn'),
				'mark'        => 'unread'
		];

		
		
		
		
		try
			{
				DB::connection('habitaria_dev')->table("suggestions")->insert($suggestions);
			
				return 1;
			}
		
		catch (Exception $exc) 
            {
                    return 0;
            }

		
	}

	public function buscar()
	{

		
	}

	public function markChange()
	{
		$data   = Input::get('data');
		$option = Input::get('option');
		
		foreach ($data as $value) {
			
			$suggestion = DB::connection('habitaria_dev')->table("suggestions")->where('id', $value)->update([ 'mark' => $option ]);
			
		}
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		return json_encode( $count );
	}

	public function sugerenciasViewSent($id_mensaje)
    {
		$user_id= Auth::user()->id;	

		$breadcrumbs= Data_users::where('user_id','=',$user_id)->first();
								
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name;
		$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('id_mensaje','=',$id_mensaje)->first();
		
        $user= User::with('Data_users')->find($suggestions->user_id); 
                                     
                                 
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		
		
		return View::make('dashboard.suggestions.suggestions_view_sent',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'user' => $user]);
	}
	
	public function delete()
	{
		$data = Input::get('data');
		foreach ($data as $value) {
			$suggestion = DB::connection('habitaria_dev')->table("suggestions")->where('id', $value)->update([ 'tray' => 0 ]);
		}
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		return json_encode( $count );
	}

	public function udtateSuggestion()
	{
		$titleSuggestion = Input::get('titleSuggestion');
		$html='';
		if ($titleSuggestion == "Recibidos") {
			$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
                                  
                     $neighbors= DB::connection('habitaria_dev')->table("neighbors")
                                                                ->join('neighbors_properties', 'neighbors.id', '=', 'neighbors_properties.neighbors_id')
                                                                ->join('urbanisms', 'neighbors_properties.urbanism_id', '=', 'urbanisms.id')
                                                                ->select('neighbors.name as name', 'neighbors.last_name', 'urbanisms.name as urbanisms')
                                                                ->where('user_id','=',$suggestion->user_id)->first();   
                    $html.='<tr class="'.$suggestion->mark.'">
                               <td>
                               		  <div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'.$suggestion->id.'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'.$suggestion->id.'"></label>
                                      </div>
                               </td>
                               <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                               <td><a href="'.URL::route('suggestions.view',$suggestion->id_mensaje).'">'.$neighbors->name.' '.$neighbors->last_name.'</a> <small><a href="'.URL::route('suggestions.view',$suggestion->id_mensaje).'">'.$neighbors->urbanisms.'</a></small></td>
                               <td width="40%"><a href="'.URL::route('suggestions.view',$suggestion->id_mensaje).'">'.$suggestion->asunto.'</a></td>
                               <td>'.$suggestion->status.'</td>
                               <td>'.$suggestion->created_at.'</td>
                            </tr>';
                             
			}
		}

		if ($titleSuggestion == "Enviados") {
			$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',2)->where('tray','<>',0)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
                                  
                                      $user= User::with('Data_users')->find($suggestion->user_id); 
                                      

                                  
                                 $html.=' <tr class="'.$suggestion->mark.'">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'. $suggestion->id.'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'. $suggestion->id.'"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="'. URL::route('suggestions.view.sent',$suggestion->id_mensaje).'">'. ucfirst($user->Data_users->name).' '. ucfirst($user->Data_users->last_name).'</a></td>
                                    <td width="40%"><a href="'.URL::route('suggestions.view.sent',$suggestion->id_mensaje).'">'.$suggestion->asunto.'</a></td>
                                    <td>'. $suggestion->status.'</td>
                                    <td>'. $suggestion->created_at.' </td>
                                  </tr>';
                              
		    }
		}

		if ($titleSuggestion == "Papelera") {
			$suggestions = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',2)->where('tray','=',0)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
                                  
                                  $user= User::with('Data_users')->find($suggestion->user_id); 
                                      

                                   
                                  $html.='<tr class="'.$suggestion->mark.'">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'.$suggestion->id.'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'.$suggestion->id.'"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="#">'. ucfirst($user->Data_users->name).' '. ucfirst($user->Data_users->last_name).'</a></td>
                                    <td width="40%"><a href="#">'.$suggestion->asunto.'</a></td>
                                    <td>'.$suggestion->status.'</td>
                                    <td>'.$suggestion->created_at.'</td>
                                  </tr>';
                              
		    }
		}

		
		$count = DB::connection('habitaria_dev')->table("suggestions")->where('bd_inbox','=',1)->where('tray','<>',0)->where('id_receptor','=',0)->where('mark','=','unread')->count();
		$data=['data' => $count, 'html' => $html];
		return  $data;
	}
}
