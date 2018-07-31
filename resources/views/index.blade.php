@extends('layouts.app')

@section('content')
	<!-- データベースにidは入っているが、表示しようとすると0扱い -->
	@foreach ($champions as $champion)
		<div style="display: inline-block;">
	    	<a href="/{{ $champion->id }}">
	    		<img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/{{ $champion->image_name }}" title="{{ $champion->name }}">
	    	</a>
	    	<p>{{ $champion->name }}</p>
	    </div>
	@endforeach
@endsection