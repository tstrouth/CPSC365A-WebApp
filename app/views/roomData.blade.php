@extends('template')

@section("menu_elements")
  @if($auth==1)
  <li id="admin" class="">
      <a href="{{URL::to('admin')}}">

          <span class="link-title">&nbsp;Admin Control</span>
      </a>
  </li>
  @endif
@endsection
@section('content')
<div class="outer">
<div class="inner bg-container">
<div class="row">
  <div class="col-12  col-xl-12">
    <div class="card">
      <div class="card-header bg-white">
          Data from Room
      </div>
      <div class="card-block">
<div class="table-responsive m-t-35">
<table class="table">
            <tr>
		@if($entries > 1)
		    <th>Response Data 1</th>
		    <th>Response Data 2</th>
		@else
		    <th>Response Data</th>
		@endif
                <th></th>
            </tr>
            <tbody>
                @foreach($roomResponses as $currentResponse)
                    <tr>
			@if($entries > 1)
			    <td>{{$currentResponse->data[0]->response_data}}</td>
			    <td>{{$currentResponse->data[1]->response_data}}</td>
			@else
			    <td>{{$currentResponse->data[0]->response_data}}</td>
			@endif

                        <td>
                            <a href="{{action('RoomController@deleteRoomData', ['roomId'=>$currentResponse->room_fkey, 'responseId'=>$currentResponse->id])}}" class="btn btn-danger pull-right" style="margin-top:13px">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <table
        </table>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
@endsection
