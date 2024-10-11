@extends('layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('searchUser') }}" method="GET">
                    <div class="container mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control mt-3" placeholder="Search..." name="search">
                            <button class="btn btn-outline-secondary mt-3 me-2 " type="submit">Search</button>
                            <a href="{{ route('createUser') }}" class="btn btn-danger float-end mt-3">เพิ่มผู้ใช้งาน</a>
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
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">อีเมล</th>
                                            <th scope="col">หมวดวิชา</th>
                                            <th scope="col">ตำแหน่ง</th>
                                            <th scope="col">แก้ไข</th>
                                            <th scope="col">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->subcategory->name }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        <span style="display: block;">- {{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td><a href="{{ route('userEdit' , ['id' => $user->id]) }}" class="btn btn-outline-primary">แก้ไข</a></td>
                                                <td>
                                                    <form id="deleteForm_{{ $user->id }}" action="{{ route('userDelete', ['id' => $user->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $user->id }})">ลบ</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm('คุณต้องการลบผู้ใช้งานนี้หรือไม่?')) {
                document.getElementById('deleteForm_' + userId).submit();
            }
        }
    </script>
@endsection
