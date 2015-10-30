
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
		$users	= User::with('AssigmentRole')->paginate(10);
	
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
						
						$notice_msg = 'Su cuenta ha sido creada satisfactoriamente. Revisa tu correo';
						
						 return Redirect::action('UsersController@login')->with('notice', $notice_msg);
					}
					
					catch (Exception $exc) {
					$userReg = User::findOrFail($user->id);
					$userReg->delete(['id']);
					
					return Redirect::back()->with('error', 'Falló envío de correo, intente registrarse nuevamente');
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
	
			
			$usuario = User::where('email','=',$input['email'])->first();
			
			//Codigo de verificacion si es superAdmin
			$rol_admin = AssigmentRole::where('user_id','=',$usuario->id)
											->where('role_id','=',1)
											->first();
			
			if($rol_admin){
				
				return Redirect::route('home');
				
			}else{
				
				$err_msg ='No tiene los permisos para acceder como administrador.';
				return Redirect::action('UsersController@login')
					->with('error', $err_msg);
			}
		}
		else 
		{						
				if ($repo->isThrottled($input)) {
					$err_msg = 'emasiados intentos. Inténtelo de nuevo en unos minutos.';
					
				} elseif ($repo->existsButNotConfirmed($input)) {
					
					$user = User::where('email','=',$input['email'])->first();
					
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
					
					$err_msg = 'Su cuenta puede ser que no este confirmada. Compruebe su e-mail para acceder al enlace de activación.';
					
				} else {
					$err_msg ='Usuario, e-mail o contraseña incorrectos.';
				}

				return Redirect::action('UsersController@login')
					->with('error', $err_msg);

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
	
    public function profile()
    {
		$user_id = Auth::user()->id;
		
		$user_data =  Data_users::where('user_id','=',$user_id)->first();
		
		$role	 		= AssigmentRole::where('user_id','=',$user_id)->first();
		$user_role	= ucfirst($role->Role->name);
		
		
        return View::make('users.profile',[
														 'role' =>$user_role,														  
														 'user'=>$user_data]);
    }

    public function fotoPerfil($value='')
    {

        if (Request::ajax())
        {
            $file = Input::file('photo');
            $correo = Auth::user()->email;
        
            if(!is_dir("uploads/users/avatars/")) {
                    mkdir("avatars/", 0777);
            }

            $file->move("uploads/users/avatars/",Auth::user()->email);
        }
           
    }
}
