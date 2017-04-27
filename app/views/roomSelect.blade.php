@extends('template')

@section('content')
    <table>
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

@endsection
