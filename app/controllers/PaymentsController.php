<?php

class PaymentsController extends BaseController
{

    //~=================STATES=========================

    public function states_index()
    {

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$ano = date("Y");

		$vigencia = date("Y-m");

		$monthly_fee = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
						->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y-%m\')') , '=', $vigencia)
						->orderBy('monthly_fee.created_at', 'desc')->pluck('amount');

		$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();

		$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->orderBy('monthly_fee.created_at', 'ASC')->pluck('since');

		$mes_ini = (int) date("m",strtotime($monthly_ini));

		$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Decem");

		$cuotas = array();

		foreach ($monthly_all as $cuota_mensual){

				$ini = (int) date("m",strtotime($cuota_mensual->since));
				$fin = (int) date("m",strtotime($cuota_mensual->until));

				if($cuota_mensual->until == NULL){ $fin = (int) date("m"); }

				for($i=$ini; $i<=$fin; $i++){

						$cuotas[$months[$i-1]] = $cuota_mensual->amount;
				}

		}

		$neighbor = Neighbors::with('NeighborProperty')->where('user_id','=', $user_id)->get();

		foreach($neighbor as $vecino){
			 foreach ($vecino->NeighborProperty as $property){
				 if($property->urbanism_id == $urbanismo){
					 $property_id = $property->id;
				 }
			}
		}

		$balance = Balance::where('neighbor_property_id','=', $property_id)->pluck('amount');

		if($balance){
			$saldo = $balance;
		}else{
			$saldo = 0;
		}
		$payments_states = PaymentStates::where('neighbor_property_id','=',$property_id)
										->where('year','=',$ano)->get();


		$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

        return View::make('dashboard.payments.account_states.states',['payments' => $payments_states,
																	 'cuotas'=> $cuotas,
																	 'months'=>$months,
																	 'saldo'=>$saldo,
																	 'prueba'=>$user_id,
																	 'mes_ini'=>$mes_ini,
																	 'sobrante'=>0,
																	 'breadcrumbs_data' => $breadcrumbs_data]);
    }


	//~=================/STATES=========================

	//~=================RECORD=========================
    public function record_index()
    {
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
							 ->orderBy('payments.id', 'ASC')
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

        return View::make('dashboard.payments.record.index_record',[
																'payments' => $neighbor_payments,
																'breadcrumbs_data' => $breadcrumbs_data,
																'AssigmentRole' => $AssigmentRole,
																'total' => $total,
																'cuotas'=> $cuotas,
																'mes_ini'=>$mes_ini,
																'meses'=>$meses,
																'mes'=>$mes,
                                                                'urbanismo' => $urbanismo
															]);
    }

    public function delete($id) {
		try {
		$payment= Payment::findOrFail($id);
		$neighbor_property_id = $payment->neighbor_property_id;
		$amount =  $payment->amount;
		$mes= date("M");
		if ($payment->delete(['id'])) {
			$payment_states = PaymentStates::where('neighbor_property_id','=',$neighbor_property_id)->first();
			$payment_states->accumulated = $payment_states->accumulated - $amount;
			$payment_states->$mes = $payment_states->$mes - $amount;
			$payment_states->update(['id']);

			return Redirect::back()->with('error', false)->with('msg','Pago removido exitosamente.')
													->with('class', 'warning');
		}else{
			echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
		}


        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }
    }

	//~=================RECORD pagos vecinos=========================

     public function record_neighbors()
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

		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

        return View::make('dashboard.payments.neighbors.index',[	 'cuotas'=>$cuotas,
																	 'mes_ini'=>$mes_ini,
																	 'months'=>$months,
																	 'selano'=>$selano,
																	 'urbanism'=>$urbanismo,
																	 'breadcrumbs_data' => $breadcrumbs_data,
																	 'neighbors' => $neighbors,
																	 'ini' => $ini,
																	 'fin' => $fin,
																	 'ano' => $ano]);
    }
    //~=================/RECORD=========================

    public function modalEstadoCuenta()
    {
    	$neighbor_property_id = Input::get('neighbor_property_id');



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


		for($j=0; $j<=11; $j++){

					if($j+1 < $mes_ini){
							$saldoAnteriol[$j] = "";
							$cuataMes[$j] = "";
							$totalDebe[$j] = "";
							$pagos[$j] = "";
							$saldoTotal[$j] = "";

					}elseif ($j+1 <= date("m")) {

							$saldoAnteriol[$j] = $saldoTotal[$j-1];
							$cuataMes[$j] = -$cuotas[$months[$j]];
							$totalDebe[$j] = $saldoAnteriol[$j] + $cuataMes[$j];
							$neighbor_payments = PaymentStates::with('NeighborProperty')
															  ->where('neighbor_property_id','=',$neighbor_property_id)
															  ->first();
							if ($neighbor_payments) {
								$pagos[$j] =  $neighbor_payments->$months[$j] == NULL ? 0 :$neighbor_payments->$months[$j];
							}else{
								$pagos[$j] = 0;
							}

							$saldoTotal[$j] = ($totalDebe[$j]) + ($pagos[$j]);


					}elseif ($j+1 > date("m")) {

						$saldoAnteriol[$j] = "";
						$cuataMes[$j] = "";
						$totalDebe[$j] = "";
						$pagos[$j] = "";
						$saldoTotal[$j] = "";

					}
		}


			$neighbor= NeighborProperty::find($neighbor_property_id);
		return View::make('dashboard.payments.neighbors.table_neigbor', compact('breadcrumbs_data','saldoAnteriol','cuataMes','totalDebe','pagos','saldoTotal','mes_ini','ini','months','color','neighbor'));
    }

}
