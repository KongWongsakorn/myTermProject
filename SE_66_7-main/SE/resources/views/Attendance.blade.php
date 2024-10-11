@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Attendance</div>
            <div class="card-body">
            <form action="{{ url('/Attendance/search') }}" method="GET" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="search" class="form-label">Search by name, date, or time:</label>
                    <input type="text" name="search" class="form-control" id="keyword" placeholder="Enter name, date, or time" value="{{ $search ?? '' }}">
                </div>
                <button type="submit" id="searchat" class="btn btn-primary">Search</button>
            </form>

            <script>
                function validateForm() {
                    var keyword = document.getElementById("keyword").value;
                    if (keyword.trim() == "") {
                        alert("Please enter a search keyword.");
                        return false;
                    }
                    return true;
                }
            </script>


                <div class="mb-3">
                    @if (isset($all_atten))
                    <p>จำนวนการเข้างานที่พบ: {{ count($all_atten) }}</p>
                    @endif
                </div>

                <table class="table table-sm table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_atten) > 0)
                        @foreach ($all_atten as $atten)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $atten->user->firstname }}</td>
                            <td>{{ $atten->date }}</td>
                            <td>{{ $atten->time }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">No records found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
@endsection
