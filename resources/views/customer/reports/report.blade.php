@extends('layouts.app')

@section('title')
{{$report['name']}} - ARB2B
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{asset('css/dataTables.bs.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('/') }}">Inicio</a></li>
  <li><a href="{{ url('/shop') }}">Tienda</a></li>
  <li><a href="#">{{$report['name']}}</a></li>
</ol>
<h4>{{$report['name']}}
  <div class="btn-group pull-right">
    <a href="{{ url('/customer/offices/create') }}" class="btn btn-primary" title="Exportar">
      <i class="glyphicon glyphicon-plus"></i><span class="hidden-xs"> Exportar</span>
    </a>
    <a href="{{ url('reports') }}/" class="btn btn-danger" title="Cerrar"><i class="fa fa-remove" aria-hidden="true"></i>
    </a>
  </div>
</h4>
<p>{{$report['description']}}</p>
<br>
<div class="table-responsive">
  <table id="report-datatable" class="table table-borderless table-hover">
    <thead>
      <tr class="active text-center">
        @foreach($report['columns'] as $column)
        <th>{{ $column[1] }}</th>
        @endforeach
        
      </tr>
    </thead>
    <tbody>
      @foreach($report['data'] as $data_row)
      <tr>
        @foreach($data_row as $data)
        <td>{{ $data }}</td>
        @endforeach
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

<div id="chart_div"></div>

@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#report-datatable").DataTable();
  });
</script>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      @foreach($report['columns'] as $column)
      data.addColumn('{{ $column[0] }}','{{ $column[1] }}');
      @endforeach
      data.addRows({!! json_encode($report['data']) !!});

      // Set chart options
      var options = {'title':"{{$report['name']}}",
      'width':400,
      'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.{{$report['chart']}}(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>

@endsection
