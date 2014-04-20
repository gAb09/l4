@if(!empty($note->aide))
<section class="coulisse">
	<div class="onglet">Aide
	</div>
	<br /><p class="coulisse_text">{{ $note->aide }}</p>
</section>
@endif

<section class="coulisse dev">
	<div class="onglet">Développement
	</div>
	@if(!isset($note))
		<p id="show_form_creer" class="" onClick="show_form_creer();">Créer</p>
		<div id="coulisse_form_creer">
			{{ Form::open(array('url' => 'compta/notes', 'method' => 'post')) }}
			{{ Form::hidden('path', Request::path(), array ('class' => '', 'style' => 'width:45%')) }}<br />

			{{ Form::label('aide', 'Aide') }}
			{{ Form::textarea('aide', '', array ('class' => '')) }}

			{{ Form::label('dev', 'Développement') }}
			{{ Form::textarea('dev', '', array ('class' => '')) }}

			<br />{{ Form::submit('Enregistrer') }}
			{{ Form::close() }}
		</div>
	@else
		@if(isset($note->dev))
		<br /><p class="coulisse_text">{{ $note->dev }}</p>
		@endif

		<hr /><p id="show_form_editer" class="" onClick="show_form_editer();">Éditer</p>

		<div id="coulisse_form_editer">
			{{ Form::label('aide', 'Aide') }}
			{{ Form::open(array('name' => 'coulisse_form', 'url' => 'compta/notes/'.$note->id, 'method' => 'put')) }}

			@if(isset($note->aide))
				{{ Form::textarea('aide', $note->aide, array ('class' => '')) }}
			@else
				{{ Form::textarea('aide', '', array ('class' => '', 'style' => 'width:45%')) }}
			@endif

			{{ Form::label('dev', 'Développement') }}
			@if(isset($note->dev))
				{{ Form::textarea('dev', $note->dev, array ('class' => '')) }}
			@else
				{{ Form::textarea('dev', '', array ('class' => '', 'style' => 'width:45%')) }}
			@endif
			
			<br />{{ Form::submit('Enregistrer') }}
			{{ Form::close() }}
		</div>
	@endif
</section>


