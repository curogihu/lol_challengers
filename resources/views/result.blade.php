@extends('layouts.app')

@section('content')
<h1 class="text-center">LoL Challengers</h1>
	@foreach ($results as $result)
	    <p><img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/item/{{ $result->image_name }}">,name: {{ $result->name }}, price: {{ $result->price}}, time: {{ floor($result->avg_min_timpstamp / 60) }}:{{ $result->avg_min_timpstamp % 60 }}</p>
	@endforeach
@endsection