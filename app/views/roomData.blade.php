@extends('template')


@section('content')
        <table>
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
@endsection
