<?php 
use Illuminate\Support\Facades\DB;
use App\Models\Voto;

function index()
{
    $votos = Voto::all();
    return view('voto/list', compact('votos'));
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="https://www.google.com/jsapi"></script>
    <style>
        .pie-chart {
            width: 600px;
            height: 400px;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
@extends('plantilla')
@section('content')

    <h2 class="text-center">Generar Gráfica</h2>

    <div id="chartDiv" class="pie-chart"></div>
    <div class="text-center">
        <a href="{{ route('download') }}">Descargar archivo pdf</a>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            google.load("visualization", "1.1", {
                packages: ["corechart"],
                callback: 'drawChart'
            });
        };

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pizza');
            data.addColumn('number', 'Populartiy');
            data.addRows([
                ['Laravel', 33],
                ['Codeigniter', 26],
                ['Symfony', 22],
                ['CakePHP', 10],
                ['Slim', 9]
            ]);

            var options = {
                title: 'Votos',
                sliceVisibilityThreshold: .2
            };
            var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
            chart.draw(data, options);
        }
    </script>
</body>
@endsection
</html>