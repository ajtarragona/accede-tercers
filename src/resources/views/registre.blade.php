@extends('ajtarragona-web-components::layout/master')

@section('title')
	@lang('Accede Registre')
@endsection

@section('body')
@row
	@col(['size'=>3])
		@include('accede-client::menu')
	@endcol


	@col(['size'=>3])

		@form([
			"action"=>route('accede.searchregister'),
			"method" =>"post"

		])	
		{{-- @dump($registerfilter) --}}

			@select([
				"name"=>"es",
				"required"=>false,
				"label"=>"E/S",
				"options"=>["E"=>"Entrada","S"=>"Sortida"],
				'data'=>['width'=>'100%'],
				'selected' => $registerfilter->es
			])

			@input(["name"=>"eje","label"=>"Ejercicio",'value' =>  $registerfilter->eje ])
			@input(["name"=>"numero","label"=>"Número",'value' =>  $registerfilter->numero ])

			@input(["name"=>"documento","label"=>"DNI",'value' =>  $registerfilter->documento ])

			@button(["type"=>"submit",'size'=>'sm']) @icon("search") Buscar  @endbutton

		@endform				
	@endcol

	@col(['size'=>6])
		@if($registres)
			<table class="table">
				<thead>
					<tr>
						<th>Numero</th>
						<th>Ejercicio</th>
						<th>Fecha</th>
						<th>Explicacion</th>
						<th>Interesado</th>
						<th>Destino</th>
				</thead>
				<tbody>
					@foreach($registres as $anotacion)
						
						<tr>
							<td>{{ $anotacion->numero }}</td>
							<td>{{ $anotacion->eje }}</td>
							<td>{{ $anotacion->fecha }}</td>
							<td>{{ $anotacion->explicacion }}</td>
							<td>
								{{-- @dump($anotacion->getInteresados()) --}}
								@if($interesados=$anotacion->getInteresados())
									@foreach($interesados as $interesado)
										<p>
											{{ $interesado->documento }} | 
											{{ $interesado->nombre }} {{ $interesado->apellido1 }} {{ $interesado->apellido2 }} | 
											{{ $interesado->direccion }}
										</p>
									@endforeach
								@endif
							</td>
							<td>
								@if($anotacion->l_destino)
									@foreach($anotacion->l_destino as $destino)
									{{ $destino["nombre_destino"] }} 
									@endforeach
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		@endif
	@endcol
	
@endrow
@endsection