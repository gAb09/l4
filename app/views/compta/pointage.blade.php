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
{{$ecriture->mois_valeur}}
<br />{{$prev_mois}}
@if($ecriture->mois_valeur != $prev_mois)
<table>
	<thead>
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


	<tbody>
		<tr class="ligne_mois" id="{{F::dateUcMoisAnneeNb($ecriture->date_valeur)}}" >
			<td colspan="11"> {{ F::dateUcMoisAnneeNb($ecriture->date_valeur) }}
			</td>
	</tr>
		@include('compta/row')
		@else
				<?php $prev_mois = $ecriture->mois_valeur ?>

		@include('compta/row')
	@endif
	</tbody>
</table>
@endforeach

@stop

@section('footer')

@parent

<h3>  Le footer de recettes_depenses</h3>

@stop
@section('script')
<script src="/assets/js/pointage.js">
</script>
@stop