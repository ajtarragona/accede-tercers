@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede: Tercer')
@endsection


@section('breadcrumb')

    @breadcrumb([
    	'items'=> [
    		['name'=>__("Tercers"), "url"=>route('accede.tercer.search')],
    		['name'=> "Tercer ".$tercer->codigoTercero]
    	]

    ])
	
@endsection
            


@section('actions')
	<label for="save-tercer-btn" role="button" class="btn btn-primary btn-sm" tabindex="1">
		 @icon('save') @lang('Guardar')
	</label>

	@form([
		'method'=>'DELETE',
		'class' => 'd-inline-block',
		'action'=>route('accede.tercer.delete',[$tercer->codigoTercero]),
		'data'=>['confirm'=>__('S&apos;esborrarà definitivament el tercer. N&apos;estàs segur?')]
	])
		@button(['type'=>'submit','size'=>'sm','style'=>'danger']) @icon('disk') @icon('trash') Eliminar tercer @endbutton
	@endform
@endsection



@section('menu')
   @include('accede-client::menu')
@endsection



@section('body')


@row
	@col(['size'=>5])
		@form([
			'method'=>'POST',
			'action'=>route('accede.tercer.save',[$tercer->codigoTercero])
		])
	
			@include('accede-client::tercers._fields',["readonly"=>true])
		
			@button(['type'=>'submit','size'=>'sm','id'=>'save-tercer-btn','hidden'=>true]) @icon('disk') Guardar @endbutton

		@endform
		
	@endcol


	@col(['size'=>7])
		@include('accede-client::tercers._domicilis',["domicilis"=>$tercer->getDomicilis()])

		    <a href="{{ route('accede.tercer.domicilis.addmodal',[$tercer->codigoTercero]) }}" class="btn btn-light btn-sm tgn-modal-opener" data-size="lg">@icon('plus') Afegir domicili</a>


	@endcol
@endrow

@endsection
