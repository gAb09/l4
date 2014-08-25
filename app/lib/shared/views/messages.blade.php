<!-- Messages d'erreurs via Errors -->
@if($errors->all())
<div class="alert-danger">
	<ul class="errors">
		@foreach($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

<!-- Messages d'erreurs via session -->
@if(Session::get('erreur'))
<div class="alert-danger">
	{{ Session::get('erreur') }}
</div>
@endif


<!-- Messages de succès -->
@if(Session::get('success'))
<div class="alert-success">
	{{ Session::get('success') }}
</div>
@endif
