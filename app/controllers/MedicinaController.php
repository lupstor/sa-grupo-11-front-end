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











	/**
	 * Retrona detalle de pedido
	 */
	/*
	public function detallePedido($idPedido)
	{
		try {
			$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));
			$detallePedido = json_decode($this->httpClient->get("/pedido/detalle-pedido/$idPedido"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('pedido.detalle-pedido', compact('pedido','detallePedido'));
	}
	*/


	

}
