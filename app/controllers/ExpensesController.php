<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\MimeType;

class ExpensesController extends BaseController
{

    public function index()
    {

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanism_id = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$breadcrumbs	= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data	=	$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

		$sub_accounts= SubAccount::where('account_id','=',2)->where('urbanism_id','=',$urbanism_id)->get();
		$amountIngresos = Payment::join('neighbors_properties','payments.neighbor_property_id' , '=', 'neighbors_properties.id')
									 ->join('neighbors','neighbors_properties.neighbors_id' , '=', 'neighbors.id')
									 ->join('sub_accounts','payments.sub_account_id' , '=', 'sub_accounts.id')
						   			 ->select(DB::raw('sum(payments.amount) as amountIngresos'))
									 ->where('neighbors_properties.urbanism_id', '=', $urbanism->id)
									 ->get();

		return View::make('dashboard.expenses.index',[
													  'sub_accounts'=>$sub_accounts,
													  'urbanism_id' =>$urbanism_id,
													  'usuario'		=>$breadcrumbs_data,
													  'amountIngresos' => $amountIngresos[0]]);
    }

    public function store()
    {
		try {

			$expense= new \Expense;
			$expense->urbanism_id	= Input::get('urbanism_id');
			$expense->sub_account_id= Input::get('sub_account_id');
			$expense->amount		= Input::get('amount');
			$expense->coments		= Input::get('coments');
			$expense->created_by	= Auth::user()->id;

			$files= Input::file('file');

				if ($expense->save()) {

					$new_expense = Expense::orderBy('created_at', 'desc')->first();

					if ($files) {

						foreach($files as $file) {

							if ($file) {

								strip_tags($file);

                                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

								$rules = ['file' => 'required|file|max:5120'];

								$messages = [
                                             'file'  => '¡Atención! Solo se permiten archivos de tipo: jpg,gif,jpeg,pdf,xml,png,doc,docx,xls y xlsx.',
                                             'max'    => '¡Atención! El tamaño máximo permitido para los archivos es de 5MB',
                                         ];

								$validator = \Validator::make(['file'=> $extension], $rules, $messages);

								if($validator->fails()) {

									$new_expense->delete();

								   return Redirect::back()->withInput()->withErrors($validator);
                                   //var_dump($files);

								} else {
                                    //print_r($files);
										$public_filename= $file->getClientOriginalName();
										$filename 		= uniqid().'_'.str_random(6).'_'.$file->getClientOriginalName();
										$destinationPath= public_path() . '/uploads/files/expenses/';
										$uploadSuccess	= $file->move($destinationPath, $filename);

										$new_data		= [ 'expense_id'		=> $new_expense->id,
															'public_filename'	=> $public_filename,
															'filename'			=> $filename
														  ];
										$expenses_files = ExpenseFile::create($new_data);
								}
							}
						}
					}


					return Redirect::route('report.expenses')->with('error', false)
															 ->with('msg', 'Gasto reportado con éxito')
															 ->with('class', 'info');
				}

			} catch (Exception $exc) {

					echo $exc->getMessage() . " " . $exc->getLine();

					return Redirect::back()->with('error', true)
                                           ->with('msg', '¡Algo salió mal! Contacte con administrador')
										   ->with('class', 'danger');
			}
	}

	public function report()
    {

		$user_id= Auth::user()->id;
		$AssigmentRole= Auth::user()->AssigmentRole[0]->role_id;
		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanism_id = $urbanism->id;
		$urb_name = $urbanism->Colony->name;

		$breadcrumbs	= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data	=	$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";


		$expenses 	= Expense::join('users','expenses.created_by' , '=', 'users.id')
								->join('neighbors','users.id' , '=', 'neighbors.user_id')
								->join('sub_accounts','expenses.sub_account_id' , '=', 'sub_accounts.id')
								->select('expenses.updated_at', 'expenses.id' ,'expenses.amount','neighbors.name','neighbors.last_name','sub_accounts.description')
								->where('expenses.urbanism_id','=',$urbanism_id)
								->orderBy('expenses.id','DESC')
								->get();

			

		$files		= ExpenseFile::all();

		return View::make('dashboard.reports.expenses.index',[
														'expenses'=>$expenses,
														'files'=>$files,
														'usuario'=>$breadcrumbs_data,
														'AssigmentRole' => $AssigmentRole,
														'total' => 0
														]);
    }

