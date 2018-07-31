@extends('layouts.app')

@section('content')
<h1 class="text-center">LoL Challengers</h1>

	<!-- データベースにidは入っているが、表示しようとすると0扱い -->
	@foreach ($champions as $champion)
	    <p>id: {{ $champion->id }}, key: {{ $champion->key }}, name: {{ $champion->name }}, image_name: <a href="/{{ $champion->id }}"><img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/{{ $champion->image_name }}"></a></p>
	@endforeach
@endsection