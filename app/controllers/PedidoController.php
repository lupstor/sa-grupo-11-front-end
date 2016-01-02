<?php

class PedidoController extends BaseController {

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
	public function listaPedidos()
	{
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');
		$pedidos = array();
		try {
			$pedidos = json_decode($httpClient->get('/pedido/lista-pedidos-call-center'));
		} catch (Exception $ex) {
			Log::error($ex);
		}
		Log::debug(__METHOD__ ." - Listado de pedidos: ". print_r($pedidos,true));
		$this->layout->main = View::make('pedido.pedidos', compact('pedidos'));
	}

	/**
	 * Retrona detalle de pedido
	 */
	public function detallePedido($idPedido)
	{
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');
		try {
			$pedido = json_decode($httpClient->get("/pedido/obtener-por-id/$idPedido"));
			$detallePedido = json_decode($httpClient->get("/pedido/detalle-pedido/$idPedido"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('pedido.detalle-pedido', compact('pedido','detallePedido'));
	}

	public function crearPedido(){
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');

		$empleados = array();
		$clientes= array();

		try {
			$empleados = json_decode($httpClient->get("/empleado/lista/call_center"));
			$clientes = json_decode($httpClient->get("/cliente/lista"));

		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('pedido.crear-pedido',compact('empleados','clientes'));

	}

	public function  guardarPedido(){
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');

		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($httpClient->post("/pedido/guardar-pedido-call-center",
				array(
					"cliente"		    => $postData["cliente"],
					"creado_por"	    => $postData["creado_por"],
					"direccion_entrega" => $postData["direccion_entrega"],
					"nombre_recibe"     => $postData["nombre_recibe"],
					"call_center"       => $postData["call_center"],
					"status"	        => "pendiente",
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar pedido");

			Session::flash('message', 'Pedido creado correctamente ');
			return Redirect::to('pedido/detalle-pedido/'. $resultado->id_pedido);
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al crear pedido');
			return Redirect::to('pedido/crear-pedido');
		}
	}

	public  function  crearDetallePedido($idPedido){
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');

		$medicinas = array();
		try {
			$medicinas = json_decode($httpClient->get("/medicina/lista"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		Log::debug(__METHOD__ ." - Medicinas: ". print_r($medicinas,true));

		$this->layout->main = View::make('pedido.crear-detalle-pedido',compact('idPedido','medicinas'));

	}

	public  function  guardarDetallePedido($idPedido){
		$httpClient = new Pest('http://localhost/sa-grupo11-services/public');

		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($httpClient->post("/pedido/guardar-detalle-pedido",
				array(
					"pedido_id"         => $idPedido,
					"medicina"		    => $postData["medicina"],
					"cantidad"	        => $postData["cantidad"],
				)));

			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar medicina");

			Session::flash('message', 'Medicina agregada correctamente a pedido # '. $idPedido);
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al agregar medicina al pedido # '. $idPedido);
		}

		return Redirect::to('pedido/detalle-pedido/'.$idPedido);
	}

	/**
	 * Paga un pedido por call center o compra presencial, en efectivo o por tarjeta de credito
	 */
	public function pagarPedido($idPedido)
	{
		///Implementacion de Marcos
	}

}