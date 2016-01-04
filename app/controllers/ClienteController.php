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


	/**
	 * Retrona lista de pedidos realizados por el call center
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

	
}
