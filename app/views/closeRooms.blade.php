@extends('template')


@section('content')
    <table>
        <tr>
            <th>Task</th>
            <th>Created At</th>
	    <th></th>
        </tr>
        <tbody>
            @foreach($openRooms as $currentRoom)
                <tr>
                    <td>{{$currentRoom->task}}</td>
		    <td>{{$currentRoom->created_at->format('d-m-Y h:m')}}</td>
                    <td>
                        <a href="{{action('RoomController@close', ['roomId'=>$currentRoom->ID])}}" class="btn btn-danger pull-right" style="margin-top:13px">Close</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <table
        </table>

@endsection
