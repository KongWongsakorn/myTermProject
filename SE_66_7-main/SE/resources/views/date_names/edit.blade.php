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
            <img src="/assets/images/KU copy.png" class="logo">
            <ul>
                <li><a href="#">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }} </a></li>
            </ul>
            <img src="/assets/images/user.png" class="user-pic" onclick = "toggleMenu()">

            <div class="sub-menu-wrap" id = "subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="/assets/images/user.png">
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
                        <img src = "/assets/images/logout.png">
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
    @yield('content')
    <div class="container mt-5">
        <h1>Edit Date Name</h1>

        <!-- Form for editing DateName -->
        <div class="border p-4">
            <form action="{{ route('date_names.update', $dateName->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $dateName->name }}">
                </div>

                <div style="display: flex; justify-content: space-between;">
                    <button type="submit" class="btn btn-success me-2">Update</button>
                    <a href="{{ route('date_names.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            
        </div>
    </div>
</div>

</body>

</html>
