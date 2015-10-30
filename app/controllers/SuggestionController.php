<?php

class SuggestionController extends BaseController
{
	
	public function save()
	{		

		$colonia = Session::get('colonia');

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$user_id     = Auth::user()->id;

		$bd_inbox    = Input::get('bd_inbox');

		$asunto      = Input::get('asunto');
		
		$contenido   = Input::get('contenido');

		$tray        = Input::get('tray');

		$status      = Input::get('status');

		$id_receptor = Input::get('id_receptor');
	
		$admin = NeighborProperty::join('neighbors','neighbors.id','=','neighbors_properties.neighbors_id')							
							     ->join('assigned_roles','neighbors.user_id', '=', 'assigned_roles.user_id')
							     ->where('assigned_roles.colony_id', '=', $colonia)
							     ->where('urbanism_id','=', $urbanism->id)
							     ->where('assigned_roles.role_id', '=', 2)
							     ->first();

		
		
		$neighbor_id = Neighbors::where('user_id','=', $user_id)->pluck('id');
		
		$neighbor 	= NeighborProperty::with('Urbanism.Colony')->where('neighbors_id','=',$neighbor_id)->get();
		
		try
			{
				$sugerencia= new Suggestion;
				$sugerencia->user_id            		= $user_id;
				$sugerencia->bd_inbox				    = $bd_inbox;
				$sugerencia->asunto                     = $asunto;
				$sugerencia->contenido                	= $contenido;
				$sugerencia->tray 						= $tray;
				$sugerencia->status            			= $status;
				$sugerencia->id_receptor				= $admin->user_id;
				$sugerencia->id_mensaje 				= uniqid('msn');
				$sugerencia->mark                       = 'unread';
				
				$sugerencia->save();
			
				return 1;
			}
		
		catch (Exception $exc) 
            {
                    return 0;
            }

		
	}

	public function sugerenciasView($id_mensaje)
    {
    	$user_id= Auth::user()->id;
		
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
				
		$neighbor = Neighbors::where('user_id','=', $user_id)->first();
				
		$neighbors = NeighborProperty::with('Neighbors')->where('urbanism_id','=', $urbanism->id)
						->where('neighbors_id', '!=', $neighbor->id)
						->get();

								
		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();
							
		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->name." ]";
		
		$suggestions = Suggestion::where('id_mensaje','=',$id_mensaje)->first();
		$suggestions->mark = 'read';
		$suggestions->status = 'Pendiente';
		$suggestions->save();
		$count = Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=', $user_id)->where('mark','<>','read')->count();
		
		
		return View::make('dashboard.colonies.suggestions.suggestions_view',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'neighbors' => $neighbors]);
    }

    public function sugerenciasEnviadas()
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
				
				$suggestions= Suggestion::where('user_id','=',$user_id)->where('tray','<>',0)->where('bd_inbox','=',1)->orderBy('created_at', 'desc')->paginate(10);
				$count= Suggestion::where('id_receptor','=',$user_id)->where('tray','<>',0)->where('bd_inbox','=',2)->where('mark','<>','read')->count();
								
		        return View::make('dashboard.colonies.suggestions.suggestions_sent',[
		        												'usuario'     => $breadcrumbs_data, 
																'urbanism'    => $urbanism,
																'admin'       => $neighbor->id,
																'suggestions' => $suggestions,
																'count'       => $count,
																'contador'    => 1,
																'neighbor'    => $neighbor
																
															 ]);
    }

    public function sugerenciasViewSent($id_mensaje)
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
		
		$suggestions = Suggestion::where('id_mensaje','=',$id_mensaje)->first();
		$suggestions->mark = 'read';
		$suggestions->status = 'Pendiente';
		$suggestions->save();
		$count = Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=', $user_id)->where('mark','<>','read')->count();
		
		
		return View::make('dashboard.colonies.suggestions.suggestions_view_sent',['nombre'=>$breadcrumbs_data, 'suggestions' => $suggestions, 'count' => $count, 'contador' => 1, 'neighbor' => $neighbor, 'urbanism' => $urbanism]);
    }

    public function markChange()
	{
		
		$user_id= Auth::user()->id;
		$data   = Input::get('data');
		$option = Input::get('option');
		
		foreach ($data as $value) {
			
			$suggestion = Suggestion::where('id', $value)->update([ 'mark' => $option ]);
			
		}
		$count = Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=',$user_id)->where('mark','=','unread')->count();
		return json_encode( $count );
	}

	public function delete()
	{
		$user_id= Auth::user()->id;
		$data = Input::get('data');
		foreach ($data as $value) {
			$suggestion = Suggestion::where('id', $value)->update([ 'tray' => 0 ]);
		}

		$count = Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=',$user_id)->where('mark','=','unread')->count();
		return json_encode( $count );
	}

		public function udtateSuggestion()
	{
		$titleSuggestion = Input::get('titleSuggestion');

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");
		
		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
				
		$neighbor = Neighbors::where('user_id','=', $user_id)->first();

		$html='';

		if ($titleSuggestion == "Recibidos") {
			$suggestions =Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=',Auth::user()->id)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
                                  
                     $neighbors= Neighbors::join('neighbors_properties', 'neighbors.id', '=', 'neighbors_properties.neighbors_id')
                                                                ->join('urbanisms', 'neighbors_properties.urbanism_id', '=', 'urbanisms.id')
                                                                ->select('neighbors.name as name', 'neighbors.last_name', 'urbanisms.name as urbanisms')
                                                                ->where('user_id','=',$suggestion->id_receptor)->first();   
                    
                    $html.='<tr class="'.$suggestion->mark.'">
                               <td>
                               		  <div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'.$suggestion->id.'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'.$suggestion->id.'"></label>
                                      </div>
                               </td>
                               <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                               <td><a href="'.URL::route('config.colony.suggestions.view',$suggestion->id_mensaje).'">Administrador del Sistema</a></small></td>
                               <td width="40%"><a href="'.URL::route('config.colony.suggestions.view',$suggestion->id_mensaje).'">'.$suggestion->asunto.'</a></td>
                               <td>'.$suggestion->created_at.'</td>
                            </tr>';
                             
			}
		}

		if ($titleSuggestion == "Enviados") {
			$suggestions= Suggestion::where('user_id','=',Auth::user()->id)->where('tray','<>',0)->where('bd_inbox','=',1)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
               
                                 
                                 $html.=' <tr class="'.$suggestion->mark.'">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'.$suggestion->id .'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'.$suggestion->id .'"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$neighbor->name.' '.$neighbor->last_name.'</a>  <small><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$urbanism->name.'</a></small></td>
                                    <td width="50%"><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$suggestion->asunto.'</a></td>
                                    <td>'.$suggestion->created_at.'</td>
                                  </tr>';
                             
		    }
		}

		if ($titleSuggestion == "Papelera") {
			
			$suggestions= Suggestion::where('user_id','=',$user_id)->where('tray','=',0)->where('bd_inbox','=',1)->orderBy('created_at', 'desc')->get();
			
			foreach ($suggestions as $suggestion) {
			
                                  
                                  
                                 
                                  $html.='<tr class="'.$suggestion->mark.'">
                                    <td><div class="user-image"><img alt="User" src="http://placehold.it/150x150"/>
                                        <input id="'.$suggestion->id.'" type="checkbox" class="checkbox" name="check-row" />
                                        <label for="'.$suggestion->id.'"></label>
                                      </div>
                                    </td>
                                    <td class="star"><a class="fa fa-flag flagged-grey"></a></td>
                                    <td><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$neighbor->name.' '.$neighbor->last_name .'</a>  <small><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$urbanism->name.'</a></small></td>
                                    <td width="50%"><a href="'.URL::route('config.colony.suggestions.view.sent',$suggestion->id_mensaje).'">'.$suggestion->asunto.'</a></td>
                                    <td>'.$suggestion->created_at.'</td>
                                  </tr>';
                              
                              
		    }
		}

		
		$count = Suggestion::where('bd_inbox','=',2)->where('tray','<>',0)->where('id_receptor','=',Auth::user()->id)->where('mark','=','unread')->count();
		$data=['data' => $count, 'html' => $html];
		return  $data;
	}


	public function sugerenciasPapelera()
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
				
				$suggestions= Suggestion::where('user_id','=',$user_id)->where('tray','=',0)->where('bd_inbox','=',1)->orderBy('created_at', 'desc')->paginate(10);
				$count= Suggestion::where('id_receptor','=',$user_id)->where('tray','<>',0)->where('bd_inbox','=',2)->where('mark','<>','read')->count();
								
		        return View::make('dashboard.colonies.suggestions.suggestions_trash',[
		        												'usuario'     => $breadcrumbs_data, 
																'urbanism'    => $urbanism,
																'admin'       => $neighbor->id,
																'suggestions' => $suggestions,
																'count'       => $count,
																'contador'    => 1,
																'neighbor'    => $neighbor
																
															 ]);
	}

}	
