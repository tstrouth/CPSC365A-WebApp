@extends('template')

@section("content")
<div class="row">

<div class="card-block seclect_form">
    <form class="form-horizontal">
        <div class="row">
            <div class="col-lg-4 input_field_sections">
                <h5>Previous Room Choice</h5>
                <select class="form-control chzn-select" tabindex="2">
                  <option>
                    Room1
                  </option>
                </select>
            </div>
        </div>
    </form>
</div>
</div>

<div class="row">
  <div class="card-block">
    <div class="row">
      <div class="col-lg-4">
        <h5>Alpha:</h5>
        <input type="text" class="form-control" name="default"
               value=""/>
        <h5>Null Mean:</h5>
        <input type="text" class="form-control" name="default"
               value="Default text"/>
        <h5>Test Statistic: #</h5>
        <h5>Confidence Interval: #</h5>
        <h5>P value: #</h5>
        <h5>Reject/OrPass</h5>
      </div>
      <div class="col-lg-8">
        
      </div>
    </div>
  </div>
</div>
@endsection
