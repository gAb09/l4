@extends('shared/views/layout')

@section('titre')
@parent
: les statuts

@stop


@section('topcontent1')
		<h1 class="titrepage">Lexique des statuts</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')
<?php
$statuts = Statut::all();
?>
<hr />

@foreach($statuts as $statut)

<h2 class="item">{{ $statut->id }} - {{ $statut->nom }}</h2>
<p>{{ $statut->description }}</p>
<hr class="filetfin"/>

@endforeach

@stop

@section('tresorerie/footer')
@parent
<h3>  Le footer de statuts</h3>
@stop

