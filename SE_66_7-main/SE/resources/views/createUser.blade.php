@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-0">
                            <div class="bd-example">
                                <form action="{{ route('userStore') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname">
                                        @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname">
                                        @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">อีเมล</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="subcategory" class="form-label">หมวดวิชา</label>
                                        <select class="form-select" id="subcategory" name="subcategory">
                                            <option selected></option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        @foreach ($roles as $role)
                                            <div class="form-check">
                                                @if ($role->name === 'ผู้ดูแลระบบ')
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $role->id }}" id="role" name="role[]">
                                                @else
                                                    <input class="form-check-input" type="radio"
                                                        value="{{ $role->id }}" id="role" name="role[]"> 
                                                @endif
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span>{{ $role->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="mb-3">

                                        <label for="role" class="form-label">ตำแหน่ง</label>
                                        <select class="form-select" id="role" name="role[]" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/userMain" class="btn btn-danger ">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
