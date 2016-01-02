@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado de Compras</h3>

        <br>
        {{link_to('compra/nueva-compra',"Nueva compra");}}


        <br>
        <br>
        <div class="well">
            @if (count($compras))
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Creado por</th>
                    <th>Total</th>
                    <th>Tipo pago</th>

                </tr>
                </thead>

                <tbody>
                @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->created_at }}</td>
                    <td>{{ $compra->cliente }}</td>
                    <td>{{ $compra->empleado }}</td>
                    <td>{{ "Q". number_format($compra->total,2) }}</td>
                    <td>{{ $compra->tipo_pago }}</td>
                    <td>{{link_to('compra/detalle-compra/'.$compra->id,"Detalle",array('class' => 'btn btn-primary'));}}  </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            No existen compras
            @endif
        </div>
    </div>
</div>
@stop