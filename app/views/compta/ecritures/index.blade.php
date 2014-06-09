@extends('compta/layout')

@section('titre')
@parent
: les écritures

@stop


@section('topcontent1')
		<h1 class="titrepage">{{$titre_page}}</h1>
		{{link_to_action('EcritureController@create', 'Ajouter une écriture', null, ["class" => "badge badge-locale iconemedium add", 'style' => 'font-size:1.1em'])}}
@stop


@section('topcontent2')
		{{link_to_route('compta.ecritures.index', 'Toutes', null, ["class" => "badge badge-locale badge-big"])}}

		@foreach(Banque::all() as $bank)
		{{link_to_route('bank', $bank->nom, $bank->id, ["class" => "badge badge-locale badge-big"])}}
		@endforeach
@stop


@section('contenu')
<table style="font-size:12px;border:0px">
	<thead>
		<th>Id</th>
		<th>Date émission</th>
		<th>Date valeur</th>
		<th>Type</th>
		<th>Banques</th>
		<th>Libellé</th>
		<th>Montant</th>
		<th style="width:200px">Compte</th>
		<th>Créé le</th>
		<th>Modifié le</th>
	</thead>

	<tbody>
		@foreach($ecritures as $ecriture)
		<tr id ="{{$ecriture->id}}" class="surlignage"
		ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">
		<td>{{ $ecriture->id }}
			<td>{{ F::dateCourteNb($ecriture->date_emission) }}</td>
			<td>{{ F::dateCourteNb($ecriture->date_valeur) }}</td>
			<td>{{ $ecriture->type->nom}}
				@if($ecriture->justificatif)<br />{{$ecriture->type->sep_justif}}{{$ecriture->justificatif}}@endif
			</td>
			<td><b>{{ $ecriture->banque->nom }}</b>
				@if($ecriture->double_flag)
					@if($ecriture->signe->signe == -1)
					<br />&rarr; 
					@else
					<br />&larr; 
					@endif
					<small>{{ $ecriture->ecriture2->banque->nom }}</small>
				@endif
			</td>
			<td>{{ $ecriture->libelle }} —
				@if($ecriture->libelle_detail)@endif
				{{ $ecriture->libelle_detail }}</td>
				<td class="{{ $ecriture->signe->nom_sys }}">{{ F::insecable($ecriture->montant) }}</td>
				<td>{{ $ecriture->compte->numero }}<br />({{ $ecriture->compte->libelle }})</td>
				<td>{{ F::dateCourteNb($ecriture->created_at) }}</td>
				<td>{{ F::dateCourteNb($ecriture->updated_at) }}</td>
				<td>
					<a class="iconemedium edit" href ="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}"></a>
				</td>
			<td>
				@if ($ecriture->ecriture2)
				<a class="iconemedium double" href ="{{ URL::to('compta/banque/'.$ecriture->ecriture2->banque_id.'#'.$ecriture->ecriture2->id) }}"></a>
				@endif
			</td>

				@endforeach
			</tr>
		</tbody>
	</table>
	@stop

	@section('compta/footer')
	@parent
	<h3>  Le footer de ecritures</h3>

	@stop