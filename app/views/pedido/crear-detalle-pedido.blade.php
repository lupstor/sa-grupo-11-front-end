@extends('layouts.master')
@section('content')

<legend>Agregar medicina a detalle</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('id' => 'crear_detalle_pedido','url' => 'pedido/guardar-detalle-pedido/' .$idPedido)) }}


            <div class="form-group">
                {{ Form::label('medicina', 'Medicina') }}
                {{ Form::select('medicina', $medicinas,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('cantidad', 'Cantidad') }}
                {{ Form::text('cantidad', Input::old('Cantidad'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Agregar a detalle', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop