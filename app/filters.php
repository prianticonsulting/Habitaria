<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

Route::filter("permiso",function($request,$response,$index)
{
	$permisos = Session::get("dato");
	if($permisos[$index]->state == 0){
		return "acceso denegado";
	}
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			$err_msg = '¡Acceso Denegado!';
			return Redirect::guest('/')->with('error', $err_msg);
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});


Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| ENTRUST Filter
|--------------------------------------------------------------------------
|
| 
|
*/	
//~Entrust::routeNeedsRole( 'dashboard*','admin',Redirect::to('users/logout'));
Entrust::routeNeedsRole( 'files*', 	array('admin','client'), Redirect::to('users/logout'), null, false );
Entrust::routeNeedsRole( 'events*', array('admin','driver'), Redirect::to('users/logout'), null, false );
