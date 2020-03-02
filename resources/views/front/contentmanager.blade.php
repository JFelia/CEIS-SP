@extends('layouts.frontendLayout.front_design')
@section('content')

	@foreach($content as $object)
		<center>
		<h3 style="margin-top: 3%">{{$object->title}}</h3>
		<p style="margin-top: 3%">{{$object->content}}</p>
		</center>
	@endforeach

@endsection