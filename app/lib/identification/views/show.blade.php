@extends('frontend/views/layout')

@section('contenu')
<div>
	<h5 style="display:inline">Login :</h5>
	{{ Auth::user()->login }}
	<br />
	<h5 style="display:inline">Mail :</h5>
	{{ Auth::user()->mail }}
</div>
@stop

@section('script')
@stop