@extends('template')


@section('content')
    <div class="row">
        <table>
            <tr>
                <th>Response Data</th>
                <th></th>
            </tr>
            <tbody>
                @foreach($roomResponses as $currentResponse)
                    <tr>
                        <td>{{$currentResponse->responseData}}</td>
                        <td>
                            <a href="{{action('RoomController@deleteRoomData', ['roomId'=>$currentResponse->room_fkey}}, 'responseId'=>$currentResponse->id])}}" class="btn btn-danger pull-right" style="margin-top:13px">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <table
        </table>
    </div>
@endsection
