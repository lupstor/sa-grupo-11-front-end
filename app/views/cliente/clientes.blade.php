@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado de Clientes</h3>

        <br>
        {{link_to('cliente/crear-cliente',"Crear Cliente");}}


        <br>
        <br>
        <div class="well">
            @if (count($clientes))
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
            </table>
            @else
            No existen clientes
            @endif
        </div>
    </div>
</div>
@stop