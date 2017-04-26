@extends('template.blade.php')

@section('content')
    {{Form::open(array('method' => 'post', 'action' => array('RoomController@store'), true))}}
    <div class="form-group">
        {{Form::label('task', 'Task')}}
        {{Form::select('task', $tasks, null, ['class'=>'form-control'])}}

        {{Form::submit('submit')}}
    </div>
    {{Form::close()}}
@endsection
