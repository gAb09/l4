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

@foreach($ecritures as $ecriture)

@if($ecriture->mois_emission != $prev_mois)

<table>
	<caption class="ligne_mois" id="{{$ecriture->date_emission}}" onclick="javascript:volet(this);">
		{{ F::dateUcMoisAnneeNb($ecriture->date_emission) }}
	</caption>

	<thead class="replie" id="tetiere{{$ecriture->mois_emission}}">
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

	<tbody class="replie" id="corps{{$ecriture->mois_emission}}">
		<?php $prev_mois = $ecriture->mois_emission ?>
		@include('compta/recdep/row')
		@else

		@include('compta/recdep/row')
		@endif
		@endforeach

	</tbody>

</table>

@stop

@section('footer')

@parent

<h3>  Le footer de recettes_depenses</h3>

@stop

@section('script')

<script type="text/javascript">

<?php
if( $mois = Session::get('mois') ){
echo 'var mois = '.$mois.';';
}else{
echo 'var mois = "";';
}
?>

</script>

<script src="/assets/js/volets.js">
</script>

@stop