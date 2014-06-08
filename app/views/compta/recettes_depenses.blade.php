@extends('compta/layout')

@section('titre')
@parent
: recettes_depenses

@stop


@section('topcontent1')
<h1 class="titrepage">Recettes/Dépenses de “{{ $banque }}”</h1>
<a href ="{{ URL::route('compta.ecritures.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter une écriture</a>
@stop


@section('topcontent2')
@foreach(Banque::all() as $bank)
<a href ="{{ URL::to("compta/recdep/$bank->id") }}" class="badge badge-locale badge-big ">{{ $bank->nom }}</a>
@endforeach
@stop


@section('contenu')
<table style="font-size:12px;border:0px">
	<thead>
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
	</thead>

	<tbody>
		@foreach($ecritures as $ecriture)

		@if($ecriture->mois_emission != $prev_mois)
		<tr class="ligne_mois"><td colspan="9"> {{ F::dateUcMoisAnneeNb($ecriture->date_emission) }}</td></tr>
		<?php $prev_mois = $ecriture->mois_emission ?>
		@endif

		<tr id ="{{$ecriture->id}}" class="surlignage {{$ecriture->statut->classe}}" 
			ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

			<td>
				{{ $ecriture->mois  }}
				{{ F::dateCourteNb($ecriture->date_emission) }}
			</td>
			<td>
				{{ $ecriture->libelle }}
				@if($ecriture->libelle_detail)
				— 
				{{ $ecriture->libelle_detail }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ F::nbre($ecriture->montant) }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 2)
				{{ F::nbre($ecriture->montant) }}
				@endif
			</td>
			<td>
				{{ $ecriture->type->nom }}
				@if($ecriture->justificatif)
				{{ $ecriture->type->sep_justif }}
				@endif
				{{ $ecriture->justificatif }}
			</td>
			<td>
				{{ $ecriture->banque->nom }}
				@if($ecriture->double_flag)
				@if($ecriture->signe->signe == -1)
				<br />&rarr; 
				@else
				<br />&larr; 
				@endif
				<small>{{ $ecriture->ecriture2->banque->nom }}</small>
				@endif
			</td>
			<td>
				{{ F::dateCourteNb($ecriture->date_valeur) }}
			</td>
			<td>
				{{ $ecriture->compte->libelle }}
			</td>
			<td>
				<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
			</td>
			<td>
				@if ($ecriture->ecriture2)
				<a class="iconemedium double" href ="{{ URL::to('compta/recdep/'.$ecriture->ecriture2->banque_id.'#'.$ecriture->ecriture2->id) }}"></a>
				@endif
			</td>

		</tr>

		@endforeach
	</tbody>
</table>
@stop

@section('footer')

@parent

<h3>  Le footer de recettes_depenses</h3>

@stop