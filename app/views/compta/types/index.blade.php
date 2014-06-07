@extends('compta/layout')

@section('titre')
@parent
: les types d'écriture

@stop


@section('topcontent1')
<h1 class="titrepage">Les types d'écriture
</h1>
@stop


@section('topcontent2')
<a href ="{{ URL::route('compta.types.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter un nouveau type</a>
@stop


@section('contenu')

@foreach($types as $type)

@foreach($type['attributes'] as $att)
{{$att}}
@endforeach
<hr />
<h3>{{ $type->nom }} <small>(id n° {{ $type->id }})</small></h3>
<p>• Séparateur : “{{ $type->sep_justif }}”</p>
<p>• {{ $type->description }}</p>
@if($type->req_justif)<p>• Ce type nécessitera de préciser un “Justificatif” lors de la saisie d'une écriture.</p>@endif
<p class="badge badge-locale iconesmall edit">
	{{link_to_route('compta.types.edit', 'Modifier ce type', $type->id)}}
</p>
@endforeach

@stop

@section('footer')
@parent
<h3>  Le footer de types</h3>

@stop
