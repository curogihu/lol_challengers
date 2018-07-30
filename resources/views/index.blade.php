@extends('layouts.app')

@section('content')
<h1 class="text-center">LoL Challengers</h1>

	<!-- データベースにidは入っているが、表示しようとすると0扱い -->
	@foreach ($champions as $champion)

	    <p>id: {{ $champion->id }}, key: {{ $champion->key }}, name: {{ $champion->name }}, image_name: {{ $champion->image_name }}</p>
	@endforeach
@endsection