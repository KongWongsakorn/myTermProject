@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('userUpdate', $user->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- ใช้เมธอด PUT -->

                <div class="mb-3">
                    <label for="firstname" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}">
                    @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}">
                    @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน (กรอกเฉพาะหากต้องการเปลี่ยนแปลง)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="subcategory" class="form-label">หมวดวิชา</label>
                    <select class="form-select" id="subcategory" name="subcategory">
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $user->subcategory->id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    @error('subcategory') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
               
                <div class="mb-3">
                    @foreach ($roles as $role)
                        <div class="form-check">
                            @if ($role->name === 'ผู้ดูแลระบบ')
                                <input class="form-check-input" type="checkbox"
                                    value="{{ $role->id }}" id="role" name="role[]" multiple
                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                            @else
                                <input class="form-check-input" type="radio"
                                    value="{{ $role->id }}" id="role" name="role[]" multiple
                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                            @endif
                            <label class="form-check-label" for="flexCheckDefault">
                                <span>{{ $role->name }}</span>
                            </label>
                        </div>
                    @endforeach
                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
        

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('userMain') }}" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
