<?php

class IncomesController extends BaseController
{

    //~=================CHARGES=========================

    public function charges_index()
    {

	$user_id= Auth::user()->id;

	$vigencia = date("Y-m");

	$ano = date("Y");

	$colonia = Session::get("colonia");

	$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

    $urbanismo = $urbanism->id;
    $urb_name = $urbanism->Colony->name;

	$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$urbanismo)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();

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

	$j = (int) date("m");

	$monthly_fee = $cuotas[$months[$j-1]];

	$account =   SubAccount::where('urbanism_id','=',$urbanismo)
							   ->where('description','=','Pago de cuota mensual')
							   ->pluck('id');

	$neighbors= NeighborProperty::where('urbanism_id','=',$urbanismo)->get();

	$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();

	$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

        return View::make('dashboard.incomes.charges.index',
						['neighbors' => $neighbors,
						'account'=>$account,
						'monthly_fee'=> $monthly_fee,
						'breadcrumbs_data' => $breadcrumbs_data]);
    }

	public function register_charges()
    {

		$user_id= Auth::user()->id;

		$user= Neighbors::where('user_id','=', $user_id)->first();

		$attendant	 =  Neighbors::with('NeighborProperty')->findOrFail($user->id);

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$sub_accounts= SubAccount::where('account_id','=',1)->where('urbanism_id','=',$urbanismo)
								->where('description','!=','Pago de cuota mensual')
								->get();

		$neighbors= NeighborProperty::where('urbanism_id','=',$urbanismo)->get();

		return View::make('dashboard.incomes.register_charges',['sub_accounts'=>$sub_accounts,
													  'urbanism' => $urb_name,
													  'neighbors' => $neighbors,
													  'attendant'=>$attendant]);
    }

	public function incomes_store()
    {
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$collector	=   Collector::where('user_id','=',$user_id)->where('urbanism_id','=',$urbanism->id)->first();

        $neighbor	=   Input::get('valorid');

		$amount		=	Input::get('amount');

		$subAccount =   Input::get('sub_account_id');

		$income_charge= new Payment;

		$income_charge->neighbor_property_id= $neighbor;
		$income_charge->collector_id		= $collector->id;
		$income_charge->amount				= $amount;
		$income_charge->sub_account_id		= $subAccount;
		$income_charge->deposit				= null;
		$income_charge->debt				= null;
		$income_charge->status_id			= 1;
		$income_charge->updated_at			= date('Y').'-01-01 '.date('H:i:s');

		$infoPagador 	= NeighborProperty::where('id','=',$neighbor)->first();

		$tipoUrb = $infoPagador->Urbanism->UrbanismType->id;

			if($tipoUrb == 3)
			{
				$Domicilio = "Piso ".$infoPagador->Building->description.' - Apartamento '.$infoPagador->num_house_or_apartment;
			}
			else
			{
				$Domicilio = "Calle ".$infoPagador->Street->name.' - Casa '.$infoPagador->num_house_or_apartment;
			}

		if($income_charge->save()){

			//logs
						Event::fire('logs','hizo un Cobro al Domicilio '.$Domicilio.' de un Monto de'.$amount);
			//fin logs
						 return Redirect::action('IncomesController@register_charges')->with('error', false)
											   ->with('msg','Cobro ingresado con éxito.')
											   ->with('class', 'info');

		}else {

			return Redirect::back()->with('error', true)
                    ->with('msg', '¡Algo salió mal! Contacte con administrador.')
                    ->with('class', 'danger');

		}

    }

	public function charges_balances()
    {
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$neighbors= NeighborProperty::with('Neighbors')
					->where('urbanism_id','=',$urbanismo)->get();

		$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";


        return View::make('dashboard.incomes.charges.balances',
						['neighbors' => $neighbors,
						'breadcrumbs_data' => $breadcrumbs_data]);
    }

	public function MostrarEstadoCuenta ()
	{

		$neighbor = Input::get("id");

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanismo = $urbanism->id;

		$ano = date("Y");

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

		$payments_states = PaymentStates::where('neighbor_property_id','=',$neighbor)
										->where('year','=',$ano)->get();

		$balance = Balance::where('neighbor_property_id','=', $neighbor)->pluck('amount');

		if($balance){
			$saldo = $balance;
		}else{
			$saldo = 0;
		}

		return View::make('dashboard.incomes.charges.states_ajax')
					->with(['payments' => $payments_states,
							'cuotas'=> $cuotas,
							'mes_ini'=>$mes_ini,
							'saldo'=>$saldo,
							'months'=>$months,
						    'sobrante'=>0,
					]);

	}

	public function charges_save_balance()
    {
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$collector	=  Collector::where('user_id','=',$user_id)->where('urbanism_id','=',$urbanism->id)->pluck('id');

        $neighbor	=  Input::get('valorid');

		$amount		=	Input::get('saldo');

		$balance = Balance::where('neighbor_property_id','=',$neighbor)
                                        ->orderBy('created_at', 'desc')->first();
        try
		{
			if(!$balance)
				{
					$balance_charge= new Balance;
					$balance_charge->collector_id            = $collector;
					$balance_charge->neighbor_property_id    = $neighbor;
					$balance_charge->amount                    = $amount;
					$balance_charge->coments                = Input::get('coments');
					$balance_charge->save();
				}

			else
				{
					$balance->amount      = $amount;
					$balance->coments     = Input::get('coments');
					$balance->updated_at  = date('Y-m-d').date('H:i:s');
					$balance->update(['id']);
				}

				return Redirect::action('IncomesController@charges_balances')->with('error', false)
									   ->with('msg','Saldo ingresado con éxito.')
									   ->with('class', 'info');

		}

        catch (Exception $exc)
            {
                    return Redirect::back()->with('error', true)
                                ->with('msg', '¡Algo salió mal! Contacte con el administrador.')
                                ->with('class', 'danger');
            }
	}

    public function charges_store()
    {

		$user_id	= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$collector	=  Collector::where('user_id','=',$user_id)->where('urbanism_id','=',$urbanism->id)->first();

		$ano = date("Y");

        $neighbor	=  Input::get('valorid');

		$amount=Input::get('amount');

		$income_charge= new Payment;

		$income_charge->neighbor_property_id= $neighbor;
		$income_charge->collector_id		= $collector->id;
		$income_charge->amount				= $amount;
		$income_charge->sub_account_id		= Input::get('sub_account_id');
		$income_charge->coments             = Input::get('coments');
		$income_charge->deposit				= null;
		$income_charge->debt				= null;
		$income_charge->status_id			= 1;
		$income_charge->updated_at			= date('Y').'-01-01 '.date('H:i:s');


		if($income_charge->save()){

			$neighbor_payments = $income_charge;

			$payment_state = PaymentStates::where('neighbor_property_id','=',$neighbor)
										->where('year', '=', $ano)
										->orderBy('created_at', 'desc')->first();

			$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

			$monthly_all = MonthlyFee::where('monthly_fee.urbanism_id','=',$collector->urbanism_id)
										->where(DB::raw('DATE_FORMAT(monthly_fee.since,\'%Y\')') , '=', $ano)
										->get();

			$monthly_ini = MonthlyFee::where('monthly_fee.urbanism_id','=',$collector->urbanism_id)
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

			$acumulado=$amount; //para guardar el monto
			$ValorInicial=$amount; //para guardar el valor inicial del monto ingresado
			$ValorResto=0; //para comparar con el valor inicial

			$balance = Balance::where('neighbor_property_id','=', $neighbor)->pluck('amount');

			$balance_saldo = Balance::where('neighbor_property_id','=', $neighbor)->first();

			if($balance){

				$saldo = $balance;

					if( $saldo > $amount){

					$saldo = $saldo - $amount;
					$amount = 0;

					$balance_saldo->amount = $saldo;
					$balance_saldo->update(['id']);

					}else{
						if($saldo < $amount){
							$saldo = $amount - $saldo;
							$amount = $saldo;
							$balance_saldo->delete(['id']);
						}else{
							$saldo = 0;
							$amount = 0;
							$balance_saldo->delete(['id']);
						}
					}
			}else{
				$saldo = 0;
			}


			//Si el usuario no ha realizado ningún pago, se llena la tabla Payment_States por primera vez
			if(!$payment_state){

				$TotalCuotas = 0;

				$payment_state_detail= new PaymentStates;

				$payment_state_detail->neighbor_property_id= $neighbor_payments->neighbor_property_id;

				$payment_state_detail->year = date('Y', strtotime( $neighbor_payments->created_at));

				//Ciclo hasta el mes actual
				for($i=$mes_ini-1; $i < date('m'); $i++){

						if( date('m') != $i+1 ){

							if($amount > $cuotas[ $months[$i] ] ){

								$payment_state_detail->$months[$i] = $cuotas[ $months[$i] ];

								$amount = $amount - $cuotas[ $months[$i] ];

							}
							else
							{
									if( $amount <  $cuotas[ $months[$i] ] && $amount != 0)
									{

										$payment_state_detail->$months[$i] = $amount;

										$amount = 0;

									}
									else
									{
											$payment_state_detail->$months[$i] = $cuotas[ $months[$i] ];

											$amount = 0;

									}
							}


						}else{//si es el mes actual

							// for: suma todas las cuotas de cada mes, las q se deben
							for($j=$mes_ini-1; $j < date('m'); $j++){
								if($payment_state_detail->$months[$j] == null){
								$TotalCuotas = $TotalCuotas + $cuotas[ $months[$j] ];
								}elseif($payment_state_detail->$months[$j] < $cuotas[ $months[$j] ] && $payment_state_detail->$months[$j] > 0){
									$resto_mes= $cuotas[ $months[$j] ] - $payment_state_detail->$months[$j];
									$TotalCuotas = $TotalCuotas + $resto_mes;
								}
							}

								if($TotalCuotas > $amount){

										$TotalCuotas = $TotalCuotas - $amount;

										$payment_state_detail->$months[$i]= "-".$TotalCuotas;


									}elseif($TotalCuotas < $amount ){

													$TotalCuotas = $amount - $TotalCuotas;

													$payment_state_detail->$months[$i]= $cuotas[ $months[$i] ] + $TotalCuotas;

													$amount = $TotalCuotas;

										}elseif($TotalCuotas == $amount){
												//si la cuota es igual al monto que esta pagando

													$payment_state_detail->$months[$i]= $cuotas[ $months[$i] ];

													$amount = 0;
										}

						}

				}//fin del ciclo

				$payment_state_detail->accumulated = $acumulado;

				//Se guardan los datos en Payment_States
				$payment_state_detail->save();

			}else{
			//si ya tiene registros en payment_state

				$fondo 		= $payment_state->accumulated + $amount;
				$valorResto	= 0;
				$abono 		= 0;

				for($i=$mes_ini-1; $i < date('m') ; $i++){

						if(date('m') != $i+1)
						{
								if($payment_state->$months[$i]){

									if($payment_state->$months[$i] != $cuotas[ $months[$i] ] && $payment_state->$months[$i] > 0 )
									{


											$valorResto = $ValorResto + $payment_state->$months[$i];

											$amount = $amount + $valorResto;

											if($amount > $cuotas[ $months[$i] ] ){

												$payment_state->$months[$i] = $cuotas[ $months[$i] ];

												$amount = $amount - $cuotas[ $months[$i] ];

											}
											else{

												$payment_state->$months[$i] = $amount;

												$amount = 0;
											}

									}

								}
								else
								{
										if( $amount > $cuotas[ $months[$i] ] ){

											$payment_state->$months[$i] = $cuotas[ $months[$i] ];

											$amount = $amount - $cuotas[ $months[$i] ];

										}
										else
										{

											if($amount < $cuotas[ $months[$i] ] ){

												$payment_state->$months[$i] = $amount;

												$amount = 0;

											}
												//se cumple cuando el amount es igual a la cuota vigente
											else
											{
												$payment_state->$months[$i] = $cuotas[ $months[$i] ];

												$amount = 0;
											}
										}
								}

						}
						else
						{   //si es el mes actual

							if($payment_state->$months[$i] < 0){

								$deuda = -1*(	$payment_state->$months[$i]	);

								$deuda = $amount - $deuda ;

								if($deuda < 0){

									$payment_state->$months[$i] = $deuda;

								}else{
									if($deuda == 0){

										$payment_state->$months[$i] = $cuotas[ $months[$i] ];

									}else{

										$payment_state->$months[$i] = $deuda + $cuotas[ $months[$i] ];

									}

								}
							}else{

								$abono = $payment_state->$months[$i] + $amount;

								$payment_state->$months[$i] = $abono;

							}
						}
				}

				$payment_state->accumulated = $fondo;
				$payment_state->update(['id']);

			}


	//---envio por email de recibo al pagador---

			$mensaje = null;

			$monto = Input::get('amount');

			$infoCobrador = Neighbors::with('NeighborProperty')
								->where('user_id','=',$user_id)->first();

			$infoPagador    = NeighborProperty::where('id','=',$neighbor)->first();

			$email 		= UserNeighbors::where('id','=',$infoPagador->Neighbors->user_id)->pluck('email');

			$tipoUrb = $infoPagador->Urbanism->UrbanismType->id;

			if($tipoUrb == 3)
			{
				$Domicilio = "Piso ".$infoPagador->Building->description.' - Apartamento '.$infoPagador->num_house_or_apartment;
			}
			else
			{
				$Domicilio = "Calle ".$infoPagador->Street->name.' - Casa '.$infoPagador->num_house_or_apartment;
			}

			$Colony	 =  Urbanism::with('Colony.City')->where('id','=',$infoPagador->Urbanism->id)->first();

			$state		 =  DB::table('states')->where('id', $Colony->Colony->City->state_id)->first();

			$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

			$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

			$pay_states = PaymentStates::where('neighbor_property_id','=',$neighbor)
										->where('year','=',$ano)->get();


			$data= array(
				'Cobrador'				=> $infoCobrador->name." ".$infoCobrador->last_name,
				'Nombre'				=> $infoPagador->Neighbors->name." ".$infoPagador->Neighbors->last_name,
				'Domicilio'				=> $Domicilio,
				'monto'				    => $monto,
				'Fecha'				    => $fecha,
				'colonia'				=> $Colony->Colony->name,
				'urbanismo'				=> $infoPagador->Urbanism->name,
				'estado'				=> $state->name,
				'ciudad'			    => $Colony->Colony->City->name,
				'payments'				=> $pay_states,
				'months'				=> $months,
				'cuotas'				=> $cuotas,
				'mes_ini'				=> $mes_ini,
				);
			try
			{
				Mail::send('emails.Recibo', $data, function($message) use ($email)
				{
					$message->to($email);
					$message->subject('Recibo de pago');
				});
			}

			catch (Exception $exc) {
					Mail::send('emails.Recibo', $data, function($message) use ($email)
					{
						$message->to($email);
						$message->subject('Recibo de pago');
					});
				}
		// ---/fin de envio por email de recibo al pagador/----


		//se agrego el logs
						Event::fire('logs','hizo un Cobro al Domicilio '.$Domicilio.' de un Monto de'.$monto);
		//fin logs
						 return Redirect::action('IncomesController@charges_index')->with('error', false)
											   ->with('msg','Cobro ingresado con éxito.')
											   ->with('class', 'info');

		}else {

			return Redirect::back()->with('error', true)
                    ->with('msg', '¡Algo salió mal! Contacte con administrador.')
                    ->with('class', 'danger');

		}

    }

    public function catologo_ingreso()
	{
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$catalog =  SubAccount::where('urbanism_id','=',$urbanism->id)
							   ->where('account_id','=',1)
							   ->orderBy('id', 'ASC')->get();

	   $breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";

        return View::make('dashboard.incomes.catalog',['usuario'=>$breadcrumbs_data,
													   'urbanism_id' => $urbanism->id,
													   'catalog' 	  =>  $catalog]);
	}


    public function record_index()
    {
		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");
		$AssigmentRole= Auth::user()->AssigmentRole[0]->role_id;

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urb_name = $urbanism->Colony->name;

		$collector = Collector::where('user_id','=',$user_id)->where('urbanism_id','=',$urbanism->id)->first();

		$collector_neighbor = Neighbors::where('user_id','=',$user_id)->first();

		$collector_properties =	NeighborProperty::where('neighbors_id','=',$collector_neighbor->id)->pluck('id');

		$neighbors_payments = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
									 ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
									 ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
						   			 ->select('payments.id','payments.created_at','payments.amount','payments.coments','neighbors.name','neighbors.last_name','sub_accounts.description')
									 ->where('neighbors_properties.urbanism_id', '=', $urbanism->id)
									 ->orderBy('created_at')
						   			 ->get();

		$breadcrumbs= Neighbors::with('NeighborProperty')
					->where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [".$urb_name."]";

        return View::make('dashboard.incomes.record.index',[
																'incomes' => $neighbors_payments,
																'breadcrumbs_data' => $breadcrumbs_data,
																'AssigmentRole' => $AssigmentRole,
																'total' => 0]);
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

				return Redirect::back()->with('error', false)->with('msg','Ingreso removido exitosamente.')
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

    public function delete_catalog($id) {
		try {
		$account= SubAccount::findOrFail($id);
		$account->delete(['id']);

		return Redirect::back()->with('error', false)->with('msg','Categoria removida exitosamente.')
													->with('class', 'warning');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }
    }

	public function edit_catalog()
	{

		$id = Input::get('pk');
		$value = Input::get('value');

		$account = SubAccount::where('id','=',$id)->first();
		$account->description	= $value;

		if($account->save())
        return Response::json(array('id'=>$id, 'msg'=>'Datos guardados exitosamente'));
		else
        return Response::json(array('id'=>$id, 'msg'=>'Error al tratar de guardar los datos'));

	}

	public function catalog_store()
	{

		$data=Input::all();

		$category= new SubAccount;
		$category->account_id	= 1;
		$category->urbanism_id	= Input::get('urbanism');
		$category->description	= Input::get('categoria');

		$notice_msg = 'Categoria creada exitosamente';

		if($category->save())	{

			return Redirect::back()->with('error', false)
								->with('msg', $notice_msg)->with('class', 'info');

		}else{
				return Redirect::back()->with('error', true)
											->with('msg', '¡Algo salió mal! Contacte con administrador')
											->with('class', 'danger');
		}

	}

	//~=================/CHARGES=========================


}
