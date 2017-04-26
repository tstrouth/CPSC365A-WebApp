@extends('template')

@section('content')

    {{Form::open(array('method' => 'post', 'action' => array('RoomController@close'), true))}}
    <div class="form-group">
	<div class="row">
            {{Form::label('room', 'Open Rooms')}}
            {{Form::select('room', $openRooms, null, ['class'=>'form-control'])}}
	</div>
	<div class="row">
            {{Form::submit('Close Room')}}
	</div>
    </div>
    {{Form::close()}}

@endsection
