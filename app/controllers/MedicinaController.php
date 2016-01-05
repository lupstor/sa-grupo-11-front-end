<?php

class MedicinaController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	/**
	*	Listado de medicamentos en existencia
	*/

	public function listaMedicina()
	{
		$medicinas = array();
		try {
			$medicinas = json_decode($this->httpClient->get('/medicina/lista-medicinas'));
		} catch (Exception $ex) {
			Log::error($ex);
		}
		Log::debug(__METHOD__ ." - Listado de Medicamentos: ". print_r($medicinas,true));
		$this->layout->main = View::make('medicina.medicinas', compact('medicinas'));
	}

	

	  public  function  crearMedicina(){

		$proveedores = array();
		try {
			$proveedores = json_decode($this->httpClient->get("/medicina/combo-proveedores"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		Log::debug(__METHOD__ ." - proveedores: ". print_r($proveedores,true));

		$this->layout->main = View::make('medicina.crear-medicina',compact('proveedores'));

	}


	public function guardarMedicina()
	{
		 
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/medicina/guardar-medicina",
				array(
					"nombre"		=> $postData["nombre"],
					"descripcion"	=> $postData["descripcion"],
					"cantidad" 		=> $postData["cantidad"],
					"precio"    	=> $postData["precio"],
					"proveedor_id"  => $postData["proveedor"],
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar medicina");

			Session::flash('message', 'Medicamento creado correctamente ');
			return Redirect::to('medicina/lista-medicinas');
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al crear medicina');
			
		}
	}





	

}
