@extends('layouts.master')
@section('content')

<legend>Crear Cliente</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('url' => 'cliente/actualizar-cliente')) }}

            <div class="form-group">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre', $cliente -> nombre, array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('telefono', 'Telefono') }}
                {{ Form::text('telefono', $cliente -> telefono , array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('direccion', 'Dirección') }}
                {{ Form::text('direccion', $cliente -> direccion, array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', $cliente -> email, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::hidden('id', $cliente -> id) }}
            </div>

            {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop