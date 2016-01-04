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
//Ruta principal redirecciona a home

Route::get('/', 'HomeController@index');


//Ruta home
Route::group(array('prefix' => 'home'), function()
{
	Route::get('index','HomeController@index');
});


//Rutas para pedidos
Route::group(array('prefix' => 'pedido'), function()
{
	//Lista de pedidos
	Route::get('lista-pedidos','PedidoController@listaPedidos');
	Route::get('detalle-pedido/{idPedido}','PedidoController@detallePedido');

	//Crear pedido
	Route::get('crear-pedido','PedidoController@crearPedido');
	Route::post('guardar-pedido','PedidoController@guardarPedido');

	//Crear detalle pedido
	Route::get('crear-detalle-pedido/{idPedido}','PedidoController@crearDetallePedido');
	Route::post('guardar-detalle-pedido/{idPedido}','PedidoController@guardarDetallePedido');

	//Pagar pedido
	Route::get('pagar-pedido/{idPedido}','PedidoController@pagarPedido');

});



//Rutas para compras
Route::group(array('prefix' => 'compra'), function()
{
	//Lista de compras
	Route::get('lista-compras','CompraController@listaCompras');
	Route::get('detalle-compra/{idPedido}','CompraController@detalleCompra');

	//Crear compra
	Route::get('nueva-compra','CompraController@nuevaCompra');
	Route::post('guardar-compra','CompraController@guardarCompra');

});


//Rutas para clientes
Route::group(array('prefix' => 'cliente'), function()
{
	//Lista de Clientes
	Route::get('lista-clientes','ClienteController@listaClientes');

	

});

//Ruta para medicinas
Route::group(array('prefix' => 'medicina'), function()
{
	//Lista de medicinas
	Route::get('lista-medicinas','MedicinaController@listaMedicina');
	

});

