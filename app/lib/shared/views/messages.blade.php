<!-- Messages d'erreurs via Errors -->
@if($errors->all())
<div class="alert alert-danger" onClick="javascript:setAttribute('style', 'display:none')">
	<ul class="errors">
		@foreach($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

<!-- Messages d'erreurs via session -->
@if(Session::get('erreur'))
<div class="alert alert-danger" onClick="javascript:setAttribute('style', 'display:none')">
	{{ Session::get('erreur') }}
</div>
@endif


<!-- Messages de succès via session -->
@if(Session::get('success'))
<div class="alert alert-success" onClick="javascript:setAttribute('style', 'display:none')">
	{{ Session::get('success') }}
</div>
@endif

<!-- Messages de succès via session -->
@if(Session::get('info'))
<div class="alert alert-info" onClick="javascript:setAttribute('style', 'display:none')">
	{{ Session::get('info') }}
</div>
@endif
