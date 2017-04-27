@extends('template')

@section('content')
<div class="outer">
<div class="inner bg-container">
<div class="row">
  <div class="col-12  col-xl-12">
    <div class="card">
      <div class="card-header bg-white">
          Previous Rooms
      </div>
      <div class="card-block">
<div class="table-responsive m-t-35">
<table class="table">
        <tr>
	    <th>Task</th>
            <th>Created At</th>
    	    <th></th>
        </tr>
        <tbody>
            @foreach($rooms as $currentRoom)
                <tr>
		    <td>{{$currentRoom->task}}</td>
                    <td>{{$currentRoom->created_at}}</td>
		    <td>
			<a href="{{action('RoomController@viewRoomData', ['roomId'=>$currentRoom->ID])}}" class="btn btn-primary pull-right" style="margin-top:13px">View Responses</a>
		    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>

@endsection
