@extends('template')

@section('content')
    {{Form::open(array('method' => 'post', 'action' => 'RoomController@store'))}}
    <div class="form-group">
	{{Form::label('task', 'Tasks')}}
        {{Form::select('task', $tasks, null, ['class'=>'form-control'])}}
        {{Form::submit('submit')}}
    </div>
    {{Form::close()}}
@endsection
