@extends('layout')
@section('content')
    <h1 class="mb-0">Detail Page</h1>
    <hr />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <div class="row">
        <div class="col mb-3">
            <lable class="form-lable">Employee Name</lable>
            <input type="text" name="u_id" class="form-control" placeholder="Employee Name" value="{{$Acknowledge->user->firstname .' '. $Acknowledge->user->lastname}}" readonly>
        </div>
        <div class="col mb-3">
            <lable class="form-lable">Leave Type</lable>
            <input type="text" name="typeL_id" class="form-control" placeholder="Leave Type" value="{{$Acknowledge->typeleave->name}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <lable class="form-lable">Start Date</lable>
            <input type="text" name="firstDate" class="form-control" placeholder="Start Date" value="{{$Acknowledge->firstDate}}" readonly>
        </div>
        <div class="col mb-3">
            <lable class="form-lable">End Date</lable>
            <input type="text" name="endDate" class="form-control" placeholder="End Date" value="{{$Acknowledge->endDate}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <lable class="form-lable">Remarks</lable>
            <input type="text" name="detail" class="form-control" placeholder="Remarks" value="{{$Acknowledge->detail}}" readonly>
        </div>
        <div class="col mb-3">
            <lable class="form-lable">Date</lable>
            <input type="text" name="date" class="form-control" placeholder="Date" value="{{$Acknowledge->date}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
        @if($Acknowledge->file)
            <lable class="form-lable">File</lable><br>
            <a href="{{ url('/'.$Acknowledge->file) }} " class="btn btn-outline-primary btn-sm">Open</a>

            @endif
        </div>
        <div class="col mb-3">
            <lable class="form-lable">Approve Status</lable>
            <input type="text" name="status" class="form-control" placeholder="Date" value="{{$Acknowledge->status}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <lable class="form-lable">Approved By</lable>
            <input type="text" name="u_approver" class="form-control" placeholder="Approved By" value="{{$Acknowledge->userapprover->firstname . ' ' . $Acknowledge->userapprover->lastname}}" readonly>
        </div>
    </div>
        <a href="/acknowledge" class="btn btn-danger ">Back</a>
<!-- endsection -->
@endsection
