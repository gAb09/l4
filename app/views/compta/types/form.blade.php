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
			<!-- "Justificatif" requis -->
			{{ Form::checkbox('req_justif', $type->req_justif, $type->req_justif, array ('class' => 'nobr', 'id' => 'req_justif_checkbox', 'onChange' => 'javascript:justifRequis(this);')) }}
			{{ Form::label('req_justif', 'Champ "Justificatif" requis', array ('class' => 'nobr', 'id' => 'req_justif_label' ) ) }}
		</div>
<hr />

		<div id="req_justif">
			<!-- Separateur -->
			{{ Form::label('sep_justif', 'Séparateur entre le type et le justificatif :', array ('class' => 'nobr')) }}
			{{ Form::text('sep_justif', $type->sep_justif, array ('class' => '')) }}
<hr />
		</div>
{{ link_to_action('TypeController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
<br />