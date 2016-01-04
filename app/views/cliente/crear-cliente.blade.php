@extends('layouts.master')
@section('content')

<legend>Crear Cliente</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('url' => 'cliente/guardar-cliente')) }}


            <div class="form-group">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('telefono', 'Telefono') }}
                {{ Form::text('telefono', Input::old('telefono'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('direccion', 'Dirección') }}
                {{ Form::text('direccion', Input::old('direccion'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', Input::old('Email'), array('class' => 'form-control')) }}
            </div>

            

            {{ Form::submit('Crear cliente', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop