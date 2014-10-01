@extends('frontend/views/layout')

@section('titre')
@parent
: recettes_depenses

@stop


@section('topcontent1')
<h1 class="titrepage">Prévisionnel</h1>
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
	<caption class="ligne_mois" id="{{$ecriture->date_valeur}}" onclick="javascript:volet(this);">
		{{ ucfirst(Date::MoisAnneeInsec($ecriture->date_valeur)) }}
	</caption>

	<thead class="replie" id="tetiere{{$ecriture->mois_classement}}">
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
			Date de valeur
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

<a href ="{{ URL::route('tresorerie.ecritures.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter une écriture</a>

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
		var curhead = document.getElementById("corps"+mois);
		var curcorps = document.getElementById("tetiere"+mois);
		curhead.className = "";
		curcorps.className = "";
	}

</script>

<script src="/assets/js/volets.js">
</script>

<script src="/assets/js/pointage.js">
</script>

@stop