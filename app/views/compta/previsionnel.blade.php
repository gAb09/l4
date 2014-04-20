@extends('compta/layout')

@section('titre')
@parent
 : Complément du titre de la page = Prévisionnel

@stop


@section('topcontent1')
		<h1 class="titrepage">Le contenu de Prévisionnel</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')


<?php
$json = file_get_contents('/Users/brunogabiot/Sites/Bruno/app/views/compta/composer.json');
$txt = json_decode($json, true);
var_dump($txt);
?>
@stop

@section('footer')
@parent
<h3>  Le footer de Prévisionnel</h3>
@stop
