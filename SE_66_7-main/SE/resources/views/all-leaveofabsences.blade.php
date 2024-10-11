@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Se Allow Function</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header" style="font-weight: bold; font-size: 24px;">Dashboard</div> <br>
            <span class="alert alert-success" id="alert-success" style="display: none;"></span>
            <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>

            <div class="container">
            @php
                $approvedCount = $all_leaveofabsences->where('status', 'อนุมัติ')->count();
                $processingCount = $all_leaveofabsences->where('status', 'กำลังดำเนินงาน')->count();
                $rejectedCount = $all_leaveofabsences->where('status', 'ไม่อนุมัติ')->count();
                $cancelledCount = $all_leaveofabsences->where('status', 'ยกเลิก')->count();
            @endphp

            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success" role="alert">
                            อนุมัติ: {{ $approvedCount }}
                        </div>
                    </div>
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            ไม่อนุมัติ: {{ $rejectedCount }} 
                        </div>
                    </div>
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                            รออนุมัติ: {{ $processingCount }}
                        </div>
                    </div>
                    <div class="col">
                        <div class="alert alert-secondary" role="alert">
                            ยกเลิก: {{ $cancelledCount }}
                        </div>
                    </div>
                </div>
            </div>
            </div>
                 @if(auth()->user()->roles()->where('name', 'ผู้อำนวยการ')->exists())
                <div class="container">
                    <a href="{{ route('ackindex') }}" class="btn btn-primary btn-sm float-end acknowledgeBtn">acknowledge</a>
                </div>               
                @endif
                                
                <div class="col-md-3 text-right"> <!-- เพิ่ม class "text-right" เพื่อช่วยให้ฟอร์มค้นหาอยู่ด้านขวา -->
                    <div class="form-group">
                        <form method="get" action="/searchapprover" onsubmit="return validateForm()">
                            <div class="input-group">
                                <input class="form-control" id="searchInput" name="search" placeholder="Search..." value="{{isset($search)?$search:''}}">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function validateForm() {
                        var searchInput = document.getElementById("searchInput").value;
                        if (searchInput.trim() == "") {
                            alert("กรุณากรอกคำค้นหา");
                            return false;
                        }
                        return true;
                    }
                </script>

            <div class="card-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        
                      
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Type Leave</th>
                            <th>First Date</th>
                            <th>End Date</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Approver</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_leaveofabsences) > 0)
                            @foreach ($all_leaveofabsences as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->user->firstname . ' ' . $item->user->lastname}}</td>
                                    <td>{{$item->typeleave->name}}</td>
                                    <td>{{$item->firstDate}}</td>
                                    <td>{{$item->endDate}}</td>
                                    <td><a href="{{ route('detailLeave', ['id' => $item->id]) }}" class="btn btn-secondary btn-sm">Detail</a></td>
                                    <td>{{$item->date}}</td>
                                    <td>
                                        @if($item->status == 'อนุมัติ')
                                            <span class="badge bg-success">{{$item->status}}</span>
                                        @elseif($item->status == 'ไม่อนุมัติ')
                                            <span class="badge bg-danger">{{$item->status}}</span>
                                        @elseif($item->status == 'กำลังดำเนินงาน')
                                            <span class="badge bg-warning">{{$item->status}}</span>
                                        @elseif($item->status == 'ยกเลิก')
                                            <span class="badge bg-secondary">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->approver->firstname . ' ' . $item->approver->lastname}}</td>
                                    

                                    <td><button class="btn btn-primary btn-sm editBtn" data-id="{{$item->id}}" data-user="{{$item->u_id}}" 
                                    data-typeleave="{{$item->typeL_id}}" data-firstDate="{{$item->firstDate}}" data-endDate="{{$item->endDate}}" 
                                    data-detail="{{$item->detail}}" data-file="{{$item->file}}" data-date="{{$item->date}}" data-status="{{$item->status}}" 
                                    data-userapprover="{{$item->u_approver}}" data-acknowledge="{{$item->acknowledge}}"
                                    
                                    data-bs-toggle="modal" data-bs-target="#editModal">Approver</button></td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10"> No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{$all_leaveofabsences->links()}}
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addLeaveForm">      
            <div class="form-group">
                <label for="">User</label>
                <select name="u_id" class="form-control" id="u_id">
                    <option value="">Select User</option>
                    <?php

                    $conn = mysqli_connect("127.0.0.1", "root", "", "se");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, firstname, lastname FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["firstname"] . " " . $row["lastname"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No users found</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="">Type Leave</label>
                <select name="typeL_id" class="form-control" id="typeL_id">
                    <option value="">Select User Type Leave</option>
                    <?php

                    $conn = mysqli_connect("127.0.0.1", "root", "", "se");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id,name  FROM typeleaves";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No users found</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>


            <div class="form-group">
                <label for="">First Date</label>
                <input type="date" name="firstDate" class="form-control" id="">
                <span id="firstDate_error" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="">End Date</label>
                <input type="date" name="endDate" class="form-control" id="">
                <span id="endDate_error" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="">Detail</label>
                <input type="text" name="detail" class="form-control" id="">
                <span id="detail_error" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="">File</label>
                <input type="text" name="file" class="form-control" id="">
                <span id="file_error" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control" id="">
                <span id="date_error" class="text-danger"></span>
            </div>

            <div class="form-group">
            <label for="">Leave Status</label>
            <select name="status" class="form-control" id="">
                <option value="กำลังดำเนินงาน">กำลังดำเนินงาน</option>
                <!-- <option value="อนุมัติ">อนุมัติ</option>
                <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                <option value="ยกเลิก">ยกเลิก</option> -->
            </select>
            <span id="status_error" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="">User Approver</label>
                <select name="u_approver" class="form-control" id="u_approver">
                    <option value="">Select User Approver</option>
                    <?php

                    $conn = mysqli_connect("127.0.0.1", "root", "", "se");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT users.id, users.firstname, users.lastname FROM users 
                    INNER JOIN role_user ON users.id = role_user.user_id
                    INNER JOIN roles ON role_user.role_id = roles.id
                    WHERE roles.name IN ('รองผู้อำนวยการ', 'หัวหน้าหมวด')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["firstname"] . " " . $row["lastname"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No users found</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>


            <div class="form-group">
            <label for="">Acknowledge</label>
            <select name="acknowledge" class="form-control" id="">
                <option value="ยังไม่รับทราบ">ยังไม่รับทราบ</option>
                <!-- <option value="รับทราบ">รับทราบ</option> -->
            </select>
            <span id="acknowledge_error" class="text-danger"></span>
            </div>
            

            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary addBtn">Save changes</button>
      </div>


    </form>  
    </div>
  </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editLeaveForm">
            @csrf
            <input type="hidden" id="Leave_id" name="Leave_id">
            
            <div class="form-group">
            <label for="">Leave Status</label>
            <select name="status" class="form-control" id="status">
                <option value="กำลังดำเนินงาน">กำลังดำเนินงาน</option>
                <option value="อนุมัติ">อนุมัติ</option>
                <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                <option value="ยกเลิก">ยกเลิก</option>
            </select>
            <span id="status_error" class="text-danger"></span>
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary editButton">Save changes</button>
      </div>


    </form>  
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    $('#addLeaveForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: '{{ route("addLeave")}}',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.addBtn').prop('disabled', true);
            },
            complete: function() {
                $('.addBtn').prop('disabled', false);
            },
            success: function(data) {
                if (data.success == true) {
                    $('#addModal').modal('hide');
                    printSuccessMsg(data.msg);
                    var reloadInterval = 1000;

                    function reloadPage() {
                        location.reload(true);
                    }
                    var intervalId = setInterval(reloadPage, reloadInterval);

                } else if (data.success == false) {
                    printErrorMsg(data.msg);
                } else {
                    printValidationErrorMsg(data.msg);
                }
            }
        });

        return false;
    });

    $('.editBtn').on('click', function() {
        var Leave_id = $(this).attr('data-id');
        
        var Leave_status = $(this).attr('data-status');


        $('#status').val(Leave_status);

        $('#Leave_id').val(Leave_id);
        $('#editModal').modal('show');
        
    });

    $('#editLeaveForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: '{{ route("editLeave")}}',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.editButton').prop('disabled', true);
            },
            complete: function() {
                $('.editButton').prop('disabled', false);
            },
            success: function(data) {
                if (data.success == true) {
                    $('#editModal').modal('hide');
                    printSuccessMsg(data.msg);
                    var reloadInterval = 1000;

                    function reloadPage() {
                        location.reload(true);
                    }
                    var intervalId = setInterval(reloadPage, reloadInterval);

                } else if (data.success == false) {
                    printErrorMsg(data.msg);
                } else {
                    printValidationErrorMsg(data.msg);
                }
            }
        });
    });
});

function printValidationErrorMsg(msg) {
    $.each(msg, function(field_name, error) {
        $(document).find('#' + field_name + '_error').text(error);
    });
}

function printErrorMsg(msg) {
    $('#alert-danger').html('');
    $('#alert-danger').css('display', 'block');
    $('#alert-danger').append('' + msg + '');
}

function printSuccessMsg(msg) {
    $('#alert-success').html('');
    $('#alert-success').css('display', 'block');
    $('#alert-success').append('' + msg + '');
    document.getElementById('addLeaveForm').reset();
}

</script>
</body>
</html>
@endsection                          