	public function edit_expense($id)
    {

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$urbanism_id = $urbanism->id;
		$urb_name = $urbanism->name;

		$breadcrumbs	= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data	=	$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urb_name." ]";

		$expense 	= Expense::where('id','=',$id)->first();

		$files		= ExpenseFile::where('expense_id','=',$id)->get();

		$sub_accounts= SubAccount::where('account_id','=',2)->where('urbanism_id','=',$urbanism_id)->get();

		return View::make('dashboard.reports.expenses.edit',[
														'expense'=>$expense,
														'files'=>$files,
														'sub_accounts'=>$sub_accounts,
														'usuario'=>$breadcrumbs_data]);
    }

	public function store_edit_expense()
	{
		$id =Input::get('expense');

	try {
			$expense= Expense::findOrFail($id);

			$expense->sub_account_id= Input::get('sub_account_id');
			$expense->amount		= Input::get('amount');
			$expense->coments		= Input::get('coments');

			$files= Input::file('file');

				if ($expense->update(['id'])) {

					$new_expense = $id;

					if ($files){

						foreach($files as $file) {
							if ($file){
								strip_tags($file);

								$rules = ['file' => 'mimes:jpg,gif,jpeg,pdf,xml,png,doc,docx,xls,xlsx|max:5000'];

								$messages = array(
									'mimes'  => '¡Atención! Solo se permiten archivos de tipo: jpg,gif,jpeg,pdf,xml,png,doc,docx,xls y xlsx.',
									'max'    => '¡Atención! El tamaño máximo permitido para los archivos es de 5MB',
								);

								$validator = \Validator::make(['file'=> $file],$rules,$messages);

								if($validator->fails()) {

									$new_expense->delete();

								   return Redirect::back()->withInput()->withErrors($validator);

								}else{


										$public_filename= $file->getClientOriginalName();
										$filename 		= uniqid(). '_' .str_random(6) . '_' . $file->getClientOriginalName();
										$destinationPath= public_path() . '/uploads/files/expenses/';
										$uploadSuccess	= $file->move($destinationPath, $filename);

										$new_data		= [ 'expense_id'		=> $new_expense,
															'public_filename'	=> $public_filename,
															'filename'			=> $filename
														  ];
										$expenses_files = ExpenseFile::create($new_data);
								}
							}
						}
					}


					return Redirect::back()->with('error', false)
									->with('msg', 'Datos guardados con éxito')
									->with('class', 'info');
				}

			} catch (Exception $exc) {

					echo $exc->getMessage() . " " . $exc->getLine();

					return Redirect::back()->with('error', true)
											->with('msg', '¡Algo salió mal! Contacte con administrador')
											->with('class', 'danger');
			}

	}

	public function delete_fileEgreso($id)
	{
		try {

			$file= ExpenseFile::findOrFail($id);
			$archivo= public_path().'/uploads/files/expenses/'.$file->filename;
			if (File::exists($archivo)) {
				if(File::delete($archivo)){
					$file->delete(['id']);
					return Redirect::back()->with('error', false)->with('msg','Se eliminó el archivo exitosamente.')
														->with('class', 'info');
				}
			}

        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }

	}

    public function catologo_egreso()
	{

		$user_id= Auth::user()->id;

		$colonia = Session::get("colonia");

		$urbanism = Urbanism::where('colony_id', '=',$colonia)->first();

		$catalog =  SubAccount::where('urbanism_id','=',$urbanism->id)
							   ->where('account_id','=',2)
							   ->orderBy('id', 'ASC')->get();

		$breadcrumbs= Neighbors::where('user_id','=',$user_id)->first();

		$breadcrumbs_data=$breadcrumbs->name." ".$breadcrumbs->last_name." [ ".$urbanism->Colony->name." ]";

        return View::make('dashboard.expenses.catalogo_egresos',['usuario' 	  =>  $breadcrumbs_data,
																'urbanism_id' => $urbanism->id,
																 'catalog' 	  =>  $catalog]);
	}

	public function catalog_store()
	{

		$data=Input::all();

		$category= new SubAccount;
		$category->account_id	= 2;
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

    public function delete_catalog($id) {
		try {
		$account= SubAccount::findOrFail($id);
		$account->delete(['id']);

		return Redirect::back()->with('error', false)->with('msg','Categoria removida exitosamente.')
													->with('class', 'info');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }
    }

   public function delete_egreso($id) {

		try {

				$expense= Expense::findOrFail($id);
				$contador = 0;
				$files=    ExpenseFile::where('expense_id','=',$expense->id)->get();
				
				foreach ($files as $file) {
					$archivo= public_path().'/uploads/files/expenses/'.$file->filename;
					if (File::exists($archivo)) {
						if(File::delete($archivo)){
							$contador++;	

						}
					}
				}
				
				if ($files->count() == $contador) {
					$expense->delete(['id']);
					return Redirect::back()->with('error', false)->with('msg','Egreso removido exitosamente.')
															->with('class', 'info');

				}
		
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }

    }


}
