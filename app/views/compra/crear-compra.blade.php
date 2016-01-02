@extends('layouts.master')
@section('content')

<legend>Crear compra</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('id' => 'crear_pedido','url' => 'compra/guardar-compra')) }}

            <div class="form-group">
                {{ Form::label('cliente', 'Cliente') }}
                {{ Form::select('cliente', $clientes,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('creado_por', 'Creado Por') }}
                {{ Form::select('creado_por', $empleados,null , array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Nueva compra', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop