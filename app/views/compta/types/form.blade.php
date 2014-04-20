		<!-- liste d'inputs commune au vues CREATE et EDIT -->
		<div>
			<!-- Nom -->
			{{ Form::label('nom', 'Nom', array ('class' => '')) }}
			{{ Form::text('nom', $type->nom, array ('class' => '')) }}
		</div>

		<div>
			<!-- Description -->
			{{ Form::label('description', 'Description', array ('class' => '')) }}
			{{ Form::textarea('description', $type->description, array ('class' => '')) }}
		</div>
<hr />
		<div>
			<!-- "Banque destination" requis -->
			{{ Form::checkbox('req_banque2', $type->req_banque2, $type->req_banque2, array ('class' => 'nobr')) }}
			{{ Form::label('req_banque2', 'Champ "Banque de destination" requis', array ('class' => 'nobr')) }}
		</div>
<hr />
		<div>
			<!-- "Justificatif" requis -->
			{{ Form::checkbox('req_justif', $type->req_justif, $type->req_justif, array ('class' => 'nobr')) }}
			{{ Form::label('req_justif', 'Champ "Justificatif" requis', array ('class' => 'nobr')) }}
		</div>

		<div>
			<!-- Separateur -->
			{{ Form::label('sep_justif', 'Séparateur', array ('class' => 'nobr')) }}
			{{ Form::text('sep_justif', $type->sep_justif, array ('class' => '')) }}
		</div>
