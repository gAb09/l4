<div class="nav-collapse collapse">
	<ul class="nav">
		@foreach($sections as $section)
		@if ($section->nom_sys == Request::segment(1))
		<li class ="active">
			@else
			<li>
				@endif
				<a href="{{ URL::to($section->nom_sys) }}"> {{ $section->etiquette }}</a>
			</li>
			@endforeach
			<li>
				<a href="{{ URL::to($section->nom_sys) }}"> {{DB::getDatabaseName()}}</a>
			</li>

		</ul>
	</div>
