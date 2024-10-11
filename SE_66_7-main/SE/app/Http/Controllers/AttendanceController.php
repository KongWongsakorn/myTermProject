<?php

namespace App\Http\Controllers;

use App\Models\Atten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LeaveOfAbsence; 
use Carbon\Carbon; 

class AttendanceController extends Controller
{
    // แสดงผลข้อมูล
    public function showAllatten(Request $request)
    {
        $user = Auth::user();
        $all_atten = Atten::with('user')->where('u_id', $user->id)->get();
        $hasCheckedInToday = Atten::where('u_id', $user->id)
                                  ->whereDate('date', now()->format('Y-m-d'))
                                  ->exists();
    
        
        return view('Attendance', compact('all_atten', 'hasCheckedInToday'));
    }


    public function search(Request $request)
    {
        $search = $request->get('search');
        $user = Auth::user();

        $all_atten = Atten::where('u_id', $user->id)
            ->where(function ($query) use ($search) {
                $query->where('date', 'like', '%' . $search . '%')
                    ->orWhere('time', 'like', '%' . $search . '%');
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('firstname', 'like', "%$search%")
                    ->orWhere('lastname', 'like', "%$search%");
            })
            ->get();

        $hasCheckedInToday = Atten::where('u_id', $user->id)
                                ->whereDate('date', now()->format('Y-m-d'))
                                ->exists();

            return view('Attendance', compact('all_atten', 'search', 'hasCheckedInToday'));
    }
    


    public function addAttendance(Request $request)
    {
        $user = Auth::user();

        
        $todayAttendance = Atten::where('u_id', $user->id)->whereDate('date', now()->format('Y-m-d'))->first();

       
        if ($todayAttendance) {
            return back()->with('error', 'You have already recorded your attendance today.');
        }

        $date = now()->format('Y-m-d');

        $leaveRecord = LeaveOfAbsence::where('u_id', $user->id)
                                      ->whereDate('firstdate', '<=', $date)
                                      ->whereDate('enddate', '>=', $date)
                                      ->where('status', 'กำลังดำเนินงาน') 
                                      ->first();
    
       
        if ($leaveRecord) {
            $leaveRecord->status = 'ยกเลิก'; 
            $leaveRecord->save();
        }
        
        $attendance = new Atten;
        $attendance->u_id = $user->id;
        $attendance->date = now()->format('Y-m-d');
        $attendance->time = now()->format('H:i:s');
        $attendance->save();

        return back()->with('success', 'Attendance recorded successfully!');
    }

    
    
}
