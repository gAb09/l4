		<tr id ="{{$ecriture->id}}" class="surlignage {{$ecriture->statut->classe}}" 
			ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

	<td>
		{{ Form::open(array('name' => 'pointage', 'action' => ['PointageController@pointage', $ecriture->id, $ecriture->statut->id], 'method' => 'post', 'class' => 'pointage')) }}

		{{ Form::hidden('statut_id', $ecriture->statut_id, array('id' => 'input', 'class' => '')) }}
		

		{{ Form::button('', array('class' => 'btn btn-link iconemedium toggle', 'style' => '', 'OnClick' => 'bascule_pointage(this);submit();' )) }}

		{{ form::close() }}
	</td>
	
			<td>
				{{ $ecriture->mois  }}
				{{ Date::courte($ecriture->date_emission) }}
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
				{{ Date::courte($ecriture->date_valeur) }}
			</td>
			<td>
				({{ $ecriture->compte->numero }}) 
				{{ $ecriture->compte->libelle }}
			</td>
			<td class="icone">
				<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
			</td>
			<td class="icone">
				<a class="iconemedium dupli" href ="{{ URL::action('EcritureController@duplicate', [$ecriture->id]) }}"></a>
			</td>
			<td class="icone">
				@if ($ecriture->ecriture2)
				<a class="iconemedium double" href ="{{ URL::to('tresorerie/recdep/'.$ecriture->ecriture2->banque_id.'#'.$ecriture->ecriture2->id) }}"></a>
				@endif
			</td>

		</tr>
