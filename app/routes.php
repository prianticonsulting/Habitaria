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

//============ Bloque excepciones

// App::error(function($exception, $code)
// 	{
// 		switch ($code)
// 		{
// 			case 404:
// 			return Response::view('users.admin404');
//
// 			case 500:
//             return Response::view('users.admin500');
//
// 			default:
//             return Response::view('users.login');
// 		}
// 	});

//============INDEX


	Route::get('contract', array('as' => 'contract', function(){

		return View::make('users.contract');
	}));

	Route::get('test', array('as' => 'neighbor.register', function(){

		return View::make('emails.create');
	}));

	Route::get('users/register',  array('as' => 'users.registro', function(){

		return View::make('users.registro');
	}));

	Route::get('users/colony/login',  array('as' => 'users.registro.admin', function(){

		return View::make('users.login2');
	}));

//----- Roles --------
	Route::get("dashboard/rol/create",array("before" => "auth|permiso:9", "as" => "create","uses" => "RolesController@vistaCrear"));
	Route::get("dashboard/rol/assign",array("before" => "auth|permiso:10","as" => "assign","uses" => "RolesController@vistaAsignar"));
	Route::get("dashboard/rol/permits",array("before" => "auth|permiso:11","as" => "permits","uses" => "RolesController@vistaPermisos"));
	Route::post("dashboard/rol/cambiarpermisos", array("before" => "auth", "uses" => "RolesController@cambiarPermisos"));
	Route::post("dashboard/rol/cambiartablapermisos", array("before" => "auth", "uses" => "RolesController@tablaRolesPermiso"));
	Route::post("dashboard/rol/crearrol", array("before" => "auth", "uses" => "RolesController@crearRol"));
	Route::post("dashboard/rol/asignarrol", array("before" => "auth", "uses" => "RolesController@asignarRol"));
	Route::post("dashboard/rol/eliminarrol", array("before" => "auth", "uses" => "RolesController@eliminarRol"));

//------end Roles -------

//----- Reports --------

	Route::get("dashboard/reports/cities", array("before" => "auth","as" => "cities", "uses" => "ReportCitiesController@VerListaStates"));
	Route::post("dashboard/reports/cities/show-report", array("before" => "auth","uses" => "ReportCitiesController@GeneraReporte"));
	Route::get("dashboard/reports/payments", array("before" => "auth","as" => "payments", "uses" => "ReportsController@GeneraReportePagos"));

//----- Reportes -----
	Route::post('dashboard/reports/generate-pdf-payments',['as'=> 'generate.pdf.payments','uses'=>'ReportsController@reportPayments']);
	Route::post('dashboard/reports/generate-pdf-incomes',['as'=> 'generate.pdf.incomes','uses'=>'ReportsController@reportIncomes']);
	Route::post('dashboard/reports/generate-pdf-status',['as'=> 'generate.pdf.status','uses'=>'ReportsController@reportStatus']);
	Route::post('dashboard/reports/ajax-generate-payments','ReportsController@ajaxReportPayments');
	Route::post('dashboard/reports/ajax-generate-incomes',[ 'as' => 'ajax-generate-incomes', 'uses' => 'ReportsController@ajaxReportIncomes']);
	Route::post('dashboard/reports/ajax-generate-status',[ 'as' => 'ajax-generate-status', 'uses' => 'ReportsController@ajaxReportStatus']);
	Route::get('dashboard/reports/incomes', ["before" => "auth","as" => "reports.incomes", "uses" => "ReportsController@incomesReport"]);
	Route::get('dashboard/reports/status', [ 'as' => 'reportes.status', 'uses' =>'ReportsController@statusReport' ]);
	Route::get('dashboard/reports', ["before" => "auth","as" => "reports", "uses" => "ReportsController@getIndex"]);

//------end Roles -------

