@extends('frontend/views/layout')

@section('titre')
@parent
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

@if($ecriture->mois_nouveau)

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

		@endif
		
		@include('frontend/tresorerie/views/recdep/row')

		@if($ecriture->last)
		<tr class="soldes">
			<td colspan="3">
			</td>
			<td class ='depense'>
				{{$ecriture->solde_dep}}
			</td>
			<td class='recette'>
				{{$ecriture->solde_rec}}
			</td>
			<td colspan="4">
				Solde du mois : 
				@if($ecriture->solde < 0)
				<span class="depense">{{$ecriture->solde}}</span>
				@else
				<span class="recette">{{$ecriture->solde}}</span>
				@endif
			</td>
		</tr>
		@endif

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

<!-- Transmettre le tableau de correspondance classe/id pour les statuts -->
<script type="text/javascript">

<?php
echo "var classe_statut_selon_id = ".$classe_statut_selon_id.";";
echo "var statuts_accessibles = '".$statuts_accessibles."';";
?>

</script>


<!-- aFa Rédiger commentaire -->
<script type="text/javascript">

<?php
if( $mois = Session::get('mois') ){
	echo 'var mois = "'.$mois.'";';
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

<script src="/assets/js/incrementeStatuts.js">
</script>

@stop