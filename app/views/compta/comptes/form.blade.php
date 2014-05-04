@section('body')
 onLoad="togle_lmh();togle_actif();"
@stop

<!-- liste d'inputs commune au vues CREATE et EDIT -->
@if($compte->lmh)
<div style="float:left">
	<!-- Numéro -->
	{{ Form::label('numero', 'Numéro', array ('class' => '')) }}
	{{ Form::text('numero', $compte->numero, array ('class' => '', 'style' => 'width:100px;margin-right:10px')) }}
</div>
	@endif

<div>
	<!-- Libellé -->
	{{ Form::label('libelle', 'Libellé', array ('class' => '')) }}
	{{ Form::text('libelle', $compte->libelle, array ('class' => '', 'style' => 'width:800px')) }}
</div>

<div>
	<!-- Compte actif -->
	{{ Form::checkbox('actif', 1, $compte->actif, array ('class' => 'nobr', 'id' => 'actif_check', 'onChange' => 'javascript:togle_actif(this)')) }}
	{{ Form::label('actif', '', array ('class' => 'nobr', 'id' => 'actif_label')) }}
</div>

<div>
	<!-- Compte créé lmh -->
	{{ Form::checkbox('lmh', 1, $compte->lmh, array ('class' => 'nobr', 'id' => 'lmh_check', 'onChange' => 'javascript:togle_lmh(this)')) }}
	{{ Form::label('lmh', '', array ('class' => 'nobr', 'id' => 'lmh_label')) }}
</div>

<div>
	<!-- Descrition officelle -->
	@if (Auth::check())
	{{ Form::label('description_officiel', 'Description (Wikipédia)', array ('class' => '')) }}
	{{ Form::textarea('description_officiel', $compte->description_officiel, array ('class' => '', 'style' => 'width:900px')) }}
	@else
	<p>{{$compte->description_officiel}}</p>
	@endif
</div>

<div style="float:left">
	<!-- Descrition complémentaire -->
	{{ Form::label('description_comp', 'Description complémentaire', array ('class' => '')) }}
	{{ Form::textarea('description_comp', $compte->description_comp, array ('class' => '', 'style' => 'width:450px')) }}
</div>

<div id="description_lmh">
	<!-- Descrition lmh (La Mauvaise Herbe) -->
	{{ Form::label('description_lmh', 'Description maison', array ('class' => '')) }}
	{{ Form::textarea('description_lmh', $compte->description_lmh, array ('class' => '', 'style' => 'width:450px')) }}
</div>
<p>
	{{ link_to_action('CompteController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>

@section('script')
<script src="/assets/js/comptes.js">
</script>
@stop