//============
	Route::post("usuario",						array("uses" => "UsuarioController@com"));
	Route::get("emailUser",						array("uses" => "UsuarioController@uniqueEmail"));
	Route::post("edit/catalog_building",	array("before" => "auth","uses" => "ColonyController@edit_building"));
	Route::post("edit/catalog_streets",	    array("before" => "auth","uses" => "ColonyController@edit_streets"));
	Route::post("incomes/catalog/edit",		array("before" => "auth","uses" => "IncomesController@edit_catalog"));
	Route::post("expenses/catalog/edit",		array("before" => "auth","uses" => "ExpensesController@edit_catalog"));
//
// Confide routes

	Route::post('users/store', 	array('as' => 'users.store', 	'uses' =>	'UsersController@store'));

	Route::get('/', 			array('as' => 'login',			'uses' => 	'UsersController@login'));
	Route::post('users/login', 												'UsersController@doLogin');
	Route::post('users/contacto',  array('as' => 'users.contacto',	'uses' => 	'UsersController@contacto'));
	Route::get('users/confirm/{code}',										'ColonyController@wizard');
	Route::get('users/colony/create',	array("before" => "auth",'as' => 'colony.create',	'uses' => 	'ColonyController@get_wizard'));
	Route::get('users/forgot_password',	array('as' => 'forgot',	'uses' => 	'UsersController@forgotPassword'));
	Route::post('users/forgot',												'UsersController@doForgotPassword');
	Route::get('users/reset_password/{token}', 								'UsersController@resetPassword');
	Route::post('users/reset_password', 									'UsersController@doResetPassword');
	Route::get('users/logout', 	array('as' => 'logout',	'uses' =>			'UsersController@logout',"before" => "auth"));
	Route::get('users/{id}', 												'UsersController@delete');
	Route::post('incomes/store',  	array("before" => "auth",'as' => 'income.store','uses' =>	'IncomesController@store_index'));

	Route::get('listStates',												'ColonyController@getStates');
	Route::get('listCities', 												'ColonyController@getCities');

//

