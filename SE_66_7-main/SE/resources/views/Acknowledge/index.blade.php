@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-o">Acknowledge Page</h1>
    <hr />
    <div class="col-md-3 ms-auto">
            <div class="form-group">
                <form methode="get" action="/search">
                    <div class="input-group">
                        <input class="form-control" name="search" placeholder="Search..." value="{{isset($search)?$search:''}}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
    </div>  
    <br>                                                                                                                                                                                                    
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    <table class="table table-hover mt-3">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Approve Status</th>
                <th>Approved By</th>
                <th>Detail</th>
                <th>Acknowledge Status</th>
                <th>Acknowledge</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Acknowledge as $ack)
            <tr>
                <td class="align-middle">{{$loop->iteration}}</td>
                <td class="align-middle">{{$ack->user->firstname .' '. $ack->user->lastname}}</td>
                <td class="align-middle">{{$ack->typeleave->name}}</td>
                <td class="align-middle">{{$ack->firstDate}}</td>
                <td class="align-middle">{{$ack->endDate}}</td>
                <td class="align-middle">{{$ack->status}}</td>
                <td class="align-middle">{{$ack->userapprover->firstname . ' ' . $ack->userapprover->lastname}}</td>
                <td>
                    <a href="{{route('ackdetail', $ack->id)}}" type="button" class="btn btn-secondary">Detail</a>
                </td>
                <td class="align-middle">{{$ack->acknowledge}}</td>
                @if($ack->acknowledge == 'รับทราบ')
                <td>
                    <a href="{{route('ackindex')}}" class="btn btn-success">Acknowledge</a>
                </td>
                @else
                <td>
                    <a href="{{route('accept', $ack->id)}}" class="btn btn-success" onclick="return confirm('Are you sure you want to confirm this acknowledge?')">Acknowledge</a>
                    <!-- <button type="button" class="btn btn-success acknowledgeBtn" value="{{$ack->id}}">Acknowledge</button> -->
                </td>
                @endif
                
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<div class="">
{{$Acknowledge->links()}}
</div>
<div class="col-md-1 ms-auto">
<a href="/display/leaveofabsences" class="btn btn-danger ">Back</a>
</div>
<br>
@endsection
