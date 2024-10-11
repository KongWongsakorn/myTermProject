@extends('layout')
@section('Title')
    ประเภทการลา
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="en">
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ประเภทการลา</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style type="text/css">
        .box{
            width:800px;
            margin:0 auto;
        }
        </style>
        <script type="text/javascript">
        var analytics = <?php echo $typeL; ?>

        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart()
        {
        var data = google.visualization.arrayToDataTable(analytics);
        var options = {
        title : 'เปอร์เซ็นต์(%)การลาทั้งหมดแต่ละประเภท'
        };
        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
        }

        </script>
    </head>
    <body>
        <div class="container">
    <div class="panel-heading col-md-6">
        <h1 class="panel-title">ข้อมูลการลา</h1>
    </div>
    <div class="panel panel-default">
        <div class="panel-body row">
            <div class="col-md-6">
                <div id="pie_chart" style="width:750px; height:450px;"></div>
            </div>
            <div class="col-md-6">
                <br><br>
                <h3 class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ:{{Auth::user()->firstname}}</h3> 
                <h3 class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นามสกุล:{{Auth::user()->lastname}}</h3>
                <h3 class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมวด:{{Auth::user()->SubCategory->name}}</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h2>Leave Credits</h2></div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ประเภทการลา</th>
                                        <th>ลาไปแล้ว</th>
                                        <th>คงเหลือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leavebalances as $item)
                                        <tr>
                                            <td>{{$item->typeleave->name}}</td>                            
                                            <td>{{$item->usedLeave}}</td>
                                            <td>{{$item->remainingLeave}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>



    </html>

@endsection