Route::group(array('prefix' => 'dashboard'), function()
{
//BACK-END ROUTS

	Route::get('home', array("before" => "auth",'as' => 'home', 'uses' =>	'HomeController@index'));
	Route::post('suggestion/save', array("before" => "auth",'as' => 'suggestion.save', 'uses' =>	'SuggestionController@save'));
	Route::get('config/colony/suggestions_view/{id_mensaje}', 	array('before' => 'auth',	'as' => 'config.colony.suggestions.view', 	'uses' =>	'SuggestionController@sugerenciasView'));
	Route::get('config/colony/suggestions_sent', 	array('before' => 'auth',	'as' => 'config.colony.suggestions.sent', 	'uses' =>	'SuggestionController@sugerenciasEnviadas'));
	Route::get('config/colony/suggestions_view_sent/{id_mensaje}', 	array('before' => 'auth',	'as' => 'config.colony.suggestions.view.sent', 	'uses' =>	'SuggestionController@sugerenciasViewSent'));
	Route::post('config/colony/suggestion/mark_change', 	array('before' => 'auth',	'as' => 'suggestion.mark_change', 	'uses' =>	'SuggestionController@markChange'));
	Route::post('config/colony/suggestion/delete', 	array('before' => 'auth',	'as' => 'suggestion.delete', 	'uses' =>	'SuggestionController@delete'));
	Route::any('config/colony/suggestion/update_suggestion', 	array('before' => 'auth',	'as' => 'suggestion.update', 	'uses' =>	'SuggestionController@udtateSuggestion'));
	Route::get('config/colony/suggestion_trash', 	array('before' => 'auth',	'as' => 'config.colony.suggestions.trash', 	'uses' =>	'SuggestionController@sugerenciasPapelera'));


    Route::get(
        'colony-suggestion',
        ['before' => 'auth',
         'as'     => 'suggestions',

            function () {
                return View::make('dashboard.colonies.suggestions.thread_view');
            }
        ]
    );


	//-----super admin directory----
	Route::get('admin/home', array("before" => "auth",'as' => 'admin.home', 'uses' =>	'HomeAdminController@index'));
	Route::get('admin/colonies', array("before" => "auth",'as' => 'admin.colonies', 'uses' =>	'HomeAdminController@colonies_index'));
	Route::get('admin/promo', array("before" => "auth",'as' => 'admin.promo', 'uses' =>	'HomeAdminController@promo_index'));
	//----/super admin directory----

	//{
		//return View::make('dashboard.home');
	//}));

	//USERS DIRECTORY
	Route::get('users', array('as' => 'users',  					'uses' =>	'UsersController@index'));

	Route::get('user/edit/{id}',				array('as' => 'user.edit',				'uses' => 	'UsersController@edit'));
	Route::post('user/edit/{id}',				array('as' => 'user.update',			'uses' =>	'UsersController@update'));
	Route::post('user/password/change',			array('as' => 'user.change.password',	'uses' =>	'UsersController@change_password'));
	Route::get('User/{id}',												  		'UsersController@delete');


	//----- seguridad --------
	Route::get('user/logs',			array('before' => 'auth|permiso:22','as' => 'logs',		'uses' => 	'UsersController@logs_index'));
	//-----/seguridad --------

	//
	//Colonies
	Route::get('colonies',  		array("before" => "auth",'as' => 'colonies', 		'uses' =>	'ColonyController@index'));
	Route::get('colony/create',  	array("before" => "auth",'as' => 'colony.crear', 'uses' =>	'ColonyController@create'));
	Route::post('colony/store',  	array("before" => "auth",'as' => 'colony.store', 	'uses' =>	'ColonyController@store'));

	Route::get('colony/info/{id}',	array("before" => "auth",'as' => 'colony.info',	'uses' => 	'ColonyController@info'));

	Route::get('colony/edit/{id}',	array("before" => "auth",'as' => 'colony.edit',	'uses' => 	'ColonyController@edit'));
	Route::post('colony/edit/{id}', array("before" => "auth",'as' => 'colony.update',	'uses' =>	'ColonyController@update'));

	Route::get('colony/{id}',												  	'ColonyController@delete');

	Route::get('colony/active/promo',  array("before" => "auth",'as' => 'active.promo', function(){

		return View::make('dashboard.colonies.admin.promo');
	}));

	Route::get('colony/active/license',  array("before" => "auth",'as' => 'active.license', function(){

		return View::make('dashboard.colonies.admin.license');
	}));

	Route::post('colony/promo/active', array("before" => "auth",'as' => 'promo.store',	'uses' =>	'PromoController@promo_store'));
	Route::get("promo/unique",				array("uses" => "PromoController@uniquePromo"));

	Route::post('colony/license/active', array("before" => "auth",'as' => 'license.store',	'uses' =>	'LicenseController@license_store'));
	//


	//================USERS===========================================

	//================/USERS===========================================

	//================PAYMENTS===========================================

		Route::get('account-states',  		array('before' => 'auth|permiso:0','as' => 'account.states', 		'uses' =>	'PaymentsController@states_index'));
		Route::get('payments/record',  		array('before' => 'auth|permiso:1','as' => 'payments.record',		'uses' =>	'PaymentsController@record_index'));
		Route::get('payments/neighbors',  	array('before' => 'auth|permiso:2','as' => 'payments.neighbors',		'uses' =>	'PaymentsController@record_neighbors'));
		Route::get('payment/{id}',												  	'PaymentsController@delete');
		Route::post('modal_estado_cuenta',['as' => 'modal.estado.cuenta', 'uses' => 'PaymentsController@modalEstadoCuenta']);
	//================/PAYMENTS===========================================


	//================INCOMES===========================================

		//cHARGES
			Route::get('incomes/charge',  			            array('before' => 'auth|permiso:3','as'  => 'income.charge',			 'uses' =>	'IncomesController@charges_index'));
			Route::get('incomes/register/charge',  			    array('before' => 'auth|permiso:17','as'  => 'income.charge.other',	 'uses' =>	'IncomesController@register_charges'));
			Route::get('incomes/charge/balances',  			    array('before' => 'auth|permiso:17','as' => 'income.charge.balances', 'uses' =>	'IncomesController@charges_balances'));
			Route::post('incomes/charge/MostrarEstadoCuenta',  	array("before" => "auth",'as' => 'income.charge.MostrarEstadoCuenta', 	             'uses' =>	'IncomesController@MostrarEstadoCuenta'));
			Route::post('incomes/charge/store',  	            array("before" => "auth",'as' => 'income.charge.store', 	                         'uses' =>	'IncomesController@charges_store'));
			Route::post('incomes/store',  	            		array("before" => "auth",'as' => 'incomes.store', 	                         		 'uses' =>	'IncomesController@incomes_store'));
			Route::post('incomes/charge/save/balance',  	    array("before" => "auth",'as' => 'income.charge.save.balance', 	                 'uses' =>	'IncomesController@charges_save_balance'));
			Route::get('incomes/catalog',            			array('before' => 'auth|permiso:19','as' => 'incomes.catalog', 								 'uses' =>	'IncomesController@catologo_ingreso'));
			Route::get('incomes/record',  						array("before" => "auth",'as' => 'incomes.record',									 'uses' =>	'IncomesController@record_index'));
			Route::get('incomes/{id}',										'IncomesController@delete');
			Route::get('incomes/catalog/delete/{id}',						'IncomesController@delete_catalog');
			Route::post('incomes/catalog/store',				array("before" => "auth",'as' => 'incomes.catalog.store',	'uses' => 'IncomesController@catalog_store'));
		//

	//================/INCOMES===========================================

	//================EXPENSES===========================================
		Route::get('expenses',  					array('before' => 'auth|permiso:5','as' => 'expenses',			'uses' =>	'ExpensesController@index'));
		Route::post('expenses/store',  				array("before" => "auth",'as' => 'expenses.store', 	'uses' =>	'ExpensesController@store'));
		Route::get('expenses/catalog',             array('before' => 'auth|permiso:20','as' => 'expenses.catalog',  'uses' 	=>	'ExpensesController@catologo_egreso'));
		Route::get('expenses/catalog/delete/{id}',						'ExpensesController@delete_catalog');
		Route::get('expenses/delete/{id}',						'ExpensesController@delete_egreso');
		Route::get('expenses/delete/file/{id}',						'ExpensesController@delete_fileEgreso');
		Route::post('expenses/catalog/store',				array("before" => "auth",'as' => 'expenses.catalog.store',	'uses' => 'ExpensesController@catalog_store'));
	//================/EXPENSES===========================================

	//================REPORTS===========================================

		//Expenses
			Route::get('report/expenses',			array('before' => 'auth|permiso:7','as' => 'report.expenses',	'uses' =>	'ExpensesController@report'));
			Route::get('report/edit/expense/{id}',		'ExpensesController@edit_expense');
			Route::post('expenses/report/store',  	array("before" => "auth",'as' => 'expense.edit.store', 	'uses' =>	'ExpensesController@store_edit_expense'));
		//

	//================/REPORTS===========================================


	//================CONFIG - COLONIES===========================================

			Route::get('config/colony',			  		   array("before" => "auth",'as'     => 'config.colony',				                    'uses' 	=>	'ColonyController@config_index'));
			Route::get('config/colony/info',	  		   array('before' => 'auth|permiso:12','as' => 'config.colony.info',			'uses' 	=>	'ColonyController@edit_informacion'));
			Route::get('config/colony/location',	  	   array('before' => 'auth|permiso:13','as' => 'config.colony.ubic',			'uses' 	=>	'ColonyController@edit_ubic'));
			Route::get('config/colony/edit/share',	  	   array('before' => 'auth|permiso:14','as' => 'config.colony.edit.share',	'uses' 	=>	'ColonyController@edit_cuota'));
			Route::post('config/colony/share/store',	   array('before' => 'auth|permiso:14','as' => 'config.colony.share.store',	'uses' 	=>	'ColonyController@store_cuota'));
			Route::get('config/colony/invite-neighboring', array('before' => 'auth|permiso:15','as' => 'config.colony.inv',			'uses' 	=>	'ColonyController@edit_inv'));
			Route::post('config/colony/send/invitation',   array("before" => "auth",'as'     => 'config.colony.send.inv',		 'uses' 	=>	'ColonyController@send_inv'));
			Route::get('config/colony/register-neighbor',  array('before' => 'auth|permiso:16','as' => 'config.colony.reg',			'uses' 	=>	'ColonyController@reg_vecino'));
			Route::get('config/colony/register-family',    array('before' => 'auth|permiso:24','as'     => 'config.colony.reg.fam',	     'uses' 	=>	'ColonyController@reg_familiar'));
			Route::get('config/colony/nueva-colonia',	   array('before' => 'auth|permiso:23','as'     => 'config.colony.nueva',			 'uses' 	=>	'ColonyController@nueva_colonia'));
			Route::post('config/colony/store',		 	   array("before" => "auth",'as'     => 'config.colony.store', 		 'uses' 	=>	'ColonyController@config_store'));
			Route::get('config/colony/select-colonia',	   array("before" => "auth",'as'     => 'config.colony.sc',   'uses' 	=>	'ColonyController@select_colonia'));
			Route::post('config/colony/colonia-seleccionada',		   array("before" => "auth",'as'     => 'config.colony.colsel', 		        'uses' 	=>	'ColonyController@colsel'));
			Route::get('send/invitation',				   array("before" => "auth",'as'     => 'send.invitation', 			 'uses'	=> 	'HomeController@sendMailInvitation'));
			Route::post('config/colony/editinfo',		   array("before" => "auth",'as'     => 'config.colony.editinfo', 		 'uses' 	=>	'ColonyController@editColonyInfo'));
			Route::post('config/colony/editubic',		   array("before" => "auth",'as'     => 'config.colony.editubic', 		 'uses' 	=>	'ColonyController@editColonyUbic'));
			Route::post('config/colony/vecino/store',      array("before" => "auth",'as'     => 'config.colony.vecino.store',   'uses' 	=>	'ColonyController@store_vecino'));
			Route::post('config/colony/familiar/store',    array("before" => "auth",'as'     => 'config.colony.familiar.store', 'uses' 	=>	'ColonyController@store_familiar'));
			Route::get('config/colony/emails',             array('before' => 'auth|permiso:21','as' => 'config.colony.email',        'uses'  =>  'ColonyController@emails' ));
			Route::get('config/colony/suggestion',         array('before' => 'auth','as' => 'config.colony.suggestion',   'uses'  =>  'ColonyController@suggestion' ));
			Route::post('config/colony/sendemails',        array("before" => "auth",'as'     => 'config.colony.send.email',     'uses'  =>  'ColonyController@sendEmails' ));


	//================/CONFIG - COLONIES===========================================

	//================NEIGHBORS===========================================


		Route::post('neighbor/store',					array('as' => 'neighbor.store', 				'uses'	=>	'NeighborController@store'));
		Route::post('neighbor/admin/store',				array("before" => "auth",'as' => 'neighbor.store.admin', 		    'uses'	=>	'NeighborController@store_admin'));
		Route::post('neighbor/store/update',			array("before" => "auth",'as' => 'neighbor.store_update', 			'uses'	=>	'NeighborController@store_update'));
		Route::post('neighbor/store/update_fam',	    array("before" => "auth",'as' => 'neighbor.store_update_fam', 		'uses'	=>	'NeighborController@store_update_fam'));
		Route::post('neighbor/store/create_update',		array("before" => "auth",'as' => 'neighbor.create_update', 		'uses'	=>	'NeighborController@create_update'));

		Route::get('neighbor/profile',  					array("before" => "auth",'as' => 'neighbor.profile', 				'uses' =>	'NeighborController@profile'));
		Route::post('neighbor/profile/{id}',  				array("before" => "auth",'as' => 'neighbor.profile.update',		'uses' =>	'NeighborController@profile_update'));
		Route::get('neighbor/admin/properties',    			array("before" => "auth",'as' => 'neighbor.properties.admin',		'uses' =>	'NeighborController@admin_neighbor'));
		Route::get('neighbor/properties',  					array("before" => "auth",'as' => 'neighbor.register.properties',	'uses' =>	'NeighborController@register_properties'));
		Route::get('neighbor/register',  					array("before" => "auth",'as' => 'neighbor.register',			'uses' =>	'NeighborController@register_neighbors'));
		Route::post('neighbor/register/store',  			array("before" => "auth",'as' => 'neighbor.store.register',	'uses' =>	'NeighborController@store_register_neighbors'));
		Route::post('neighbor/properties/store',			array("before" => "auth",'as' => 'neighbor.store.properties',   'uses'	=>	'NeighborController@store_register_properties'));
		Route::post('neighbor/foto/perfil',			        array('as' => 'foto.perfil',	'uses' =>	'NeighborController@fotoPerfil'));

	//================/NEIGHBORS===========================================




	//================Admin===========================================

		//Permission
			Route::get('admin/permission',  		array("before" => "auth",'as' => 'permission',			'uses' =>	'AdminController@permission_index'));
			Route::post('admin/permission/store',  	array("before" => "auth",'as' => 'permission.store', 	'uses' =>	'IncomesController@charges_store'));
		//

		//Tree Permission
			Route::get('admin/tree/permission',		array("before" => "auth",'as' => 'tree.permission',		'uses' =>	'AdminController@permission_tree'));
		//

	//================/INCOMES===========================================


	//================NEIGHBOR CONFIRMATION===========================================
		Route::get('neighbor/register/verify/{confirmationCode}',									'ConfirmationController@confirm');
		Route::get('neighbor/register/verify/data/{confirmationCode}',								'ConfirmationController@confirm_data');
		Route::get('neighbor/register/verify/data/fam/{confirmationCode}',						    'ConfirmationController@confirm_data_fam');
	//================/NEIGHBOR CONFIRMATION===========================================


});



