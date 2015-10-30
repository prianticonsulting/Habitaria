<?php
use Jaspersoft\Client\Client;

	class ReportCitiesController extends BaseController
	{
		public function VerListaStates()
		{
			$user_id=Auth::user()->id;
			$estados = State::orderBy('name', 'ASC')->lists('name', 'id');
			$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();

			$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
			return View::make("dashboard.reports.cities",['estados'=> $estados, 'breadcrumbs_data' => $breadcrumbs_data]);
		}

		public function GeneraReporte()
		{
		 ini_set('max_execution_time', 900000);
		$c = new Client(
						"http://162.243.142.165:8080/jasperserver",
						"jasperadmin",
						"jasperadmin"
					);
		$c->setRequestTimeout(900000);            

		$controls = array(
		   'stateId' => $_POST['estados']
		   );
		$reporte = $c->reportService()->runReport('/reports/Blank_A4','html',null, null, $controls);
		$estados = State::orderBy('name', 'ASC')->lists('name', 'id');
		$user_id=Auth::user()->id;
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();

		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
		return View::make("dashboard.reports.report",['reporte'=> $reporte, 'breadcrumbs_data' => $breadcrumbs_data]);
		}

	public function GeneraReportePagos()
		{
		$user_id=Auth::user()->id;
		 ini_set('max_execution_time', 900000);
		$idurbanismo=Neighbors::where('user_id','=',$user_id)->first();
		
		$idurbanismo=$idurbanismo->urbanism_id;
	
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();

		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
		
		$payments=Payment::select()
		->join('neighbors_properties','payments.neighbor_property_id','=','neighbors_properties.neighbors_id')
		->where('neighbors_properties.urbanism_id','=',$idurbanismo)
		->count();
		if($payments==0)
		{
			$isEmpty=true;
		}
		else
		{
			$isEmpty=false;
		}
		return View::make("dashboard.reports.report",['isEmpty'=>$isEmpty, 'idurbanismo'=> $idurbanismo, 'breadcrumbs_data' => $breadcrumbs_data]);
		}
	}