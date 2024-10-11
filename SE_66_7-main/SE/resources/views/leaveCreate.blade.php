@extends('layout')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4>Leave of Absence</h4>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form action=" {{ route('leaveStore') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb3">
                            <label for="typeL_id" class="mt-3">ประเภทการลา</label>
                            <select class="form-select mt-2" name="typeL_id" aria-label="Default select example">
                                <option selected></option>
                                @foreach($typeLeaves as $typeLeave)
                                    @if($typeLeave->name == 'ลาป่วย')
                                        <option value="{{ $typeLeave->id }}">{{ $typeLeave->name }}</option>
                                    @else
                                        @php
                                            $remainingLeave = DB::table('leavebalances')
                                                ->where('u_id', Auth::id())
                                                ->where('typeL_id', $typeLeave->id)
                                                ->value('remainingLeave');
                                        @endphp
                                        @if($remainingLeave > 0)
                                            <option value="{{ $typeLeave->id }}">{{ $typeLeave->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('typeL_id') <span class="text-danger">Please select type</span> @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label>วันที่เริ่มลา</label>
                            <input type="date" name="firstDate" id="firstDate" value="{{ old('firstDate') }}">
                            @error('firstDate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label>วันที่สิ้นสุด</label>
                            <input type="date" name="endDate" id="endDate" value="{{ old('endDate') }}">
                            @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>ข้อมูลเพิ่มเติม (ถ้ามี)</label>
                            <textarea name="detail" class="form-control mt-2" rows="3">{{ old('detail') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file"> Upload File (ถ้ามี) *pdf,jpg,jpeg,png</label>
                            <input type="file" name="file" class="form-control mt-2">
                        </div>
                        <div class="mb3 ">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="/leaveMain" class="btn btn-danger ">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
