<?php

class CompraController extends BaseController {

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

	public function index()
	{
		$this->layout->main = View::make('home.index');
		//return View::make('hello');
	}


	/**
	 * Retrona lista de compras realizadas en sitio
	 */
	public function listaCompras()
	{
		$compras = array();
		try {
			$compras = json_decode($this->httpClient->get('/pedido/lista-compras-farmacias'));
		} catch (Exception $ex) {
			Log::error($ex);
		}
		Log::debug(__METHOD__ ." - Listado de compras: ". print_r($compras,true));
		$this->layout->main = View::make('compra.compras', compact('compras'));
	}


	/**
	 * Retrona detalle de compra
	 */
	public function detalleCompra($idPedido)
	{
		try {
			$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));
			$detallePedido = json_decode($this->httpClient->get("/pedido/detalle-pedido/$idPedido"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('compra.detalle-compra', compact('pedido','detallePedido'));
	}

	public function nuevaCompra()
	{
		$empleados = array();
		$clientes= array();

		try {
			$empleados = json_decode($this->httpClient->get("/empleado/lista/farmacia"));
			$clientes = json_decode($this->httpClient->get("/cliente/lista"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('compra.crear-compra',compact('empleados','clientes'));

	}


	public function guardarCompra()
	{
		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/pedido/guardar-pedido-presencial",
				array(
					"cliente"		    => $postData["cliente"],
					"empleado"	        => $postData["creado_por"],
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar compra");

			Session::flash('message', 'Compra creada correctamente ');
			return Redirect::to('compra/detalle-compra/'. $resultado->id_pedido);
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al crear compra');
			return Redirect::to('compra/nueva-compra');
		}
	}

	
	//cancelar compra
	public function cancelarCompra($idPedido)
	{
		 
		try {
			$resultado = json_decode($this->httpClient->get("/pedido/cancelar-compra/$idPedido"));
			if ($resultado->responseCode != 0) throw new \Exception("Error al cancelar compra");
				Session::flash('message', 'Compra cancelada # '.$idPedido );
				return Redirect::to('compra/lista-compras');
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al cancelar pedido # '.$idPedido);
		}

				
	}

}
