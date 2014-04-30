{{ Form::label('nom', 'Nom', array ('class' => '')) }}
{{ Form::text('nom', null, array ('class' => '')) }}

{{ Form::label('description', 'Description (facultative)', array ('class' => '')) }}
{{ Form::textarea('description', null, array ('class' => '')) }}

<p>
	{{ link_to_action('BanqueController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>