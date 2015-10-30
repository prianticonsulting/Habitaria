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
    
    public function edit($id) {

		$user= User::with('AssigmentRole')->with('Neighbors')->findOrFail($id);
		$status= Status::all();
		$roles = Role::all();
		
		return View::make('dashboard.users.edit',['row'=> $user, 'status'=> $status, 'roles'=> $roles]);	 
    }


     public function update($id) {
        try {

			$user= User::findOrFail($id);
			
			$user->status_id	= Input::get('status');
			$user->updated_at	= new DateTime;
			$roles_id	= count(Input::has('roles'))? Input::get('roles'): array();
			
			$user->update(['id']);
	
				
			return Redirect::route('users')->with('error', false)
											->with('msg','Usuario actualizada con éxito.');
			
			} catch (Exception $exc) {

			echo $exc->getMessage() . " " . $exc->getLine();
			
			
			return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador.')
									->with('class', 'danger');
		}
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
            if (Config::get('confide::signup_email')) {
                Mail::queue(
                    'emails.confirm_admin',
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
        $repo 	= App::make('UserRepository');
        $input  = Input::all();

        if ($repo->login($input)) {
            
			return Redirect::route('home');
			
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
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
            return Redirect::action('ColonyController@config_index')
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
            $notice_msg = 'La información sobre el reinicio de su contraseña le ha sido enviada por e-mail.';
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            //$error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
			$error_msg = 'Usuario no encontrado.';
            return Redirect::action('UsersController@doForgotPassword')
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
        return View::make(Config::get('confide::reset_password_form'))
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
        session_destroy();
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
	
   public function change_password() {
        try {
			
			$id =  Auth::user()->id;
			
            $contraseñaActual = Input::get('password1');
            
            $user= User::findOrFail($id);

            if (Hash::check($contraseñaActual, $user->password)) {
                echo "si es";
                die();
			}else{
                echo "no es";
                die();
            }
			
			$user->password = Hash::make(Input::get('password2'));
			
			$user->update(['id']);
					
			return Redirect::back()->with('notice_modal','Cambio de contraseña éxitoso.');
			
			} catch (Exception $exc) {

			echo $exc->getMessage() . " " . $exc->getLine();
			
			
			return Redirect::back()->with('error_modal', '¡Algo salió mal! No se pudo cambiar su contraseña.');
		}
	}

}