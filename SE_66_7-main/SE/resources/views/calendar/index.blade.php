<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SE Group 7</title>
    <link rel="stylesheet" href="{{ asset('assets/css/layoutV2.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

</head>

<body>
    <div class="top">
        <nav class="nav">
            <img src="../assets/images/KU copy.png" class="logo">
            <ul>
                <li><a href="#">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }} </a></li>
            </ul>
            <img src="../assets/images/user.png" class="user-pic" onclick = "toggleMenu()">

            <div class="sub-menu-wrap" id = "subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../assets/images/user.png">
                        <h6>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h6>
                    </div>
                    <hr>
                    {{-- ปุ่ม Attendance --}}
                    @if(!isset($hasCheckedInToday) || !$hasCheckedInToday)

                    <form action="{{ route('attendance.add') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Record Attendance</button>
                    </form>
                    @else
                        <button class="btn btn-secondary" disabled>Attendance Recorded</button>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <img src = "../assets/images/logout.png">
                        <button type="submit" class="btn btn-danger">
                            
                           <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>

    <div class="left">
    @teacherRole
        <ul class="sidebar-nav">
            <li><a href="{{ route('calendar.index') }}">ปฎิทิน</a></li>
            <li><a href="{{ route('leaveMain') }}">ลงใบลา</a></li>
            <li><a href="/leavetype">ข้อมูลการลา</a></li>
            <li><a href="{{ route('display.attendance') }}">ประวัติการเข้างาน</a></li>
            @adminRole
            <li><a href="/leavehis">ประวัติการลาทั้งหมด</a></li>
            <li><a href="{{ route('userMain') }}">จัดการผู้ใช้งาน</a></li>
            <li><a href="/display/subcategory">จัดการหมวดวิชา</a></li>
            <li><a href="/display/typeleave">จัดการประเภทการลา</a></li> 
            @endadminRole
        </ul>
    @endteacherRole

    @leaderRole
        <ul class="sidebar-nav">
            <li><a href="/display/leaveofabsences">Dashboard</a></li>
            <li><a href="{{ route('calendar.index') }}">ปฎิทิน</a></li>
            <li><a href="{{ route('leaveMain') }}">ลงใบลา</a></li>
            <li><a href="/leavetype">ข้อมูลการลา</a></li>
            <li><a href="{{ route('display.attendance') }}">ประวัติการเข้างาน</a></li>
            @adminRole
            <li><a href="/leavehis">ประวัติการลาทั้งหมด</a></li>
            <li><a href="{{ route('userMain') }}">จัดการผู้ใช้งาน</a></li>
            <li><a href="/display/subcategory">จัดการหมวดวิชา</a></li>   
            <li><a href="/display/typeleave">จัดการประเภทการลา</a></li>
            @endadminRole
        </ul>
    @endleaderRole

    @deputyRole
        <ul class="sidebar-nav">
            <li><a href="/display/leaveofabsences">Dashboard</a></li>
            <li><a href="{{ route('calendar.index') }}">ปฎิทิน</a></li>
            <li><a href="{{ route('leaveMain') }}">ลงใบลา</a></li>
            <li><a href="/leavetype">ข้อมูลการลา</a></li>
            <li><a href="{{ route('display.attendance') }}">ประวัติการเข้างาน</a></li>
            @adminRole
            <li><a href="/leavehis">ประวัติการลาทั้งหมด</a></li>
            <li><a href="{{ route('userMain') }}">จัดการผู้ใช้งาน</a></li>
            <li><a href="/display/subcategory">จัดการหมวดวิชา</a></li>  
            <li><a href="/display/typeleave">จัดการประเภทการลา</a></li> 
            @endadminRole

        </ul>
    @enddeputyRole

    @directorRole
        <ul class="sidebar-nav">
        <li><a href="/display/leaveofabsences">Dashboard</a></li>
        <li><a href="{{ route('calendar.index') }}">ปฎิทิน</a></li>
        <li><a href="{{ route('leaveMain') }}">ลงใบลา</a></li>
        <li><a href="/leavetype">ข้อมูลการลา</a></li>
        <li><a href="{{ route('display.attendance') }}">ประวัติการเข้างาน</a></li>
            @adminRole
            <li><a href="/leavehis">ประวัติการลาทั้งหมด</a></li>
            <li><a href="{{ route('userMain') }}">จัดการผู้ใช้งาน</a></li>
            <li><a href="/display/subcategory">จัดการหมวดวิชา</a></li>
            <li><a href="/display/typeleave">จัดการประเภทการลา</a></li>
            @endadminRole
        </ul>
    @enddirectorRole
    </div>

    <div class="main">
        <!-- Page content -->
        <div class="content">
           <!-- resources/views/calendar/index.blade.php -->
           <div class="container">
        <div class="card">
            <div class="card-header">EventDate    @adminRole<a href="{{ route('date_names.index') }}" class="btn btn-primary">Config DateName</a> <a href="{{ route('calendar.create') }}" class="btn btn-success">Add Event</a>@endadminRole </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>DateName</th>
                            <th>Check Rest</th>
                            <th>Detail</th>
                            @adminRole<th>Action</th>@endadminRole <!-- เพิ่มหัวข้อ Action -->
                        </tr>
                        
                    </thead>
                    <tbody>
                    @foreach($events->where('date', '>=', now()->startOfYear())->sortBy('date') as $event)
                    <tr>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->dateName->name }}</td>
                        <td>{{ $event->checkRest == 1 ? 'หยุด' : 'ไม่หยุด'  }}</td>
                        <td><a href="{{ route('calendar.detail', ['id' => $event->id]) }}" class="btn btn-secondary">Details</a></td>

                        @adminRole
                        <td>
                        <form action="{{ route('calendar.destroy', $event->id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเหตุการณ์นี้?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{ route('calendar.edit', $event->id) }}" class="btn btn-primary">Edit</a>
                        </form>
                        </td>
                        @endadminRole
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
