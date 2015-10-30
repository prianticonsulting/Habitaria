<?php

class ReportsController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 * GET /reports
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$user_id = Auth::user()->id;

		$idurbanismo = Neighbors::where('user_id','=',$user_id)->first();

		$idurbanismo = $idurbanismo->urbanism_id;

		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
																														->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   																									->where('neighbors.user_id','=',$user_id)
					   																									->first();



		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$neighbor = Neighbors::where('user_id','=', self::getUserId())->pluck('id');
		$breadcrumbs_data = $breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$urb_name."]";
		$property_id = NeighborProperty::where('urbanism_id','=', $urbanismo)->where('neighbors_id','=', $neighbor)->pluck('id');

        $payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
                             ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
                             ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
                             ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
                             ->where('neighbor_property_id','=',$property_id)
                             ->get();


		return View::make("dashboard.reports.report",['idurbanismo'=> $idurbanismo, 'breadcrumbs_data' => $breadcrumbs_data, 'payments' => $payments]);
	}

	public function reportPayments($id = null)
	{
		$colonia = Session::get("colonia");

		$desde = Input::get('desde');

		$hasta = Input::get('hasta');

		$AssigmentRole= Auth::user()->AssigmentRole[0]->role_id;

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->name;
		$saldoTotal = array();
		$neighbor = Neighbors::where('user_id','=', self::getUserId())->pluck('id');

		$property_id = NeighborProperty::where('urbanism_id','=', $urbanismo)->where('neighbors_id','=', $neighbor)->pluck('id');

        // $payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
        //                      ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
        //                      ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
        //                      ->join('urbanisms','urbanisms.id' , '=', 'neighbors_properties.urbanism_id')
        //                      ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description','neighbors_properties.id as properties')
        //                      ->where('urbanisms.id','=',$urbanismo)
        //                      ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
        //                      ->get();
        // if($payments->count() > 0){
		//
		// 	foreach ($payments as  $value) {
		// 		$saldoTotal[$value->properties] = 0;
		// 	}
		// }

		$neighbor_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
                             ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
                             ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
                             ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
                             ->where('neighbor_property_id','=',$property_id)
							 ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
                             ->orderBy('created_at')
                             ->get();

		$ano = date("Y");

		$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();


		$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->orderBy('monthly_fee.created_at', 'ASC')->pluck('since');

		$mes_ini = (int) date("m",strtotime($monthly_ini));

		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$mes = array("Ene","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

		$cuotas = array();

		foreach ($monthly_all as $cuota_mensual){

				$ini = (int) date("m",strtotime($cuota_mensual->since));
				$fin = (int) date("m",strtotime($cuota_mensual->until));

				if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }

				for($i=$ini; $i<=$fin; $i++){

						$cuotas[$i] = $cuota_mensual->amount;
				}

		}

		$total = count($neighbor_payments);

		$pdf = PDF::loadView('dashboard.reports.pdf',

		['payments' => $neighbor_payments,
		'AssigmentRole' => $AssigmentRole,
		'desde' => $desde,
		'hasta' => $hasta,
		'total' => $total,
		'cuotas'=> $cuotas,
		'mes_ini'=>$mes_ini,
		'meses'=>$meses,
		'mes'=>$mes,
		'urbanismo' => $urbanismo]);

		return $pdf->download('reporte_pagos.pdf');

	}



	public function ajaxReportPayments()
	{
		$desde = strftime("%Y-%m-%d",strtotime( Input::get('desde') ) );

		$hasta = strftime("%Y-%m-%d",strtotime( Input::get('hasta') ) );

		$user_id = Auth::user()->id;
		$AssigmentRole= Auth::user()->AssigmentRole[0]->role_id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$neighbor = Neighbors::where('user_id','=', $user_id)->pluck('id');

		$property_id = NeighborProperty::where('urbanism_id','=', $urbanismo)->where('neighbors_id','=', $neighbor)->pluck('id');


        $neighbor_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
                             ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
                             ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
                             ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
                             ->where('neighbor_property_id','=',$property_id)
							 ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
                             ->orderBy('created_at')
                             ->get();

		$ano = date("Y");

		$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();


		$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->orderBy('monthly_fee.created_at', 'ASC')->pluck('since');

		$mes_ini = (int) date("m",strtotime($monthly_ini));

		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$mes = array("Ene","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

		$cuotas = array();

		foreach ($monthly_all as $cuota_mensual){

				$ini = (int) date("m",strtotime($cuota_mensual->since));
				$fin = (int) date("m",strtotime($cuota_mensual->until));

				if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }

				for($i=$ini; $i<=$fin; $i++){

						$cuotas[$i] = $cuota_mensual->amount;
				}

		}

		$breadcrumbs= Neighbors::with('NeighborProperty')->where('user_id','=',$user_id)->first();

		$breadcrumbs_data=	$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

		$total = count($neighbor_payments);

		if ($neighbor_payments->count() > 0) {
			$html = Form::open(['url' => 'dashboard/reports/generate-pdf-payments', 'class' => 'form-inline']).'<input type="submit" name="Generar Pdf" value="Generar PDF" id="btnPdf" class="btn btn-default"><input type="hidden" name="desde" value="'.$desde.'"><input type="hidden" name="hasta" value="'.$hasta.'"></form>';
		}

		$view = View::make('dashboard.reports.reportPayment',[
																'payments' => $neighbor_payments,
																'breadcrumbs_data' => $breadcrumbs_data,
																'AssigmentRole' => $AssigmentRole,
																'total' => $total,
																'cuotas'=> $cuotas,
																'mes_ini'=>$mes_ini,
																'meses'=>$meses,
																'mes'=>$mes,
                                                                'urbanismo' => $urbanismo,
																'html' => $html
															]);

		return $view;
	}

	public function incomesReport()
	{
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();


		$neighbors = NeighborProperty::with('Neighbors')
						->where('urbanism_id','=', $urbanism->id)
						->get();
		$optionsCorreosVecinos['Todos'] = 'Todos';
		foreach ($neighbors as $key => $neighbor) {
			$tipoUrb = $neighbor->Urbanism->UrbanismType->id;
			if ($tipoUrb == 3) {

				 $optionsCorreosVecinos[$neighbor->id] =  $neighbor->Neighbors->name." ".$neighbor->Neighbors->last_name." | ".$neighbor->Building->description." - Apartamento ". $neighbor->num_house_or_apartment;
			}else{

				 $optionsCorreosVecinos[$neighbor->id] =  $neighbor->Neighbors->name." ".$neighbor->Neighbors->last_name." | Calle ".$neighbor->Street->name." - Calle ". $neighbor->num_house_or_apartment;
			}

		}

		$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";
		return View::make('dashboard.reports.incomes.index',['optionsCorreosVecinos' => $optionsCorreosVecinos, 'neighbors' => $neighbors, 'breadcrumbs_data' => $breadcrumbs_data]);
	}

	public function reportIncomes()
	{

		$desde = strftime("%Y-%m-%d",strtotime( Input::get('desde') ) );

		$hasta = strftime("%Y-%m-%d",strtotime( Input::get('hasta') ) );

		$neighbor_property_id = Input::get('neighbor_property_id');

		if ($neighbor_property_id == 'Todos') {
					$colonia = Session::get("colonia");
					$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
					$urbanismo = $urbanism->id;
					$neighbors_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
												 ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
												 ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
									   			 ->select('payments.id','payments.created_at','payments.amount','payments.coments','payments.collector_id' ,'neighbors.name','neighbors.last_name','sub_accounts.description')
												 ->where('neighbors_properties.urbanism_id', '=', $urbanismo)
												 ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
												 ->orderBy('created_at')
									   			 ->get();
		}else{

					$neighbors_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
					                             ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
					                             ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
					                             ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
					                             ->where('neighbor_property_id','=',$neighbor_property_id)
					                             ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
					                             ->get();

		}


		$data = ['payments' => $neighbors_payments, 'desde' => $desde, 'hasta' => $hasta, 'neighbor_property_id' => $neighbor_property_id];

		$pdf = PDF::loadView('dashboard.reports.incomes.pdf', $data);

		return $pdf->download('reporte_ingresos.pdf');
	}

	public function ajaxReportIncomes()
	{
		$desde = strftime("%Y-%m-%d",strtotime( Input::get('desde') ) );

		$hasta = strftime("%Y-%m-%d",strtotime( Input::get('hasta') ) );

		$neighbor_property_id = Input::get('neighbor_property_id');

		if ($neighbor_property_id == 'Todos') {
					$colonia = Session::get("colonia");
					$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();
					$urbanismo = $urbanism->id;
					$neighbors_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
												 ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
												 ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
									   			 ->select('payments.id','payments.created_at','payments.amount','payments.coments','payments.collector_id' ,'neighbors.name','neighbors.last_name','sub_accounts.description')
												 ->where('neighbors_properties.urbanism_id', '=', $urbanismo)
												 ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
												 ->orderBy('created_at')
									   			 ->get();

		}else{

					$neighbors_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
					                             ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
					                             ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
					                             ->select('payments.id','payments.collector_id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
					                             ->where('neighbor_property_id','=',$neighbor_property_id)
					                             ->whereBetween(DB::raw("DATE_FORMAT(payments.created_at,'%Y-%m-%d')"), [$desde, $hasta])
					                             ->get();
        }
		return View::make('dashboard.reports.incomes.tableReportsIncomes',['payments' => $neighbors_payments, 'desde' => $desde, 'hasta' => $hasta, 'neighbor_property_id' => $neighbor_property_id]);

	}

	public function statusReport()
	{

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$property_id = NeighborProperty::where('urbanism_id','=', $urbanismo)->pluck('id');

		$vigencia = date("Y-m");

      	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Decem");

		$today = date("Y-m-d");

		$ano = date("Y");

		$selano = Payment::select(DB::raw('DATE_FORMAT(payments.created_at,\'%Y\') as y'))
			->groupBy(DB::raw('Year(payments.created_at)'))
			->orderBy(DB::raw('Year(payments.created_at)'))
            ->get();

		$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();

		$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->orderBy('monthly_fee.created_at', 'ASC')->pluck('since');

		$mes_ini = (int) date("m",strtotime($monthly_ini));

		$cuotas = array();

		foreach ($monthly_all as $cuota_mensual){

					$ini = (int) date("m",strtotime($cuota_mensual->since));
					$fin = (int) date("m",strtotime($cuota_mensual->until));

					if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }

					for($i=$ini; $i<=$fin; $i++){

						$cuotas[$months[$i-1]] = $cuota_mensual->amount;
					}

		}


		$neighbors = NeighborProperty::with('Neighbors')
		                             ->where('urbanism_id','=',$urbanismo)
									  ->get();


		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
																														->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   																									->where('neighbors.user_id','=',self::getUserId())
					   																									->first();

		$breadcrumbs_data = $breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$urb_name."]";

		return View::make('dashboard.reports.status.index',[	 'cuotas'=>$cuotas,
																	 'mes_ini'=>$mes_ini,
																	 'months'=>$months,
																	 'selano'=>$selano,
																	 'urbanism'=>$urbanismo,
																	 'breadcrumbs_data' => $breadcrumbs_data,
																	 'neighbors' => $neighbors,
																	 'ini' => $ini,
																	 'fin' => $fin,
																	 'ano' => $ano,
																	 'breadcrumbs_data' => $breadcrumbs_data]);
	}

	public function ajaxReportStatus()
	{

	}

	public function reportStatus()
	{
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->name;

		$property_id = NeighborProperty::where('urbanism_id','=', $urbanismo)->pluck('id');

		$vigencia = date("Y-m");

      	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Decem");

		$today = date("Y-m-d");

		$ano = date("Y");

		$selano = Payment::select(DB::raw('DATE_FORMAT(payments.created_at,\'%Y\') as y'))
			->groupBy(DB::raw('Year(payments.created_at)'))
			->orderBy(DB::raw('Year(payments.created_at)'))
            ->get();

		$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();

		$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->orderBy('monthly_fee.created_at', 'ASC')->pluck('since');

		$mes_ini = (int) date("m",strtotime($monthly_ini));

		$cuotas = array();

		foreach ($monthly_all as $cuota_mensual){

					$ini = (int) date("m",strtotime($cuota_mensual->since));
					$fin = (int) date("m",strtotime($cuota_mensual->until));

					if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }

					for($i=$ini; $i<=$fin; $i++){

						$cuotas[$months[$i-1]] = $cuota_mensual->amount;
					}

		}


		$neighbors = NeighborProperty::with('Neighbors')
		                             ->where('urbanism_id','=',$urbanismo)
									  ->get();


		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
																														->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   																									->where('neighbors.user_id','=',self::getUserId())
					   																									->first();

		$breadcrumbs_data = $breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
		$data = ['mes_ini'=>$mes_ini,'months'=>$months,'cuotas'=>$cuotas,'selano'=>$selano, 'urbanism'=>$urbanismo,'breadcrumbs_data' => $breadcrumbs_data, 'neighbors' => $neighbors,'ini' => $ini,'fin' => $fin,'ano' => $ano, 'breadcrumbs_data' => $breadcrumbs_data];

		$pdf = PDF::loadView('dashboard.reports.status.pdf', $data);

		return $pdf->download('reporte_Estato_cuanta_general.pdf');


	}

	public function getUserId()
	{
		return Auth::user()->id;
	}

	public function getUserRol()
	{
		return Auth::user()->AssigmentRole[0]->role_id;
	}
}
