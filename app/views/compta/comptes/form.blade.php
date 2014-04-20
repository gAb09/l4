		<!-- liste d'inputs commune au vues CREATE et EDIT -->
<div style="float:left">
	<!-- Numéro -->
	{{ Form::label('numero', 'Numéro', array ('class' => '')) }}
	{{ Form::text('numero', $compte->numero, array ('class' => '', 'style' => 'width:100px;margin-right:10px')) }}
</div>

<div>
	<!-- Libellé -->
	{{ Form::label('libelle', 'Libellé', array ('class' => '')) }}
	{{ Form::text('libelle', $compte->libelle, array ('class' => '', 'style' => 'width:800px')) }}
</div>

<div style="float:left">
	<!-- Compte actif -->
	{{ Form::checkbox('actif', $compte->actif, $compte->actif, array ('class' => 'nobr')) }}
	{{ Form::label('actif', 'Compte actif', array ('class' => 'nobr')) }}
</div>

<div>
	<!-- Compte créé lmh -->
	{{ Form::checkbox('actif', $compte->lmh, $compte->lmh, array ('class' => 'nobr')) }}
	{{ Form::label('lmh', 'Compte spécifique La Mauvaise Herbe', array ('class' => 'nobr')) }}
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

<div>
	<!-- Descrition lmh (La Mauvaise Herbe) -->
	{{ Form::label('description_lmh', 'Description maison', array ('class' => '')) }}
	{{ Form::textarea('description_lmh', $compte->description_lmh, array ('class' => '', 'style' => 'width:450px')) }}
</div>