//----------------------------COMMENTED AFTER SAVE()----------------->
//~Route::get('/',function()
	//~{
//~
		//~$admin = new Role;
		//~$admin->name = 'admin';
		//~$admin->save();
		//~
		//~$client = new Role;
		//~$client->name = 'client';
		//~$client->save();
	  //~
		//~$driver = new Role;
		//~$driver->name = 'driver';
		//~$driver->save();
	  //~
		//~$user = User::where('username','=','admin')->first();
		//~/* OR the eloquent's original: */
		//~$user->roles()->attach( $admin->id ); // id only
		//~
		//~
		//~$manageData = new Permission; // Can edit, delete & enter data.
		//~$manageData->name = 'manage_data';
		//~$manageData->display_name = 'Manage Data';
		//~$manageData->save();
		//~
		//~$write = new Permission; // Can only enter certain information (files information).
		//~$write->name = 'write';
		//~$write->display_name = 'Can Write';
		//~$write->save();
		 //~
		//~$read = new Permission; // Can only read (file iformation)
		//~$read->name = 'read';
		//~$read->display_name = 'Can Read';
		//~$read->save();
	  //~
		//~$manageUsers = new Permission;
		//~$manageUsers->name = 'manage_users';
		//~$manageUsers->display_name = 'Manage Users';
		//~$manageUsers->save();
//~
		//~$admin->perms()->sync(array($manageData->id,$manageUsers->id));
		//~$client->perms()->sync(array($write->id));
		//~$driver->perms()->sync(array($read->id));
		//~
		//~$user->ability('admin,client,driver', 'manage_data,write,read,manage_users');
	//~
	//~});
	//~
