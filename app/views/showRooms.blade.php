@extends('template')

@section("header_styles")
  <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/css/datatable.css')}}"/>


@endsection

@section("footer_scripts")
  <script type="text/javascript" src="{{asset('assets/vendors/chosen/js/chosen.jquery.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/datatable.js')}}"></script>
  <script>
    $(".chzn-select").chosen({allow_single_deselect: true});
    $('#room_select .chzn-select').val({{$roomId}}).trigger("chosen:updated");

  $(document).ready(function(){
    var id = {{$roomId}};
    if(id > 0){
      updateValues(id);
    }

    $("#room-choice").change(function(){
      $('#room_select .chzn-select').trigger("chosen:updated");
      id = $("#room_select .chzn-select").val();
      console.log(id);
      updateValues(id);
    });

    $("#updatebtn").click(function(){
      updateStatistical(id);
    });

  });

  function updateValues(id){
    $.ajax({
      url:"../getstatdata/" + id
    })
    .done(function(data){
      $("#mean").html(data.mean);
      $("#std-dev").html(data.std_dev);
      $("#median").html(data.median);
      var five_string = data.five_number[0] + ", " + data.five_number[1] + ", " + data.five_number[2] + ", " + data.five_number[3] + ", " + data.five_number[4];
      $("#five-number").html(five_string);
      $("#data-table").html(data.histo);
      $("#figure").remove();
      createGraph('#data-table', '.chart');
    });
    updateStatistical(id);
  }

  function updateStatistical(id){
    var data_object = {};
    data_object.alpha = $("#alpha").val();
    data_object.null = $("#null-mean").val();
    data_object.test = $("#test-choice").chosen().val();
    // data_object.alpha = 1;
    // data_object.null = 2;
    // data_object.test = 1;

    $.ajax({
      url:"../getstattest/"+id,
      data: data_object
    })
    .done(function(data){
      $("#stat-tests").html(data["response"]);
    });
  }

  </script>
@endsection


@section("content")

<!--Room Selection -->
<div class="outer" id="room_select">
    <div class="inner bg-container">
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card">
            <div class="card-block seclect_form">
              <form class="form-horizontal">
                  <div class="row">
                      <div class="col-lg-4 input_field_sections">
                          <h3>Previous Room Choice</h3>
                          <select value={{$roomId}} id="room-choice" class="form-control chzn-select" tabindex="2">
                            @foreach($all_rooms as $room)
                                <option value={{$room->ID}} id="{{$room->ID}}">
                                  Room {{$room->ID}} - {{$room->created_at}}
                                </option>
                            @endforeach
                          </select>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--Histogram/Stat Tests -->
<div class="outer">
  <div class="inner bg-container">
    <div class="row">
      <div class="col-12 col-xl-6">
        <div class="card">
          <div class="card-header bg-white">
              Statistical Tests
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-12">
                <h5>Test Choice</h5>
                <select name="test-choice" id="test-choice" class="form-control chzn-select" tabindex="2">
                  <option value=1>Matched Pairs</option>
                  <option value=2>Two sided-One Sample</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <h5>Alpha:</h5>
                <input type="float" class="form-control" id="alpha" name="alpha" value=0 />
              </div>
              <div class="col-lg-6">
                <h5>Null Mean:</h5>
                <input type="number" class="form-control" id="null-mean" name="null-mean" value=0 />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <button id="updatebtn" class="btn btn-primary pull-right" style="margin-right:0">Update Values</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12" id="stat-tests">
                <h5 >Test Statistic: #</h5>
                <h5 >Confidence Interval: #</h5>
                <h5 >P value: #</h5>
                <h5 >Reject/OrPass: #</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-6">
        <div class="card">
          <div class="card-header bg-white">
              Histogram
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-12">
                <div class="chart" style="margin-left:10px;">
                  <table id="data-table" border="1" cellpadding="10" cellspacing="0">

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Basic Stats -->
<div class="outer">
  <div class="inner bg-container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="card-header bg-white">
              Basic Information
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-12">
                <h5>Mean: <span id="mean">#</span></h5>
                <h5>Standard Deviation: <span id="std-dev">#</span></h5>
                <h5>Median: <span id="median">#</span></h5>
                <h5>Five Number: <span id="five-number">#</span></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
