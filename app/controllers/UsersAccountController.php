<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
		$users	= User::with('AssigmentRole')->with('Neighbors')->paginate(10);

		return View::make('dashboard.users.index',['users'=> $users]);
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
				$repo = App::make('UserRepository');
				$user = $repo->signup(Input::all());

				if ($user->id) {
					try {
						if (Config::get('confide::signup_email')) {
							Mail::queueOn(
								Config::get('confide::email_queue'),
								Config::get('confide::email_account_confirmation'),
								compact('user'),
								function ($message) use ($user) {
									$message
										->to($user->email, $user->username)
										->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
								}
							);


						}

						$role = Role::where('name','=','admin')->first();
						$user->roles()->attach($role->id);

						$notice_msg = 'Tu cuenta ha sido creada satisfactoriamente. Revisa tu correo';

						 return Redirect::action('UsersController@login')->with('notice', $notice_msg);
					}

					catch (Exception $exc) {
					$userReg = User::findOrFail($user->id);
					$userReg->delete(['id']);

					return Redirect::back()->with('error', 'Falló envío de correo, intenta registrarte nuevamente');
				}

				} else {
					$error = $user->errors()->all(':message');

					return Redirect::back()->withInput(Input::except('password'))->with('error', $error);
				}
	}

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
        public function login()
    {

        $user = Auth::user();
        if(!empty($user->id)){
            return View::make('users.login');
        }

	 return View::make('users.login');
    }

	public function contacto()
    {
		$input = Input::all();

		$nombre  	=	Input::get('firstname');

		$contacto 		=	Input::get('email');

		$telefono 	=	Input::get('phone');

		$mensaje 	=	Input::get('texto');

		$asunto = "Contacto";

		$email = "info@prianticonsulting.com";

		$data= array(
				'email'				=> $email,
				'link'				=> 'ConfirmationController@confirm',
				'code'				=> "jhhjdhsdhhdsjhdsh",
				'nombre'     		=> $nombre,
				'contacto'			=> $contacto,
				'telefono'     		=> $telefono,
				'mensaje'         	=> $mensaje,
				'asunto'            => $asunto
				);

				Mail::send('emails.contacto',$data, function ($message) use($email,$asunto){
							$message->subject($asunto);
							$message->to($email);
				});

		$notice_msg = 'Mensaje Enviado';

		return Redirect::action('UsersController@login')->with('notice', $notice_msg);
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

		if ($repo->login($input)) {

		$usuario = UserNeighbors::where('email','=',$input['email'])->first();

		//Codigo de verificacion si es superAdmin
		$rol_admin = AssigmentRole::where('user_id','=',$usuario->id)
										->where('role_id','=',1)
										->first();

		if($rol_admin){
			return Redirect::route('admin.home');
		}
		//fin

		//codigo de verficacion si va a crear una colonia
		if(Input::get('crearColonia')==1){
			return Redirect::route('colony.create');
		}

		$neighbor = Neighbors::where('user_id','=', $usuario->id)->first();

			if($neighbor)
				{
					$colonies = Colony::select('colonies.id')
					   ->join('assigned_roles','colonies.id','=','assigned_roles.colony_id')
					   ->where('assigned_roles.user_id','=',$usuario->id)
					   ->first();

					Session::put('colonia', $colonies->id);

					$neighborP= NeighborProperty::where('neighbors_id','=',$neighbor->id)->first();
					if($neighborP)
					{
						//return Redirect::route('home');

						$Colonia = NeighborProperty::select(DB::raw('Count(neighbors_properties.urbanism_id) as total'))
						->where('neighbors_properties.neighbors_id','=',$neighbor->id)
						->get();

						$Colonia=$Colonia[0]->total;

						if ($Colonia > 1)
						{
							return Redirect::route('config.colony.sc');
						}
						else
						{		//cuando solo pertenece a una colonia el usuario

								$expiration = Expiration::where('colony_id','=',$colonies->id)->where('status','=',1)->first();

								Session::put('days_expiration', 0);
								Session::put('lic_fecha_expiration', 0);

								if($expiration){

									$datetime2 = new DateTime($expiration->expiration);
									$datetime1 = new DateTime(date('Y-m-d'));

									$interval = $datetime1->diff($datetime2);
									$days_expiration = $interval->format('%a');

									Session::put('days_expiration', $days_expiration);

									if($days_expiration <= 0){
										return Redirect::route('active.promo');
									}else{
										return Redirect::route('home');
									}

								}else{
										$lic_expiration = LicenseExpiration::where('colony_id','=',$colonies->id)->first();

										if($lic_expiration){

											$datetime2 = new DateTime($lic_expiration->expiration);
											$datetime1 = new DateTime(date('Y-m-d'));

											$interval = $datetime1->diff($datetime2);
											$days_expiration = $interval->format('%a');

											Session::put('lic_expiration', $days_expiration);
											Session::put('lic_fecha_expiration', $lic_expiration->expiration);

											if($days_expiration <= 0){
													return Redirect::route('active.license');
											}else{
												return Redirect::route('home');
											}

										}else{
											return Redirect::route('home');
										}
								}
						}
					}
					else
					{
						$urbanism = Urbanism::where('colony_id','=',$colonies->id)
					   ->first();

						return Redirect::action('NeighborController@admin_neighbor', array('admin_colonia' => $neighbor->id,'urbanismo' => $urbanism->id));
					}
				}
			else
				{
					$cod= $usuario->confirmation_code;
					return Redirect::action('ColonyController@wizard', array('code'=>$cod));
				}
        }

		else
		{
			$usuario     = UserNeighbors::where('email','=',$input['email'])->first();
			$usuarioInv  = InvitedNeighbors::where('email','=',$input['email'])->first();

			if(!$usuario && $usuarioInv)
			{
				$cod= $usuarioInv->confirmation_code;
				$conf= $usuarioInv->confirmed;

				if ($conf == 1)
				{
					$err_msg = 'No terminaste de llenar tus datos, debes confirmar tu cuenta nuevamente en tu correo';
					return Redirect::action('UsersController@login')
					->with('error', $err_msg);
				}
				else
				{
					$err_msg = 'Tu cuenta puede ser que no este confirmada. Comprueba tu e-mail para acceder al enlace de activación.';
					return Redirect::action('UsersController@login')
					->with('error', $err_msg);
				}
			}
			else
			{
				$pass = false;

				if ($repo->isThrottled($input)) {
					$err_msg = 'Demasiados intentos. Inténtalo de nuevo en unos minutos.';

				} elseif ($repo->existsButNotConfirmed($input)) {

					$user = UserNeighbors::where('email','=',$input['email'])->first();

					if (Config::get('confide::signup_email')) {
					Mail::queueOn(
						Config::get('confide::email_queue'),
						Config::get('confide::email_account_confirmation'),
						compact('user'),
						function ($message) use ($user) {
							$message
								->to($user->email, $user->username)
								->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
						}
						);
					}

					$err_msg = 'Tu cuenta puede ser que no esté confirmada. Comprueba tu e-mail para acceder al enlace de activación.';

				} else {
					$err_msg ='Email o contraseña incorrectos.';
					$pass =true;
				}

				return Redirect::action('UsersController@login')->withInput()
					->with('error', $err_msg)
					->with('recuperar_pass', $pass);
			}
		}
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make('users.forgot');
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
			$notice_msg = Lang::get('confide::confide.alerts.password_forgot');
           //$notice_msg='La información sobre el reinicio de su contraseña le ha sido enviada por e-mail.';
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
			//$error_msg = 'Usuario no encontrado.';
            return Redirect::action('UsersController@forgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make('users.reset')
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {

        Confide::logout();

        return Redirect::to('/');
    }

     public function delete($id) {
		try {
		$user = User::findOrFail($id);
		$user->delete(['id']);

		return Redirect::back()->with('error', false)->with('msg','<strong><i class="icon-remove"></i>Delete</strong> process completed!')
													->with('class', 'danger');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '<strong><i class="icon-remove"></i>Error!</strong> Edition process fails, contact with administrator')
									->with('class', 'warning');
        }
    }

	public function logs_index()
    {
		$user_id= Auth::user()->id;

		 $breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ','urbanisms.id as urbanism_id')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();

		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name;

        $urbanism = Urbanism::where('colony_id', '=', Session::get("colonia"))->first();

        $logs=Logs::where('urbanism_id','=',$breadcrumbs->urbanism_id)->orderBy('fecha', 'desc')->get();

		return View::make('dashboard.colonies.logs.index',['breadcrumbs_data' => $breadcrumbs_data, 'logs' => $logs, 'urbanismo' => $urbanism->Colony->name]);
    }

	 public function change_password() {
        try {

			$id =  Auth::user()->id;

			$user= UserNeighbors::findOrFail($id);
			$contraseñaActual = Input::get('password1');

            if (Hash::check($contraseñaActual, $user->password)) {

               	$user->password = Hash::make(Input::get('password2'));

				$user->update(['id']);

				return Redirect::back()->with('notice_modal','Cambio de contraseña éxitoso.');

			}else{
                return Redirect::back()->with('notice_modal','La Contraseña Actual no es la misma.');
            }


			} catch (Exception $exc) {

			echo $exc->getMessage() . " " . $exc->getLine();


			return Redirect::back()->with('error_modal', '¡Algo salió mal! No se pudo cambiar su contraseña.');
		}
	}


}
