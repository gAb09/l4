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

<?php
$head = array(
	'ids' => 'Id',
	'date_emission' => 'Date émission',
	'date_valeur' => 'Date valeur',
	'type_id' => 'Type',
	'banque_id' => 'Banque',
	'libelle' => 'Libellé',
	'montant' => 'Montant',
	'compte_id'=> 'Compte',
	'created_at'=> 'Créé le',
	'updated_at'=> 'Modifié le',
	)
	?>
	<table style="font-size:12px;border:0px">
		<thead>
			@foreach($head as $key => $value)
			<?php
			if ($key == $tri_sur) {
				if ($sens_tri == 'asc') {
					$th_class = 'iconesmall asc tri_selon';
				}else{
					$th_class = 'iconesmall desc tri_selon';
				}
			}else{
				$th_class = '';
			}
			?>
			<th class="{{$th_class}}" id="{{$key}}" onClick="javascript:tri('{{Request::url()}}', {{$key}});">{{$value}}</th>

			@endforeach
		</thead>

		<tbody>
			@foreach($ecritures as $ecriture)
			<tr id ="{{$ecriture->id}}" class="surlignage"
				ondblclick = document.location.href="{{ URL::action('EcritureController@edit', [$ecriture->id]) }}">
				<td>{{ $ecriture->id }}</td>
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
				<td>{{ $ecriture->libelle }}
					@if($ecriture->libelle_detail)
					— {{ $ecriture->libelle_detail }}
					@endif
				</td>
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

	Écritures {{ $ecritures->getFrom() }} à {{ $ecritures->getTo() }} sur un total de {{ $ecritures->getTotal() }}, réparties sur {{ $ecritures->getLastPage() }} pages.
	{{ $ecritures->links() }}
	Le réglage par défaut est de {{PAR_PAGE}} écritures par page.
	<br />Vous pouvez temporairement changer cette valeur ici : 

	<input id="par_page" class="court" type="text" value="{{$ecritures->getPerPage()}}" name="par_page" onChange="javascript:changeParPage('{{Request::url()}}', '{{$tri_sur}}', '{{$sens_tri}}');">


	{{ Form::hidden('prev_tri_sur', $tri_sur, array ('class' => 'long', 'id' => 'prev_tri_sur')) }}

	{{ Form::hidden('sens_tri', $sens_tri, array ('class' => 'long', 'id' => 'sens_tri')) }}

	@stop

	@section('compta/footer')
	@parent
	<h3>  Le footer de ecritures</h3>
	@stop

	@section('script')
	<script src="/assets/js/ecritures.js">
	</script>
	@stop