@extends('layout')
@section('Title')
    ประวัติการลาทั้งหมด
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ประวัติการลาทั้งหมด</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header"><h2>ประวัติการลาทั้งหมด</h2></div>
                    <div class="card-body">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>ประเภทการลา</th>
                                <th>วันที่ลา</th>
                                <th>จำนวนวัน</th>
                                <th>Status</th>
                                <th>ผู้อนุมัติ</th>
                                <th>วันที่ลงใบลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveofabsences as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>ชื่อ: {{$item->users->firstname}}<br>{{$item->users->lastname}}<br>หมวด: {{$item->users->subcategories->name}}</td>
                                <td>{{$item->typeleave1->name}}</td>
                                <td>
                                    @if (strtotime($item->firstDate) === strtotime($item->endDate))
                                        {{$item->firstDate}}
                                    @else
                                        {{$item->firstDate}}<br>ถึง<br>{{$item->endDate}}
                                    @endif

                                </td>
                                <td> 
                                @foreach ($eventdate as $event)                                  
                                    <?php                                               
                                        $firstDate = strtotime($item->firstDate);
                                        $endDate = strtotime($item->endDate);
                                        $eventday = strtotime($event->date); 
                                        $day = 0;
                                        $countSatSuneventday = 0;
                                        $totalday = 0;

                                        for ($i = $firstDate; $i <= $endDate; $i += 86400) {
                                            $dayOfWeek = date('N', $i);
                                            if ($dayOfWeek == 6 || $dayOfWeek == 7 || ($i == $eventday && $event->chechRest != 1)) { 
                                                $countSatSuneventday++;
                                            }
                                            $day++;
                                        }
                                        $totalday = $day - $countSatSuneventday;
                                    ?>
                                @endforeach
                                    {{$totalday}} วัน
                                </td>
                                <td>
                                    @if ($item->status==='อนุมัติ')
                                        <p class="text-white bg-success d-flex justify-content-center align-items-center" style="width: 7rem; height: 1.75rem;">{{$item->status}}</p>                                   

                                    @elseif($item->status==='ไม่อนุมัติ')
                                        <p class="text-white bg-danger d-flex justify-content-center align-items-center" style="width: 7rem; height: 1.75rem;">{{$item->status}}</p>                                    

                                    @elseif($item->status==='กำลังดำเนินงาน')
                                        <p class="text-white bg-warning d-flex justify-content-center align-items-center" style="width: 7rem; height: 1.75rem;">{{$item->status}}</p>                                   
                                           
                                    @else
                                        <p class="text-white bg-secondary d-flex justify-content-center align-items-center" style="width: 7rem; height: 1.75rem;">{{$item->status}}</p>
                                    @endif

                                </td>
                                <td>{{$item->approver->firstname}} {{$item->approver->lastname}}</td>
                                <td>{{$item->date}}</td>                               
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

        <script>
            let table = new DataTable('#myTable');
        </script>
    </body>
    </html>

@endsection