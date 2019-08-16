@extends('layouts.app')

	@section('content')
	<div class="container">
	<div class="row">
  {{-- <div class="col-3">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-inbox-list" data-toggle="list" href="#list-inbox" role="tab" aria-controls="inbox">Bandeja de entrada</a>
      <a class="list-group-item list-group-item-action" id="list-enviados-list" data-toggle="list" href="#list-enviados" role="tab" aria-controls="enviados">Elementos enviados</a>
      <a class="list-group-item list-group-item-action" id="list-nuevo-list" data-toggle="list" href="#list-nuevo" role="tab" aria-controls="nuevo">Mensaje nuevo</a>
    </div>
  </div> --}}
  <private-message-sidebar :user="{{$user}}"></private-message-sidebar>
  <div class="col-9">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-inbox" role="tabpanel" aria-labelledby="list-inbox-list">
      	<privatemessageinbox :user="{{$user}}"></privatemessageinbox>
      </div>
      <div class="tab-pane fade" id="list-enviados" role="tabpanel" aria-labelledby="list-enviados-list">
			<privatemessagesent :user="{{$user}}"></privatemessagesent>
      </div>
      <div class="tab-pane fade" id="list-nuevo" role="tabpanel" aria-labelledby="list-nuevo-list">
      	<privatemessagecompose :user="{{$user}}"></privatemessagecompose>
      </div>
    </div>
  </div>
</div>
</div>
	@endsection