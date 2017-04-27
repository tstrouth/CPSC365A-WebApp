@extends('template')

@section("header_styles")
  <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/chosen/css/chosen.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/css/datatable.css')}}"/>
@endsection

@section("footer_scripts")
  <script type="text/javascript" src="{{asset('assets/vendors/chosen/js/chosen.jquery.js')}}"></script>
  
  <script>
    $(".chzn-select").chosen({allow_single_deselect: true});
    $('#room_select .chzn-select').val({{$roomId}}).trigger("chosen:updated");


        // Create graph from data table and specify a container for the graph
        createGraph('#data-table', '.chart');
        function createGraph(data, container){
    	// Declaration of variables
    	var bars=[];
    	var figureContainer=$('<div id="figure"></div>');
    	var graphContainer=$('<div class="graph"></div>');
    	var barContainer=$('<div class="bars"></div>');
    	var data=$(data);
    	var container=$(container);
    	var chartData;
    	var chartYMax;
    	var columnGroups;

    	// Timer variables
    	var barTimer;
    	var graphTimer;

    	// Create table data object
    	var tableData={
    	    // Get numerical data from table cells
    	    chartData: function(){
    		var chartData=[];
    		data.find('tbody td').each(function(){
    		    chartData.push($(this).text());
    		});
    		return chartData;
    	    },
    	    // Get heading data from table caption
    	    chartHeading: function(){
    		var chartHeading = data.find('caption').text();
    		return chartHeading;
    	    },
    	    // Get legend data from table body
    	    chartLegend: function(){
    		var chartLegend=[];
    		// Find the elements in table body for y-axis
    		data.find('tbody th').each(function(){
    		    chartLegend.push($(this).text());
    		});
    		return chartLegend;
    	    },
    	    // Get highest value for y-axis scale
    	    chartYMax: function(){
    		var chartData=this.chartData();
    		var chartYMax=Math.ceil(Math.max.apply(Math, chartData));
    		return chartYMax;
    	    },
    	    // Get y-axis data from table cells
    	    yLegend: function() {
    		var chartYMax=this.chartYMax();
    		var yLegend=[];
    		// Number of divisions on the y-axis
    		var yAxisMarkings=5;
    		// Add required number of y-axis markings in order from 0 - max
    		for (var i=0; i<yAxisMarkings; i++) {
    		    yLegend.unshift(((chartYMax*i)/(yAxisMarkings-1)));
    		}
    		return yLegend;
    	    },
    	    // Get x-axis data from table header
    	    xLegend: function(){
    		var xLegend=[];
    		// Find th elements in table header for x-axis
    		data.find('thead th').each(function(){
    		    xLegend.push($(this).text());
    		});
    		return xLegend;
    	    },
    	    // Sort data into groups based on number of columns
    	    columnGroups: function(){
    		var columnGroups=[];
    		// Get number of columns from first row of table
    		var columns=data.find('tbody tr:eq(0) td').length;
    		for (var i=0; i<columns; i++){
    		    columnGroups[i]=[];
    		    data.find('tbody tr').each(function() {
    			columnGroups[i].push($(this).find('td').eq(i).text());
    		    });
    		}

    		return columnGroups;

    	    }
    	}

    	// Useful variables for accessing table data
    	chartData=tableData.chartData();
    	chartYMax=tableData.chartYMax();
    	columnGroups=tableData.columnGroups();

    	// Construct the graph

    	// Loop through column groups, adding bars as we go
    	$.each(columnGroups, function(i) {
    	    // Create bar group container
    	    var barGroup=$('<div class="bar-group"></div>');
    	    // Add bars inside each column
    	    for (var j=0, k=columnGroups[i].length; j<k; j++){
    		// Create bar object to store properties (label, height, code etc.) and add it to array
    		// Set the height later in displayGraph() to allow for left-to-right sequential display
    		var barObj={};
    		barObj.label=this[j];
    		barObj.height=Math.floor(barObj.label/chartYMax*100)+'%';
    		barObj.bar=$('<div class="bar fig' +j+ '"><span>'+barObj.label+'</span></div>')
    		    .appendTo(barGroup);
    		bars.push(barObj);
    	    }
    	    // Add bar groups to graph
    	    barGroup.appendTo(barContainer);
    	});

    	// Add heading to graph
    	var chartHeading = tableData.chartHeading();
    	var heading = $('<h4>' + chartHeading + '</h4>');
    	heading.appendTo(figureContainer);

    	// Add legend to graph
    	var chartLegend	= tableData.chartLegend();
    	var legendList	= $('<ul class="legend"></ul>');
    	$.each(chartLegend, function(i) {
    	    var listItem = $('<li><span class="icon fig' + i + '"></div></span>' + this + '</li>')
    		.appendTo(legendList);
    	});
    	legendList.appendTo(figureContainer);

    	// Add x-axis to graph
    	var xLegend=tableData.xLegend();
    	var xAxisList=$('<ul class="x-axis"></ul>');
    	$.each(xLegend, function(i) {
    	    var listItem=$('<li><span>' + this + '</span></li>')
    		.appendTo(xAxisList);
    	});
    	xAxisList.appendTo(graphContainer);

    	// Add y-axis to graph
    	var yLegend= tableData.yLegend();
    	var yAxisList= $('<ul class="y-axis"></ul>');
    	$.each(yLegend, function(i) {
    	    var listItem=$('<li><span>' + this + '</span></li>')
    		.appendTo(yAxisList);
    	});
    	yAxisList.appendTo(graphContainer);

    	// Add bars to graph
    	barContainer.appendTo(graphContainer);

    	// Add graph to graph container
    	graphContainer.appendTo(figureContainer);

    	// Add graph container to main container
    	figureContainer.appendTo(container);

    	// Set individual height of bars
    	function displayGraph(bars, i){
    	    // Changed the way we loop due to $.each not resetting properly
    	    if (i<bars.length) {
    		// Add transition properties and set height via CSS
    		$(bars[i].bar).css({'height': bars[i].height, '-webkit-transition': 'all 0.8s ease-out'});
    		// Wait the specified time then rerun the displayGraph()
    		barTimer=setTimeout(function(){
    		    i++;
    		    displayGraph(bars, i);
    		}, 100);
    	    }
    	}

    	// Reset graph settings and prepare for display
    	function resetGraph(){
    	    // Set bar height to 0 and clear all transitions
    	    $.each(bars, function(i) {
    		$(bars[i].bar).stop().css({'height': 0, '-webkit-transition': 'none'});
    	    });

    	    // Clear timers
    	    clearTimeout(barTimer);
    	    clearTimeout(graphTimer);

    	    // Restart timer
    	    graphTimer=setTimeout(function(){
    		displayGraph(bars, 0);
    	    }, 200);
    	}

    	// Helper functions
    	// Call resetGraph() when button is clicked to start graph over
    	$('#reset-graph-button').click(function(){
    	    resetGraph();
    	    return false;
    	});

    	//resets graph
    	resetGraph();
    }

  $(document).ready(function(){
    if({{$roomId}} > 0){
      updateValues();
    }
  });

  function updateValues(){
    $.ajax({
      url:"{{route('getStatData', $roomId)}}"
    })
    .done(function(data){
      $("#mean").html(data.mean);
      $("#std-dev").html(data.std_dev);
      $("#median").html(data.median);
      var five_string = data.five_number[0] + ", " + data.five_number[1] + ", " + data.five_number[2] + ", " + data.five_number[3] + ", " + data.five_number[4];
      $("#five-number").html(five_string);
      $("#data-table").html(data.histo);
      resetGraph();
    });
    updateStatistical();
  }

  function updateStatistical(){
    var data_object = {};
    //data_object.alpha = $("#alpha").val();
    //data_object.null = $("#null-mean").val();
    //data_object.test = $("#test-choice").chosen().val();
    data_object.alpha = 1;
    data_object.null = 2;
    data_object.test = 1;

    $.ajax({
      url:"{{route('getStatTest', $roomId)}}",
      data: data_object
    })
    .done(function(data){
      console.log(data);
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
                <button class="btn btn-primary pull-right" style="margin-right:0">Update Values</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <h5 >Test Statistic: <span id="t-statistic">#</span></h5>
                <h5 >Confidence Interval: <span id="c-interval">#</span></h5>
                <h5 >P value: <span id="p-value">#</span></h5>
                <h5 >Reject/OrPass: <span id="reject-pass">#</span></h5>
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
