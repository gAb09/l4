@extends('tresorerie/views/layout')

@section('titre')
@parent
: les types d'écriture

@stop


@section('topcontent1')
<h1 class="titrepage">Les types d'écriture
</h1>
@stop


@section('topcontent2')
<a href ="{{ URL::route('tresorerie.types.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter un nouveau type</a>
@stop


@section('contenu')

@foreach($types as $type)

<hr />
<h3>{{ $type->nom }} <small>(id n° {{ $type->id }})</small></h3>

<p>• Description :<br />{{ $type->description }}</p>

@if($type->req_justif)
<p>• Ce type nécessitera de préciser un justificatif lors de la saisie d'une écriture.
<br />Le séparateur est : “{{ $type->sep_justif }}”
</p>
@endif
</p>

<p class="badge badge-locale iconesmall edit">
	{{link_to_action('TypeController@edit', 'Modifier ce type', $type->id)}}
</p>
@endforeach

@stop

@section('footer')
@parent
<h3>  Le footer de types</h3>

@stop
