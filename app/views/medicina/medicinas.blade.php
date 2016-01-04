@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado de Medicamentos</h3>

        <br>
      


        <br>
        <br>
        <div class="well">
            @if (count($medicinas))
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                                   
                </tr>
                </thead>

                <tbody>
                @foreach ($medicinas as $med)
                <tr>
                    <td>{{ $med->id }}</td>
                    <td>{{ $med->nombre }}</td>
                    <td>{{ $med->descripcion }}</td>
                    <td>{{ $med->cantidad }}</td>
                    <td>{{ $med->proveedor_id }}</td>                                 
                     
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            No existen medicamentos
            @endif
        </div>
    </div>
</div>
@stop