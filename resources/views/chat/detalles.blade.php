@extends('layouts.app')

	@section('content')
		<privatemessageview :id="{{$id}}" :user="{{$user}}"></privatemessageview>
	@endsection