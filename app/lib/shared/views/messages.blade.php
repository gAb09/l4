<!-- Messages d'erreurs via Errors -->
@if($errors->all())
<div class="alert alert-danger">
	<div style="display:block">
		<i class="icoclose iconemedium" onClick="javascript:masquer(this)"> </i>
	</div>
	<ul class="errors">
		@foreach($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

<!-- Messages d'erreurs via session -->
@if(Session::get('erreur'))
<div class="alert alert-danger">
	<i class="icoclose iconemedium" onClick="javascript:masquer(this)"> </i>
	{{ Session::get('erreur') }}
</div>
@endif


<!-- Messages de succès via session -->
@if(Session::get('success'))
<div class="alert alert-success">
	<i class="icoclose iconemedium" onClick="javascript:masquer(this)"> </i>
	{{ Session::get('success') }}
</div>
@endif

<!-- Messages de succès via session -->
@if(Session::get('info'))
<div class="alert alert-info" >
	<i class="icoclose iconemedium" onClick="javascript:masquer(this)"> </i>
	{{ Session::get('info') }}
</div>
@endif

<script type="text/javascript">
function masquer(icoclose)
{
	var message = icoclose.parentNode.parentNode;
	message.className = message.className + ' masquer';
	// alert(message.className);
	// message.setAttribute('style', 'display:none')
}
</script>