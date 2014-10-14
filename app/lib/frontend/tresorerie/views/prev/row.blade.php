		<tr id ="{{$ecriture->id}}" class="surlignage {{$ecriture->statut->classe}}" 
			ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">

			<!-- Dates -->
			<td id="valeur{{ $ecriture->id }}" class="info">
				{{ Date::courte($ecriture->date_valeur) }}
				<span>
					Date d’émission : <br />{{ Date::courte($ecriture->date_emission) }}
				</span>
			</td>

			<td>
				{{ $ecriture->type->nom }}
				@if($ecriture->justificatif)
				{{ $ecriture->type->sep_justif }}
				@endif
				{{ $ecriture->justificatif }}
			</td>

			<td>
				{{ $ecriture->libelle }}
			</td>
			<td>
				@if($ecriture->libelle_detail)
				{{ $ecriture->libelle_detail }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ Nbre::francais_insec($ecriture->montant) }}
				@else
				{{ (Nbre::francais_insec($ecriture->montant)) * -1 }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ Nbre::francais_insec($ecriture->montant) }}
				@else
				{{ (Nbre::francais_insec($ecriture->montant)) * -1 }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ Nbre::francais_insec($ecriture->montant) }}
				@else
				{{ (Nbre::francais_insec($ecriture->montant)) * -1 }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ Nbre::francais_insec($ecriture->montant) }}
				@else
				{{ (Nbre::francais_insec($ecriture->montant)) * -1 }}
				@endif
			</td>
			<td class="{{$ecriture->signe->nom_sys}}">
				@if($ecriture->signe_id == 1)
				{{ Nbre::francais_insec($ecriture->montant) }}
				@else
				{{ (Nbre::francais_insec($ecriture->montant)) * -1 }}
				@endif
			</td>
			<td class="icone">
				<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
			</td>
			<td class="icone">
				<a class="iconemedium dupli" href ="{{ URL::action('EcritureController@duplicate', [$ecriture->id]) }}"></a>
			</td>

		</tr>
