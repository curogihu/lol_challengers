@extends('layouts.app')

@section('title', $champion->name)
@section('content')
	<table>
	@foreach ($results as $result)
		<tr>
			<td>
	    		<img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/item/{{ $result->image_name }}">,name: {{ $result->name }}, price: {{ $result->price}}, time: {{ floor($result->avg_min_timpstamp / 60) }}:{{ sprintf('%02d', $result->avg_min_timpstamp % 60) }}
	    	</td>
	    </tr>
	@endforeach
	</table>
@endsection