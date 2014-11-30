@extends('dashboard/views/layout')

@section('contenu')

<div class="" id="show">
	<h5 style="display:inline">Login :</h5>
	{{ Auth::user()->login }}
	<br />
	<h5 style="display:inline">Mail :</h5>
	{{ Auth::user()->mail }}
</div>
@stop

@section('script')
@stop