@section('body')
 onLoad="justifRequis();"
@stop

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
			{{ Form::radio('req_justif', $value0 = 0, ($value0 == $type->req_justif) ? true : false, 
			array ('class' => 'nobr', 'id' => 'req_justif_0', 'onChange' => 'javascript:justifRequis();')) }}

			{{ Form::label('req_justif_0', 'Champ "Justificatif" non requis', array ('class' => ($type->req_justif == 0) ? 'nobr muted' : 'nobr', 'id' => 'label0' ) ) }}
		</div>
		<div>
			{{ Form::radio('req_justif', $value1 = 1, ($value1 == $type->req_justif) ? true : false, 
			array ('class' => 'nobr', 'id' => 'req_justif_1', 'onChange' => 'javascript:justifRequis();')) }}

			{{ Form::label('req_justif_1', 'Champ "Justificatif" requis', array ('class' => ($type->req_justif == 1) ? 'nobr muted' : 'nobr', 'id' => 'label1' ) ) }}
		</div>
<hr />

		<div id="req_justif_div">
			<!-- Separateur -->
			{{ Form::label('sep_justif', 'Séparateur entre le type et le justificatif :', array ('class' => 'nobr')) }}
			{{ Form::text('sep_justif', $type->sep_justif, array ('class' => '')) }}
			(Pour une meilleure présentation, commencez et finir par un espace)
<hr />
		</div>
{{ link_to_action('TypeController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
<br />

@section('script')
<script src="/assets/js/types.js">
</script>
@stop