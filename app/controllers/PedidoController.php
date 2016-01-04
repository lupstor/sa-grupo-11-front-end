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
		$pedidos = array();
		try {
			$pedidos = json_decode($this->httpClient->get('/pedido/lista-pedidos-call-center'));
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
		try {
			$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));
			$detallePedido = json_decode($this->httpClient->get("/pedido/detalle-pedido/$idPedido"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('pedido.detalle-pedido', compact('pedido','detallePedido'));
	}

	public function crearPedido(){
		$empleados = array();
		$clientes= array();

		try {
			$empleados = json_decode($this->httpClient->get("/empleado/lista/call_center"));
			$clientes = json_decode($this->httpClient->get("/cliente/lista"));

		} catch (Exception $ex) {
			Log::error($ex);
		}

		$this->layout->main = View::make('pedido.crear-pedido',compact('empleados','clientes'));

	}

	public function  guardarPedido(){

		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/pedido/guardar-pedido-call-center",
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

		$medicinas = array();
		try {
			$medicinas = json_decode($this->httpClient->get("/medicina/combo-medicinas"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		Log::debug(__METHOD__ ." - Medicinas: ". print_r($medicinas,true));

		$this->layout->main = View::make('pedido.crear-detalle-pedido',compact('idPedido','medicinas'));

	}

	public  function  guardarDetallePedido($idPedido){

		//Get request data
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/pedido/guardar-detalle-pedido",
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
		$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));

		return Redirect::to((empty($pedido->call_center) ? "compra/detalle-compra" : "pedido/detalle-pedido" )."/".$idPedido);
	}

	/**
	 * Paga un pedido por call center o compra presencial, en efectivo o por tarjeta de credito
	 */
	public function pagarPedido($idPedido)
	{
		///Implementacion de Marcos
		try {
			$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));
		} catch (Exception $ex) {
			Log::error($ex);
		}

		Log::debug(__METHOD__ ." - Pagos: ". print_r($pedido,true));

		$this->layout->main = View::make('pedido.crear-pago-pedido',compact('idPedido','pedido'));
	}
	
	public  function  guardarPagoPedido($idPedido){

		//Get request data
		$postData = Input::all();
		try {
			if($postData["tipo_pago"]=='Tarjeta'){
				$resultado = json_decode($this->httpClient->post("/pedido/verificar-pago-tarjeta",
				array(
					"NoTarjeta"		    => $postData["NoTarjeta"],
					"CodigoSeguridad"	  => $postData["CodigoSeguridad"],
				)));
				if ($resultado->responseCode != 0){ 
					throw new \Exception("Error al procesar Tarjeta");
				}
			}else{
				$resultado = json_decode($this->httpClient->post("/pedido/verificar-pago-efectivo",
				array(
					"ocultoCambio"		    => $postData["ocultoCambio"],
				)));
				if ($resultado->responseCode != 0){ 
					throw new \Exception("Error al procesar Tarjeta");
				}
			}
			
			$resultado = json_decode($this->httpClient->post("/pedido/guardar-pago-pedido",
				array(
					"idPedido"         => $idPedido,
					"tipo_pago"		    => $postData["tipo_pago"],
					"status"	        => 'Cancelada',
				)));
			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar pedido");
			Session::flash('message', 'Pago agregado correctamente a pedido # '. $idPedido);
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al agregar pago al pedido # '. $idPedido);
		}
		//$pedido = json_decode($this->httpClient->get("/pedido/obtener-por-id/$idPedido"));
		//$pedidos = array();
		//$pedidos[0] = $pedido;
		
		return Redirect::to("pedido/pagar-pedido/".$idPedido);
		//Log::debug(__METHOD__ ." - Listado de pedidos: ". print_r($pedidos,true));
		//$this->layout->main = View::make('pedido.pedidos', compact('pedidos'));
	}

	public  function  verificarPagoTarjeta(){
		$postData = Input::all();
		try {
			$resultado = json_decode($this->httpClient->post("/pedido/verificar-pago-tarjeta",
				array(
					"NoTarjeta"		    => $postData["NoTarjeta"],
					"CodigoSeguridad"	  => $postData["CodigoSeguridad"],
				)));
			if ($resultado->responseCode != 0) throw new \Exception("Error al guardar pedido");
			Session::flash('message', 'Pago agregado correctamente a pedido # '. $idPedido);
		} catch (Exception $ex) {
			Log::error($ex);
			Session::flash('error', 'Error al agregar pago al pedido # '. $idPedido);
		}
	}
}
