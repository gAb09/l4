<tr 
id="{{ $ecriture->id }}" 
class="surlignage {{$ecriture->statut->classe}}" 
ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

	<!-- Statut -->
	<td>
		{{-- $Statuts ok est le tableau des statuts accessibles depuis cette page --}}
		@if (strpos($statuts_accessibles, (string)$ecriture->statut->rang) !== false)
		{{ Form::open(array('name' => 'pointage', 'action' => ['PointageController@pointage', $ecriture->id, $statuts_accessibles], 'method' => 'post', 'class' => 'pointage')) }}

		{{ Form::hidden('rang', $ecriture->statut->rang, array('id' => 'input', 'class' => '')) }}

		{{ Form::button('', array('class' => 'btn btn-link iconemedium toggle', 'style' => '', 'OnClick' => 'bascule_statut_pointage(this);submit();' )) }}

		{{ form::close() }}
		@endif
	</td>

	<!-- Dates -->
	<td id="valeur{{ $ecriture->id }}" class="info">
		{{ Date::courte($ecriture->date_valeur) }}
		<span>
			Date d’émission : {{ Date::courte($ecriture->date_emission) }}
		</span>

	</td>


	<!-- Libellé -->
	<td>
		{{ $ecriture->libelle }}
		@if($ecriture->libelle_detail)
		— 
		{{ $ecriture->libelle_detail }}
		@endif
	</td>


	<!-- Montant -->
	<td class="{{$ecriture->signe->nom_sys}}">

		@if($ecriture->signe_id == 1)
		{{ Nbre::francais_insec($ecriture->montant) }}
		@endif
	</td>

	<td class="{{$ecriture->signe->nom_sys}}">

		@if($ecriture->signe_id == 2)
		{{ Nbre::francais_insec($ecriture->montant) }}
		@endif
	</td>


	<!-- Solde -->
	<td 
		@if($solde >= 0)
		class="recette">
		@else
		class="depense">
		@endif
		{{ Nbre::francais_insec($solde) }}
	</td>


	<!-- Type -->
	<td>
		{{ $ecriture->type->nom }}
		@if($ecriture->justificatif)
		{{ $ecriture->type->sep_justif }}
		@endif
		{{ $ecriture->justificatif }}
	</td>


	<!-- Banque -->
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


	<!-- Edit -->
	<td>
		<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">
		</a>
	</td>

</tr>
