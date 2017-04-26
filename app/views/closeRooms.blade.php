@extends('template.blade.php')

@section('content')

    {{Form::open(array('method' => 'post', 'action' => array('RoomController@close'), true))}}
    <div class="form-group">
        {{Form::label('room', 'Open Rooms')}}
        {{Form::select('room', $openRooms, null, ['class'=>'form-control'])}}

        {{Form::submit('Close Room')}}
    </div>
    {{Form::close()}}

@endsection
