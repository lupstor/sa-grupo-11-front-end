@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado de Pedidos</h3>

        <br>
        {{link_to('pedido/crear-pedido',"Crear Pedido");}}


        <br>
        <br>
        <div class="well">
            @if (count($pedidos))
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Creado por</th>
                    <th>Status</th>
                    <th>Call center</th>
                    <th>Nombre recibe</th>
                    <th>Direccion entrega</th>
                    <th>Total</th>

                    <th>Tipo pago</th>

                </tr>
                </thead>

                <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->fecha_hora }}</td>
                    <td>{{ $pedido->cliente }}</td>
                    <td>{{ $pedido->creado_por }}</td>
                    <td>{{ $pedido->status }}</td>
                    <td>{{ $pedido->call_center }}</td>
                    <td>{{ $pedido->nombre_recibe }}</td>
                    <td>{{ $pedido->direccion_entrega }}</td>
                    <td>{{ "Q". number_format($pedido->total,2) }}</td>
                    <td>{{ $pedido->tipo_pago }}</td>
                    <td>{{link_to('pedido/detalle-pedido/'.$pedido->id,"Detalle",array(),array('class' => 'btn btn-primary'));}}  </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            No existen pedidos
            @endif
        </div>
    </div>
</div>
@stop