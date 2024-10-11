@extends('layout')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card " >
                <div class="card-header " >
                    <h4>ข้อมูลการลา</h4>
                </div>
                <div class="card-body" >
                    <dl class="row">
                        <dt class="col-sm-3">ชื่อ</dt>
                        <dd class="col-sm-9">{{ $detail->user->firstname . ' ' . $detail->user->lastname }}</dd>
                      
                        <dt class="col-sm-3">ประเภทการลา</dt>
                        <dd class="col-sm-9">
                          <p>{{ $detail->typeLeave->name }}</p>
                        </dd>
                      
                        <dt class="col-sm-3">เริ่มลาวันที่</dt>
                        <dd class="col-sm-9">{{ $detail->firstDate }}</dd>
                      
                        <dt class="col-sm-3">ถึงวันที่</dt>
                        <dd class="col-sm-9">{{ $detail->endDate }}</dd>
                      
                        <dt class="col-sm-3">ข้อมูลเพิ่มเติม</dt>
                        <dd class="col-sm-9">
                          <dl class="row">
                            <dd class="col-sm-9">{{ $detail->detail }}</dd>
                          </dl>
                        </dd>
                      @if($detail->file)
                        <dt class="col-sm-3 ">File (เพิ่มเติม)</dt>
                        
                        <dd class="col-sm-9"><a href="{{ url('/'.$detail->file) }} " class="btn btn-outline-primary btn-sm"> Open </a></dd>
                        @endif
                        <dt></dt>
                        
                        <dt class="col-sm-3">ผู้อนุมัติ</dt>
                        <dd class="col-sm-9">{{ $detail->approver->firstname . ' ' . $detail->approver->lastname }}</dd>

                        <dt class="col-sm-3 mt-2">วัน/เวลาที่กรอก</dt>
                        <dd class="col-sm-9 mt-2">{{ $detail->date }}</dd>

                        <dt class="col-sm-3 mt-2">สถานะ</dt>
                        <dd class="col-sm-9 mt-2">{{ $detail->status }}</dd>
                      
                      </dl>
                      <a href="/leaveMain" class="btn btn-danger ">Back</a>
                      
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection