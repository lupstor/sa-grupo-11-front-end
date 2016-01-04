@extends('layouts.master')
@section('content')

<legend>Crear pedido</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('id' => 'crear_pedido','url' => 'pedido/guardar-pedido')) }}


            <div class="form-group">
                {{ Form::label('cliente', 'Cliente') }}
                {{ Form::select('cliente', $clientes,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('creado_por', 'Creado Por') }}
                {{ Form::select('creado_por', $empleados,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('direccion_entrega', 'Dirección Entrega') }}
                {{ Form::text('direccion_entrega', Input::old('Dirección Entrega'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('nombre_recibe', 'Nombre quien recibe') }}
                {{ Form::text('nombre_recibe', Input::old('Nombre quien recibe'), array('class' => 'form-control')) }}
            </div>


            <div class="form-group">
                {{ Form::label('call_center', 'Call Center') }}
                {{ Form::text('call_center', Input::old('Call Center'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Crear Pedido', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop