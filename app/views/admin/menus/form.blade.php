{{ Form::label('etiquette', 'Étiquette', array ('class' => '')) }}
{{ Form::text('etiquette', null, array('class' => '')) }}

{{ Form::label('parent_id', 'Menu parent', array ('class' => '')) }}
{{ Form::select('parent_id', Menu::listForInputSelect()) }}

{{ Form::label('rang', 'Rang', array ('class' => '')) }}
{{ Form::text('rang', null, array ('class' => 'input-mini')) }}

<br />
{{ Form::label('publication', 'Publié', array ('class' => 'nobr')) }}
{{ Form::checkbox('publication', 1) }}

<br />
<br />
{{ Form::label('route', 'Route', array ('class' => '')) }}
{{ Form::text('route', null, array ('class' => '')) }}

{{ Form::label('nom_sys', 'Nom système', array ('class' => '')) }}
{{ Form::text('nom_sys', null, array ('class' => 'from')) }}

{{ Form::label('description', 'Description (facultative)', array ('class' => '')) }}
{{ Form::textarea('description', null, array ('class' => '')) }}