<tr 
id="{{ $ecriture->id }}" 
class="surlignage {{$ecriture->statut->classe}}" 
	ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

<td>
	{{-- $Statuts ok est le tableau des statuts accessibles depuis cette page --}}
	@if (strpos($statuts_ok, (string)$ecriture->statut->rang) !== false)
	{{ Form::open(array('name' => 'pointage', 'action' => ['PointageController@pointage', $ecriture->id, $statuts_ok], 'method' => 'post', 'class' => 'pointage')) }}

	{{ Form::hidden('rang', $ecriture->statut->rang, array('id' => 'input', 'class' => '')) }}

	{{ Form::button('', array('class' => 'btn btn-link iconemedium toggle', 'style' => '', 'OnClick' => 'bascule_statut_pointage(this);submit();' )) }}

	{{ form::close() }}
	@endif
</td>

<td>
	{{ $ecriture->mois  }}
	{{ Date::courte($ecriture->date_valeur) }}
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
	{{ Nbre::francais_insec($ecriture->montant) }}
	@endif
</td>

<td class="{{$ecriture->signe->nom_sys}}">

	@if($ecriture->signe_id == 2)
	{{ Nbre::francais_insec($ecriture->montant) }}
	@endif
</td>


@if($solde >= 0)
<td class="recette">
	@else
	<td class="depense">
		@endif
		{{ Nbre::francais_insec($solde) }}
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
		{{ Date::courte($ecriture->date_emission) }}
	</td>

	<td>
		<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
	</td>

</tr>
