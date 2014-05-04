@section('body')
onLoad="publication();"
@stop

{{ Form::label('etiquette', 'Étiquette', array ('class' => '')) }}
{{ Form::text('etiquette', null, array('class' => '')) }}

{{ Form::label('parent_id', 'Menu parent', array ('class' => '')) }}
{{ Form::select('parent_id', Menu::listForInputSelect()) }}

{{ Form::label('rang', 'Rang', array ('class' => '')) }}
{{ Form::text('rang', null, array ('class' => 'input-mini')) }}

<div>
	{{ Form::radio('publication', $value0 = 0, ($value0 == $menu->publication) ? true : false, array ('class' => 'nobr', 'id' => 'publication_0', 'onChange' => 'javascript:publication();alert("test");')) }}
	{{ Form::label('publication_0', 'Masqué', array ('class' => ($menu->publication == 0) ? 'nobr muted' : 'nobr', 'id' => 'publication0' ) ) }}
</div>
<div>
	{{ Form::radio('publication', $value1 = 1, ($value1 == $menu->publication) ? true : false, array ('class' => 'nobr', 'id' => 'publication_1', 'onChange' => 'javascript:publication();')) }}
	{{ Form::label('publication_1', 'Publié', array ('class' => ($menu->publication == 1) ? 'nobr muted' : 'nobr', 'id' => 'publication1' ) ) }}
</div>

<br />
{{ Form::label('route', 'Route', array ('class' => '')) }}
{{ Form::text('route', null, array ('class' => '')) }}

{{ Form::label('nom_sys', 'Nom système', array ('class' => '')) }}
{{ Form::text('nom_sys', null, array ('class' => 'from')) }}

{{ Form::label('description', 'Description (facultative)', array ('class' => '')) }}
{{ Form::textarea('description', null, array ('class' => '')) }}



@section('script')
<script src="/assets/js/menus.js">
</script>
@stop