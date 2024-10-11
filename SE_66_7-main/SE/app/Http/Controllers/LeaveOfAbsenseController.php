<?php

namespace App\Http\Controllers;

use App\Models\eventDate;
use App\Models\leaveOfAbsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TypeLeave;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Stroage;
use App\Models\Role;
use Illuminate\Http\Response;
use Carbon\Carbon;

class LeaveOfAbsenseController extends Controller
{

    function index()
    {
        $users = Auth::user();
        $LeaveOfAbsence = leaveOfAbsence::where('u_id', $users->id)
            ->orderBy('id', 'desc')
            ->with('user', 'typeLeave', 'approver')
            ->paginate(10);
        // $countDate = $this->getTotalLeaveDays();
        return view('leaveMain', compact('LeaveOfAbsence', 'users'));
    }

    function download($id)
    {
        $id = leaveOfAbsence::find($id)->first;
        return response()->download(public_path('$id->file'));
    }

    function detail($id)
    {
        $detail = leaveOfAbsence::find($id);

        if ($detail->u_id !== Auth::id()) {
            abort(403); // แสดงหน้า 403 Forbidden (ไม่อนุญาต)
        }

        return view('leaveDetail', compact('detail'));
    }

    function create()
    {
        $users = AUth::user();
        $typeLeaves = TypeLeave::all();
        return view('leaveCreate', compact('users', 'typeLeaves'));
    }

    function Approver()
    {
        if (Auth::user()->hasRole('9')) {
            $approver = User::whereHas('roles', function ($q) {
                $q->where('role_id', 10)->where('s_id', Auth::user()->s_id);
            })->get();
        }
        if (Auth::user()->hasRole('10')) {
            $approver = User::whereHas('roles', function ($q) {
                $q->where('role_id', 8);
            })->get();
        }
        if (Auth::user()->hasRole('7') || Auth::user()->hasRole('8')) {
            $approver = User::whereHas('roles', function ($q) {
                $q->where('role_id', 7);
            })->get();
        } else {
            $approver = User::whereHas('roles', function ($q) {
                $q->where('role_id', 7);
            })->get();
        }
        return $approver->first()->id;
    }

    // function getTotalLeaveDays()
    // {
    //     $result = DB::table('leaveofabsences')
    //         ->select(DB::raw('*'), DB::raw('SUM(DATEDIFF(endDate, firstDate)) AS totalDays'))
    //         ->groupBy('id')
    //         ->get();
    //     return $result;
    // }

    function store(Request $request)
    {
        $request->validate([ // ต้องระบุข้อมูล
            'typeL_id' => 'required',
            'firstDate' => 'required',
            'endDate' => 'required',
            'detail' => 'nullable|max:255|string',
            'file' => 'nullable|file|max:1024|mimes:pdf,jpg,jpeg,png',
        ]);

        // เรียกใช้ Model leaveOfAbsense
        $leave = new leaveOfAbsence();

        // เซ็ตค่าที่ต้องการบันทึกลงในฐานข้อมูล
        $leave->u_id = Auth::user()->id;
        $leave->typeL_id = $request->typeL_id;
        $leave->firstDate = $request->firstDate;
        $leave->endDate = $request->endDate;
        $leave->u_approver = $this->Approver();

        if ($request->hasAny('detail')) { // ตรวจสอบว่ามีข้อมูลหรือไม่
            $leave->detail = $request->detail;
        }
        // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
        if ($request->has('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/leave/';
            $file->move($path, $filename);
            $leave->file = $path . $filename;
        }

        // บันทึกข้อมูลลา
        $leave->save();
        return redirect('leaveMain')->with('status', 'Leave of Absence created');
    }

    public function search(Request $request)
    {
        $search = $request->get('search'); // รับค่าการค้นหาจากฟอร์ม

        // ดึงข้อมูลการลาโดยคำนึงถึงการค้นหา
        // $LeaveOfAbsence = leaveOfAbsence::with('user', 'typeLeave', 'approver')
        //     ->where('firstDate', 'like', '%' . $search . '%')
        //     ->orWhere('endDate', 'like', '%' . $search . '%')
        //     ->orWhere('status', 'like', '%' . $search . '%')
        //     ->orWhereHas('user',str(auth()->user()->id))
        //     ->orWhereHas('typeLeave', function ($query) use ($search) {
        //         $query->where('name', 'like', '%' . $search . '%');
        //     })
        //     ->orWhereHas('approver', function ($query) use ($search) {
        //         $query->where('firstname', 'like', '%' . $search . '%')
        //             ->orWhere('lastname', 'like', '%' . $search . '%');
        //     })
        //     ->get();
        // ส่งข้อมูลการลาที่ค้นหาไปยัง View
        $typeLeaves = TypeLeave::all();
        $LeaveOfAbsence=leaveOfAbsence::where('u_id', auth()->user()->id)->where('firstDate', 'like', '%' . $search . '%' )->where('u_id', auth()->user()->id)
        ->orWhere('endDate', 'like', '%' . $search . '%')->where('u_id', auth()->user()->id)
        ->orWhere('status', 'like', '%' . $search . '%')->where('u_id', auth()->user()->id)
        ->orWhereHas('typeLeave', function ($query) use ($search) {
                     $query->where('name', 'like', '%' . $search . '%')
                           ->where('u_id', auth()->user()->id);})
                           ->orderBy('id', 'desc')
                           ->paginate(10);
        return view('leaveMain', compact('LeaveOfAbsence', 'typeLeaves'));
    
    }
}
