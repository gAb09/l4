@extends('compta/layout')

@section('titre')
@parent
: pointage

@stop


@section('topcontent1')
<h1 class="titrepage">Pointage de “{{ $banque }}”</h1>
@stop


@section('topcontent2')
@foreach(Banque::all() as $bank)
<a href ="{{ URL::route('pointage', $bank->id) }}" class="badge badge-locale badge-big ">{{ $bank->nom }}</a>


@endforeach
@stop


@section('contenu')

@foreach($ecritures as $ecriture)

@if($ecriture->mois_valeur != $prev_mois)
<table>
	<caption class="ligne_mois" id="{{F::dateUcMoisAnneeNb($ecriture->date_valeur)}}" ondblclick="javascript:volet(this);">
		{{ F::dateUcMoisAnneeNb($ecriture->date_valeur) }}

</caption>
	<thead class="replie">
		<th>
			Statut
		</th>
		<th>
			Date de valeur
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
			Solde
		</th>
		<th>
			Type
		</th>
		<th>
			Banque(s)
		</th>
		<th>
			Date d'émission
		</th>
		<th>
			
		</th>
	</thead>


	<tbody class="replie">
		@include('compta/pointage/row')
		<?php $prev_mois = $ecriture->mois_valeur ?>
		@else

		@include('compta/pointage/row')
		@endif
		@endforeach
	</tbody>
</table>

@stop

@section('footer')

@parent

<h3>  Le footer de recettes_depenses</h3>

@stop
@section('script')
<script src="/assets/js/pointage.js">
</script>
@stop