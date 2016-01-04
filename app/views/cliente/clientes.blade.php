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
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                   
                </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente -> id  }}</td>
                    <td>{{ $cliente -> nombre  }}</td>
                    <td>{{ $cliente -> telefono  }}</td>
                    <td>{{ $cliente -> direccion  }}</td>
                    <td>{{ $cliente -> email  }}</td>

                   <td>{{link_to('cliente/obtener-cliente/'.$cliente -> id ,"Actualizar",array('class' => 'btn btn-primary'));}}  </td>
                   <td>{{link_to('cliente/eliminar-cliente/'.$cliente -> id ,"Eliminar",array('class' => 'btn btn-primary'));}}  </td>
 
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            No existen clientes
            @endif
        </div>
    </div>
</div>
@stop