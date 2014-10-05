@extends('frontend/views/layout')

@section('titre')
@parent


@stop


@section('topcontent1')
		<h1 class="titrepage"> {{$titre_page }}</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

@foreach($banques as $banque)

<h2 class="item">{{ $banque->nom }}</h2>
<h5>Description :</h5><p>{{ $banque->description }}</p>
<p class="label label-primary iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="label label-info iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="label label-success iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="label label-edit iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="label label-warning iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="label label-danger iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-primary iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-info iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-success iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-edit iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-warning iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<p class="badge badge-danger iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<hr />
@endforeach

@stop

@section('zapette')
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-primary btn-zapette iconemedium add">Créer une banque</a>
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-info btn-zapette iconemedium add">Créer une banque</a>
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-success btn-zapette iconemedium add">Créer une banque</a>
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-edit btn-zapette iconemedium add">Créer une banque</a>
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-warning btn-zapette iconemedium add">Créer une banque</a>
		<a href ="{{ URL::action('BanqueController@create') }}" class="btn btn-danger btn-zapette iconemedium add">Créer une banque</a>
@stop

@section('tresorerie/footer')
@parent
<h3>  Le footer de banques</h3>
@stop

