@extends('layouts.app')

	@section('content')
		<privatemessageinbox :user="{{$user}}"></privatemessageinbox>
	@endsection