@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('searchLeave') }}" method="GET">
                    <div class="container mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control mt-3" placeholder="Search..." name="search">
                            <button class="btn btn-outline-secondary mt-3 me-2 " type="submit">Search</button>
                            <a href="{{ route('leaveCreate') }}" class="btn btn-danger float-end mt-3">+ ลงข้อมูลการลา</a>
                        </div>
                    </div>
                </form>

                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-0">
                            <div class="bd-example">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>

                                            <th scope="col">Status</th>
                                            <th scope="col">Approver</th>
                                            <th scope="col">Detail</th>

                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($LeaveOfAbsence as $leave)
                                            <tr>
                                                <td>{{ $leave->user->firstname . ' ' . $leave->user->lastname }}</td>
                                                <td>{{ $leave->typeLeave->name }}</td>
                                                <td>{{ $leave->firstDate }}</td>
                                                <td>{{ $leave->endDate }}</td>
                                                <td>{{ $leave->status }}</td>
                                                <td>{{ $leave->approver->firstname . ' ' . $leave->approver->lastname }}
                                                </td>
                                                <td><a href="{{ route('leaveDetail', ['id' => $leave->id]) }}" class="btn btn-outline-secondary">Detail</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            {{ $LeaveOfAbsence->links() }}
        </div>
        
    </div>
@endsection
