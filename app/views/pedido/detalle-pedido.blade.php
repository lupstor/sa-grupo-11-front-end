@extends('layouts.master')
@section('content')

<h2>Pedido</h2>
<br>
<dl class="dl-horizontal" >

    <dt>Id</dt>
    <dd>{{ $pedido->id }}</dd>

    <dt>Fecha</dt>
    <dd>{{ $pedido->created_at }}</dd>

    <dt>Cliente</dt>
    <dd>{{ $pedido->cliente }}</dd>

    <dt>Usuario call center</dt>
    <dd>{{ $pedido->creado_por }}</dd>

    <dt>Call center</dt>
    <dd>{{ $pedido->call_center }}</dd>

    <dt>Status</dt>
    <dd>{{ $pedido->status }}</dd>

    <dt>Tipo pago</dt>
    <dd>{{ empty($pedido->tipo_pago) ? "Pendiente de pago" : $pedido->tipo_pago }}</dd>
</dl>

<div class="row">
    <div class="col-md-6 col-lg-6">
        <h3>Detalle de pedido</h3>
        <br>

        @if (empty($pedido->tipo_pago) )
        <div class="pull-left">
            {{link_to('pedido/crear-detalle-pedido/'.$pedido->id,"Agregar medicamento",array(),array('class' => 'btn btn-primary'));}}
        </div>
        @endif
        <br>
        <br>

        <div class="well">
            @if (count($detallePedido))
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Medicina</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($detallePedido as $detalle)
                <tr>
                    <td>{{ $detalle->medicina }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ "Q". number_format($detalle->subtotal,2) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            No existe detalle pare el pedido
            @endif
        </div>


        @if (empty($pedido->tipo_pago) && count($detallePedido))
            <div class="pull-right">
                {{link_to('pedido/pagar-pedido/'.$pedido->id,"Pagar pedido",array(),array('class' => 'btn btn-primary'));}}
            </div>
        @endif

    </div>
</div>
@stop