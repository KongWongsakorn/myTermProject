<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Layout</title>
    <link rel="stylesheet" href="{{ asset('assets/css/layoutV2.css') }}">

</head>

<body>
    <div class="top">
        <nav class="nav">
            <img src="../assets/images/KU copy.png" class="logo">
            <ul>
                <li><a href="#">Attendance </a></li>
            </ul>
            <img src="../assets/images/Cena.png" class="user-pic" onclick = "toggleMenu()">

            <div class="sub-menu-wrap" id = "subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../assets/images/Cena.png">
                        <h2>John Cena</h2>
                    </div>
                    <hr>
                    <a href="/logout" class = "sub-menu-link">
                        <img src = "../assets/images/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>
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
        <ul class="sidebar-nav">
            <li><a href="/dashBoard">Dashboard</a></li>
            <li><a href="#news">ข้อมูลการลา</a></li>
            <li><a href="#contact">ปฎิทิน</a></li>
            <li><a href="#about">ลงใบลา</a></li>
            <li><a href="#me">จัดการผู้ใช้งาน</a></li>
            <li><a href="#me">จัดการหมวดวิชา</a></li>
            <li><a href="#me">จัดการประเภทการลา</a></li>
            <li><a href="#me">ประวัติการลาทั้งหมด</a></li>
            <li><a href="/Attendance">ประวัติการเข้างาน</a></li>
            <li><a href="#me">รับทราบการลา</a></li>
        </ul>
    </div>

    <div class="main">
        @yield('content')
    </div>
</body>

</html>
