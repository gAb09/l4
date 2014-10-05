@extends('frontend/views/layout')

<?php $titre_page = 'Recettes/Dépenses de “'.$banque.'”' ?>

@section('titre')
@parent
: recettes_depenses

@stop


@section('topcontent1')
<h1 class="titrepage">{{ $titre_page }}</h1>
@stop


@section('topcontent2')
@foreach(Banque::all() as $bank)
<a href ="{{ URL::to("tresorerie/recdep/$bank->id") }}" class="badge badge-locale badge-big ">{{ $bank->nom }}</a>
@endforeach
@stop


@section('contenu')

@foreach($ecritures as $ecriture)

@if($ecriture->mois_classement != $prev_mois)

<table>
	<caption class="ligne_mois" id="{{$ecriture->mois_classement}}" onclick="javascript:volet(this);">
		{{ ucfirst(Date::MoisAnneeInsec($ecriture->date_emission)) }}
	</caption>

	<thead class="replie" id="tetiere{{$ecriture->mois_classement}}" >
		<th style="width:10px">
			Statut
		</th>
		<th>
			Date d'émission
		</th>
		<th>
			Libellé
		</th>
		<th>
			Dépenses
		</th>
		<th>
			Recettes
		</th>
		<th>
			Type
		</th>
		<th>
			Banque(s)
		</th>
		<th>
			Compte
		</th>
		<th class="icone">
			Edit
		</th>
		<th class="icone">
			Dupli
		</th>
		<th class="icone">
			Liée
		</th>
	</thead>

	<tbody class="replie" id="corps{{$ecriture->mois_classement}}">
		<?php $prev_mois = $ecriture->mois_classement ?>

		@endif
		@include('frontend/tresorerie/views/recdep/row')
		@endforeach

	</tbody>

</table>

@stop




@section('footer')

@parent

<h3>  Le footer de recettes_depenses</h3>

@stop


@section('zapette')

	{{link_to_action('EcritureController@create', 'Ajouter une écriture', null, ["class" => "btn btn-success iconemedium add"])}}

@stop




@section('script')

<script type="text/javascript">

<?php
if( $mois = Session::get('mois') ){
	echo 'var mois = '.$mois.';';
}else{
	echo 'var mois = "";';
}
?>
if (mois) {
	var curhead = document.getElementById("tetiere"+mois);
	var curcorps = document.getElementById("corps"+mois);
	curhead.className = "";
	curcorps.className = "";
}

</script>

<script src="/assets/js/volets.js">
</script>

<script src="/assets/js/pointage.js">
</script>

@stop