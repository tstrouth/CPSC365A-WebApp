@extends('template')

@section('content')
    {{Form::open(array('method' => 'post', 'action' => 'RoomController@store'))}}

    <div class="form-group">
	<div class="row">
	    {{Form::label('task', 'Tasks')}}
            {{Form::select('task', $tasks, null, ['class'=>'form-control'])}}
	</div>
	<div class="row">
            {{Form::submit('submit')}}
	</div>
    </div>
    {{Form::close()}}
@endsection
