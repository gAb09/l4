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
				{{ F::insecable($ecriture->montant) }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 2)
				{{ F::insecable($ecriture->montant) }}
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
				({{ $ecriture->compte->numero }}) 
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
