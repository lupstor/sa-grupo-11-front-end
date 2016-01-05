@extends('layouts.master')
@section('content')

<legend>Crear Medicamento</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('url' => 'medicina/guardar-medicina')) }}
             <div class="form-group">
                {{ Form::label('proveedor', 'Proveedor') }}
                {{ Form::select('proveedor', $proveedores,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('descripcion', 'Descripción') }}
                {{ Form::text('descripcion', Input::old('descripcion'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('cantidad', 'Cantidad') }}
                {{ Form::text('cantidad', Input::old('cantidad'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('precio', 'Precio') }}
                {{ Form::text('precio', Input::old('precio'), array('class' => 'form-control')) }}
            </div>
            

            {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop