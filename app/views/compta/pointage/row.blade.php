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
	<td class="{{$ecriture->signe->nom_sys}}">
		@if($ecriture->signe_id == 1)
		{{ F::insecable($ecriture->montant) }}
		<?php $solde = $solde - $ecriture->montant; ?>
		@endif
	</td>
	<td class="{{$ecriture->signe->nom_sys}}">
		@if($ecriture->signe_id == 2)
		{{ F::insecable($ecriture->montant) }}
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
		<td>
			{{ $ecriture->type->nom }}
			@if($ecriture->justificatif)
			{{ $ecriture->type->sep_justif }}
			@endif
			{{ $ecriture->justificatif }}
		</td>
		<td>{{ $ecriture->banque->nom }}
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
			{{ F::dateCourteNb($ecriture->date_emission) }}
		</td>
		<td>
			<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
		</td>
	</tr>
