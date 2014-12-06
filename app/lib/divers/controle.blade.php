@extends('dashboard/views/layout')

@section('tresorerie/footer')
@parent
<h1>Session :</h1>
var_dump($_SESSION);

<h1>Path :</h1>
$path = Request::path();

<h1>cleanPathNotes :</h1>
echo Notes::cleanPathNotes($path);

@stop
