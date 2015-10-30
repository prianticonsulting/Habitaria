<?php

class ProductController extends BaseController
{

    
    public function index()
    { 
		$products	= Product::all();
		
        return View::make('dashboard.products.index',['products'=> $products]);
    }

    
    public function create()
    { 
        return View::make('dashboard.products.create');
    }

   
   public function store()
    {
		
		$img= Input::File('img');
		$description= Input::get('description');
        
        
        strip_tags($img);
												
		$rules = ['img' => 'mimes:jpg,jpeg,png,gif', 'description'=> 'max:80'];
		
		$messages = array(
			'mimes'  => '¡Atención! Solo están permitidas imágenes en: jpg, png o gif.',
			'max'    => '¡Atención! Máximo :max caracteres de descripción',
		);
		
		$validator = \Validator::make(['img'=> $img, 'description'=>$description],$rules,$messages);
	
		if($validator->passes()) {
			
			$filename= str_random(10).'.'.$img->getClientOriginalName();
			$destinationPath= public_path() . '/uploads/products/';
			$uploadSuccess	= $img->move($destinationPath, $filename);
			
			$product= new Product;
			$product->name			= Input::get('name');
			$product->img 			= $filename;
			$product->description	= Input::get('description');
			$product->price 		= Input::get('price');
			
			$product->save();
			
		return Redirect::route('products')->with('error', false)
										  ->with('msg','<strong>Producto añadido correctamente!</strong>')
										  ->with('class', 'info');
		}else{
			return Redirect::back()->withErrors($validator);
		
		} 
    }
    
    public function edit($id) {

		$product= Product::findOrFail($id);
		
		return View::make('dashboard.products.edit',['product'=> $product]);
		 
		 
    }


     public function update($id) {
        try {

				$product= Product::findOrFail($id);
           
				$img= Input::File('img');
				$description= Input::get('description');
			
				strip_tags($img);
														
				$rules = ['img' => 'mimes:jpg,jpeg,png,gif', 'description'=> 'max:80'];
				
				$messages = array(
					'mimes'  => '¡Atención! Solo están permitidas imágenes en: jpg, png o gif.',
					'max'    => '¡Atención! Máximo :max caracteres de descripción',
				);
				
				$validator = \Validator::make(['img'=> $img, 'description'=>$description],$rules,$messages);
			
				if($validator->passes()) {
					
					if($img){
				
						$filename= str_random(10).'.'.$img->getClientOriginalName();
						$destinationPath= public_path() . '/uploads/products/';
						$uploadSuccess	= $img->move($destinationPath, $filename);
						
						$product->img = $filename;
				
					}else{
						
						$product->img 	= $product['img'];
					}
					
					
					
					
					$product->name			= Input::get('name');
					$product->description	= Input::get('description');
					$product->price 		= Input::get('price');
					$product->updated_at	= new DateTime;
				
					$product->update(['id']);
			
					
				   return Redirect::route('products')->with('error', false)
													->with('msg','Producto actualizada con éxito.')
													->with('class', 'info');
				}else{
				
					return Redirect::back()->withErrors($validator);
		
				} 
			} catch (Exception $exc) {

				echo $exc->getMessage() . " " . $exc->getLine();
				
				return Redirect::back()->with('error', true)
										->with('msg', '¡Algo salió mal! Contacte con administrador.')
										->with('class', 'danger');
			}
	}
	
	 
    
    public function info($id) {

		$product= Product::findOrFail($id);
		
		return View::make('dashboard.products.info',['product'=> $product]);
    }

    	
    public function delete($id) {
		try {
		$product= Product::findOrFail($id);
		$product->delete(['id']);
		
		return Redirect::back()->with('error', false)->with('msg','Producto removido exitosamente.')
													->with('class', 'warning');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '¡Algo salió mal! Contacte con administrador')
									->with('class', 'danger');
        }
    }
    
    
    
}
