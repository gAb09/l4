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
<a href ="{{ URL::to("compta/pointage/banque/$bank->id") }}" class="badge badge-locale badge_haut_page ">{{ $bank->nom }}</a>
@endforeach
@stop


@section('contenu')

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
			Type
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
			Banque(s)
		</th>
		<th>
			Date d'émission
		</th>
		<th>
			
		</th>
	</thead>

	<tbody>
		@foreach($ecritures as $ecriture)
		@if($ecriture->mois_valeur != $prev_mois)
		<tr class="ligne_mois" id="{{F::dateUcMoisAnneeNb($ecriture->date_valeur)}}" >
			<td colspan="11"> {{ F::dateUcMoisAnneeNb($ecriture->date_valeur) }}
			</td>
		</tr>
		<?php $prev_mois = $ecriture->mois_valeur ?>
		@endif

		<tr id="ligne{{ $ecriture->id }}" 
			class="surlignage {{$ecriture->statut->classe}}" 
			ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

			<td>
				{{ Form::open(array('name' => 'pointage', 'action' => ['PointageController@pointage', $ecriture->id, $ecriture->statut->id], 'method' => 'post', 'class' => 'pointage')) }}

				{{ Form::hidden('statut_id', $ecriture->statut_id, array('id' => 'input', 'class' => '')) }}
				

				{{ Form::button('', array('class' => 'btn btn-link iconemedium toggle', 'style' => '', 'OnClick' => 'bascule_pointage(this);submit();' )) }}

				{{ form::close() }}
			</td>
			
			<td>
				{{ $ecriture->mois  }}
				{{ F::dateCourteNb($ecriture->date_valeur) }}
			</td>
			<td>
				{{ $ecriture->libelle }}
				@if($ecriture->libelle_detail)
				— 
				{{ $ecriture->libelle_detail }}
				@endif
			</td>
			<td>
				{{ $ecriture->type->nom }}
				@if($ecriture->type_justif)
				{{ $ecriture->type->sep_justif }}
				@endif
				{{ $ecriture->type_justif }}
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ F::nbre($ecriture->montant) }}
				<?php $solde = $solde - $ecriture->montant; ?>
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 2)
				{{ F::nbre($ecriture->montant) }}
				<?php $solde = $solde + $ecriture->montant; ?>
				@endif
			</td>
			@if($solde >= 0)
			<td class="recette">
				@else
				<td class="depense">
					@endif
					{{ number_format($solde, 2, ',', '&nbsp') }}
				</td>
			<td>{{ $ecriture->banque->nom }}
				@if($ecriture->type->req_banque2)
					@if($ecriture->signe->signe == -1)
					<br />&rarr; 
					@else
					<br />&larr; 
					@endif
					<small>{{ $ecriture->banque2->nom }}</small>
				@endif
			</td>
				<td>
					{{ F::dateCourteNb($ecriture->date_emission) }}
				</td>
				<td>
					<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
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