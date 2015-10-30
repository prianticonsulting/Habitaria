<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//=========================INDEX-LOGIN================================

Route::get('/', 			array('as' => 'login',			'uses' => 	'UsersController@login'));

//=========================/-INDEX-LOGIN================================


//=========================USERS================================
	
	
	Route::post('users/store', 	array('as' => 'users.store', 	'uses' =>	'UsersController@store'));
	Route::post('users/login', 												'UsersController@doLogin');
	Route::get('users/forgot_password',	array('as' => 'forgot',	'uses' => 	'UsersController@forgotPassword'));
	Route::post('users/forgot',												'UsersController@doForgotPassword');
	Route::get('users/reset_password/{token}', 								'UsersController@resetPassword');
	Route::post('users/reset_password', 									'UsersController@doResetPassword');
	Route::get('users/logout', 	array('as' => 'logout',	'uses' =>			'UsersController@logout',"before" => "auth"));
	Route::get('users/{id}', 												'UsersController@delete');
	Route::get('user/profile',  array('as' => 'user.profile', 	'uses' =>	'UsersController@profile'));
	Route::post('user/update/{id}',  array('as' => 'user.profile.update',	'uses' =>	'UsersController@profile_update'));
	Route::post('user/foto/perfil',			        array('as' => 'foto.perfil',	'uses' =>	'UsersController@fotoPerfil'));
//=========================/-USERS================================

//-------------GROUP ROUTES-------------

Route::group(array('prefix' => 'dashboard'), function()
{

	
//=========================/-HOME================================
	
	Route::get('home', array('before' => 'auth',	'as' => 'home', 'uses' =>	'HomeController@index'));
	
//=========================/-HOME================================
	
	Route::get('colonies/inactive', 			array('before' => 'auth',	'as' => 'colonies.inactive', 		'uses' =>	'ColonyController@index'));
	Route::get('colonies/active', 				array('before' => 'auth',	'as' => 'colonies.active', 			'uses' =>	'ColonyController@index_lic'));
	
	Route::get('suggestions', 	array('before' => 'auth',	'as' => 'suggestions', 	'uses' =>	'SuggestionController@sugerencias'));
	Route::get('suggestions_sent', 	array('before' => 'auth',	'as' => 'suggestions.sent', 	'uses' =>	'SuggestionController@sugerenciasEnviadas'));
	Route::get('suggestions_trash', 	array('before' => 'auth',	'as' => 'suggestions.trash', 	'uses' =>	'SuggestionController@sugerenciasPapelera'));
	Route::get('suggestions_view/{id_mensaje}', 	array('before' => 'auth',	'as' => 'suggestions.view', 	'uses' =>	'SuggestionController@sugerenciasView'));
	Route::get('suggestions_view_sent/{id_mensaje}', 	array('before' => 'auth',	'as' => 'suggestions.view.sent', 	'uses' =>	'SuggestionController@sugerenciasViewSent'));
	Route::post('suggestion/save', array("before" => "auth",'as' => 'suggestion.save', 'uses' =>	'SuggestionController@save'));
	Route::post('suggestion/mark_change', array("before" => "auth",'as' => 'suggestion.mark_change', 'uses' =>	'SuggestionController@markChange'));
	Route::post('suggestion/delete', array("before" => "auth",'as' => 'suggestion.delete', 'uses' =>	'SuggestionController@delete'));
	Route::post('suggestion/udtate_suggestion', array("before" => "auth",'as' => 'suggestion.udtate_suggestion', 'uses' =>	'SuggestionController@udtateSuggestion'));


	
	//=========================PROMOS================================	
	
	Route::get('promos', 						array('before' => 'auth', 	'as' => 'promos', 				'uses' =>	'PromoController@promos'));
	Route::get('promo/generate/{colony}', 		array('before' => 'auth', 	'as' => 'generate.promo', 		'uses' =>	'PromoController@index'));
	Route::post('promo/generate/store', 		array('before' => 'auth',	'as' => 'promo.create', 		'uses' =>	'PromoController@create'));
	Route::get('promo/report/{colony}', 		array('before' => 'auth',	'as' => 'promo.report', 		'uses' =>	'PromoController@report_promo'));
	Route::get('promo/cupon/{id}', 				array('before' => 'auth',	'as' => 'promo.cupon', 			'uses' =>	'PromoController@ver_cupon'));
	Route::get('promo/send/{id}', 				array('before' => 'auth',	'as' => 'promo.send', 			'uses' =>	'PromoController@send_cupon'));
	//=========================/-PROMOS================================

	//=========================LICENCIAS================================	
	
	Route::get('license', 							array('before' => 'auth', 	'as' => 'license', 				'uses' =>	'LicenseController@license'));
	Route::get('license/generate/{colony}', 		array('before' => 'auth', 	'as' => 'generate.license', 	'uses' =>	'LicenseController@index'));
	Route::post('license/generate/store', 			array('before' => 'auth',	'as' => 'license.create', 		'uses' =>	'LicenseController@create'));
	Route::get('license/report/{colony}', 			array('before' => 'auth',	'as' => 'license.report', 		'uses' =>	'LicenseController@report_license'));
	Route::get('license/cupon/{id}', 				array('before' => 'auth',	'as' => 'license.cupon', 		'uses' =>	'LicenseController@ver_cupon'));
	Route::get('license/send/{id}', 				array('before' => 'auth',	'as' => 'license.send', 		'uses' =>	'LicenseController@send_cupon'));
	//=========================/-LICENCIAS================================
	
	//=========================LOGS================================	
	
	Route::get('logs', 						array('before' => 'auth', 	'as' => 'logs', 				'uses' =>	'LogsController@index'));
	//=========================/-LOGS================================
});

//-------------/-GROUP ROUTES-------------



	
	
