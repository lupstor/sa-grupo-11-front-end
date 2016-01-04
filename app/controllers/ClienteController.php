<?php

class ClienteController extends BaseController {

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


	public function listaClientes()
	{
		$clientes = array();
		try {
			$clientes = json_decode($this->httpClient->get('/cliente/lista-clientes'));
		} catch (Exception $ex) {
			Log::error($ex);
		}
		Log::debug(__METHOD__ ." - Listado de clientes: ". print_r($clientes,true));
		$this->layout->main = View::make('cliente.clientes', compact('clientes'));
	}

	public function crearCliente()
	{
		$this->layout->main = View::make('cliente.crear-cliente');

	}

	public function guardarCliente()
	{
		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/cliente/guardar-cliente",
				array(
					"nombre"	=> $postData["nombre"],
					"telefono"	=> $postData["telefono"],
					"direccion" => $postData["direccion"],
					"email"     => $postData["email"]
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar el cliente");

			Session::flash('message', 'Cliente creado correctamente ');
			return Redirect::to('cliente/lista-clientes');
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al crear el Cliente');
			
		}
	}

	public function eliminarCliente($idCliente)
	{

		try{
				$resultado = json_decode ($this->httpClient->get('/cliente/eliminar-cliente/'.$idCliente) );

				if ($resultado->responseCode != 0) throw new \Exception("Error al eliminar el cliente");

				Session::flash('message', 'Cliente eliminado correctamente');
				return Redirect::to('cliente/lista-clientes');
		}
		catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al eliminar el Cliente');	
		}
	}


	
	public function obtenerCliente($idCliente)
	{


		Session::flash('message', 'Cliente recibido para actualizar ' .$idCliente);
		try{

			//obtenemos la información del cliente para actualizarla 
			$cliente = json_decode ($this->httpClient->get('/cliente/obtener-cliente/'.$idCliente) );
			Session::flash('message', 'cliente recibido: ' .$cliente -> id );	
			$this->layout->main = View::make('cliente.actualizar-cliente', compact('cliente'));

		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al actualizar el cliente');	
		}

	}

	public function actualizarCliente()
	{
		//Get request data
		$postData = Input::all();
		
		try {

			$resultado = json_decode($this->httpClient->post("/cliente/actualizar-cliente",
				array(
					"nombre"	=> $postData["nombre"],
					"telefono"	=> $postData["telefono"],
					"direccion" => $postData["direccion"],
					"email"     => $postData["email"],
					"id"     	=> $postData["id"]
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al actualizar el cliente");

			Session::flash('message', 'Cliente actualizado correctamente ');
			return Redirect::to('cliente/lista-clientes');
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al actualizar el Cliente');
			
		}

	}

}
