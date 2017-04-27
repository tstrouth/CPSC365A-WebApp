@extends('template')

@section('content')
 <div class="outer">
  <div class="inner bg-container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="card-block">
    
{{Form::open(array('method' => 'post', 'action' => 'RoomController@store'))}}
            <div class="row" style="margin-bottom:0">
              <div class="col-lg-6">
    <div class="form-group">
    <h5>Select a task </h5>
        {{Form::select('task', $tasks, null, ['class'=>'form-control'])}}
    </div></div></div>
<div class="row">
            <div class="col-lg-6">
        {{Form::submit('Submit', array("class"=>"btn btn-primary"))}}
</div>
</div>

{{Form::close()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
