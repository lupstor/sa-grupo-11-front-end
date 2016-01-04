@extends('layouts.master')
@section('content')

<legend>Realizar Pago a Pedido</legend>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            {{ Form::open(array('id' => 'crear_pago_pedido','url' => 'pedido/guardar-pago-pedido/' .$idPedido)) }}


            <div class="form-group">
				{{ Form::label('id', 'ID:	') }}
                {{ Form::label('id', $pedido->id) }}
            </div>

			<div class="form-group">
				{{ Form::label('status', 'Status:	') }}
                {{ Form::label('status', strtoupper($pedido->status), ['id' => 'statusPedido']) }}
            </div>
            
            <div class="form-group">
				{{ Form::label('total', 'Total a Cancelar:	') }}
                {{ Form::label('elTotal', $pedido->total, ['id' => 'elTotal']) }}
            </div>
            
            <div class="form-group">
				{{ Form::label('Efectivo', 'Efectivo:	') }}
				{{ Form::radio('tipo_pago', 'Efectivo', true, ['onClick' => 'OcultarDivTarjeta()', 'id' => 'tipo_pago']) }}
				{{ Form::label('Tarjeta', 'Tarjeta:	') }}
				{{ Form::radio('tipo_pago', 'Tarjeta', false, ['onClick' => 'OcultarDivEfectivo()']) }}
            </div>

            <div class="form-group" id="pagoEfectivo">
                {{ Form::label('cantidad', 'Pago en efectivo:') }}
                {{ Form::text('cantidad', Input::old('Cantidad'), array('class' => 'form-control', 'change' => 'OcultarDivTarjeta()')) }}
                {{ Form::label('cambio', 'Cambio:	') }}
                {{ Form::label('elCambio', 'Aca Irá el cambio', ['id' => 'elCambio']) }}
                {{ Form::hidden('ocultoCambio','-1', ['id' => 'ocultoCambio']) }}
            </div>
            
            <div class="form-group" id="pagoTarjeta">
                {{ Form::label('NoTarjeta', 'Numero de Tarjeta:') }}
                {{ Form::text('NoTarjeta', Input::old('NoTarjeta'), array('class' => 'form-control')) }}
                
                {{ Form::label('CodigoSeguridad', 'Codigo Seguridad Tarjeta:	') }}
                {{ Form::text('CodigoSeguridad', Input::old('CodigoSeguridad'), array('class' => 'form-control')) }}
                
                <div class="form-group">
					{{ Form::label('porcentaje', 'Porcentaje Aplicado:	') }}
					{{ Form::label('porcentaje', '4%') }}<br>
					{{ Form::label('recargo', 'Recargo:	') }}
					{{ Form::label('recargo', $pedido->total * 0.04) }}<br>
                </div>
            </div>

            {{ Form::submit('Guardar Pago', array('class' => 'btn btn-primary', 'id' => 'botonSubmit')) }}

			<script type="text/javascript">
				$('#pagoTarjeta').hide()
				
				if(document.getElementById('statusPedido').innerHTML ==  'CANCELADA'){
					document.getElementById("botonSubmit").disabled = true;
				}
				
				function OcultarDivTarjeta() {
					$('#pagoTarjeta').hide()
					$('#pagoEfectivo').show()
				}
				function OcultarDivEfectivo() {
					$('#pagoEfectivo').hide()
					$('#pagoTarjeta').show()
				}
				$('#cantidad').each(function() {
				   var elem = $(this);

				   // Save current value of element
				   elem.data('oldVal', elem.val());

				   // Look for changes in the value
				   elem.bind("propertychange change click keyup input paste", function(event){
					  // If value has changed...
					  if (elem.data('oldVal') != elem.val()) {
					   // Updated stored value
					   elem.data('oldVal', elem.val());

					   // Do action
					   var ingresado = parseInt(elem.val());
					   var gastado = parseInt(document.getElementById('elTotal').innerHTML);
					   var vuelto = ingresado - gastado;
					   document.getElementById('elCambio').innerHTML = vuelto;
					   $('#ocultoCambio').val(vuelto);
					 }
				   });
				 });
			</script>

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop
