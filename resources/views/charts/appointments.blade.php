@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Reporte: Frecuencia de reservas</h3>
        </div>
      </div>
    </div>
    <div class="card-body"> 
      <div id="container"></div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  Highcharts.chart('container', {
    chart: {
        type: 'line'
    },

    title: {
        text: 'Reservas registradas mensualmente'
    },

    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },

    yAxis: {
        title: {
             text: 'Cantidad de reservas '
        }
    },
    plotOptions: {
        line: {
             dataLabels: {
                enabled: true
             },
             enableMouseTracking: false
        }
    },
    series: [{
        name: 'Reservas registradas',
        data: @json($counts)
      }]
  });
  </script>
@endsection 
