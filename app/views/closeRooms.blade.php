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
              Current Rooms
          </div>
          <div class="card-block">
    <div class="table-responsive m-t-35">
    <table class="table">
        <tr>
            <th>Task</th>
    <th>Room Code</th>
            <th>Created At</th>
	    <th></th>
        </tr>
        <tbody>
            @foreach($openRooms as $currentRoom)
                <tr>
                    <td>{{$currentRoom->task}}</td>
<td>{{$currentRoom->room_code}}</td>
		    <td>{{$currentRoom->created_at->format('d-m-Y h:m')}}</td>
                    <td>
                        <a href="{{action('RoomController@close', ['roomId'=>$currentRoom->ID])}}" class="btn btn-danger pull-right" style="margin-top:13px">Close</a>
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
