@extends('layouts.app')
@section('scripku')
<script type="text/javascript">
    var analytics = @php echo $kategoris_id; @endphp;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart(){
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                title : 'Persentasi dari kategori produk'
            };
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            chart.draw(data, options);
        }

        var analis = @php echo $pesanan_persen; @endphp;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(sample);

        function sample(){
            var data = google.visualization.arrayToDataTable(analis);
            var options = {
                title : 'Persentasi dari penjualan per(Bulan)',
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
            chart.draw(data, options);
        }
</script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><img src="images/login/logo2.png" width="120"></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cras justo odio
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Dapibus ac facilisis in
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Morbi leo risus
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card bg-light">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h4>Selamat datang {{Auth::user()->name}} !!!</h4><br>
                    <div class="row">
                        <div id="line_chart" style="width:930px; height:400px;"></div>
                    </div>
                    <div id="pie_chart" style="width:600px; height:200px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection