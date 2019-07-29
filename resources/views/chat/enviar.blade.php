@extends('layouts.app')
	
	@section('content')
		<privatemessagecompose :user="{{$user}}"></privatemessagecompose>
	@endsection