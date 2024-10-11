<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\DateName;


class CalendarController extends Controller
{
    public function index()
    {
        $events = Calendar::all(); // ดึงข้อมูลทั้งหมดจากโมเดล Calendar
        return view('calendar.index', ['events' => $events]); // ส่งข้อมูลไปยัง View ชื่อ calendar.index
    }
    public function destroy($id)
    {
        // ค้นหาข้อมูลที่ต้องการลบ
        $events = Calendar::findOrFail($id);

        // ลบข้อมูล
        $events->delete();

        // Redirect กลับไปยังหน้าที่เหมาะสมหลังจากการลบข้อมูล
        return redirect()->route('calendar.index')->with('success', 'Deleted successfully');
    }
    public function create()
    {
        $dateNames = DateName::all();
        return view('calendar.create', compact('dateNames'));
    }

    // Method สำหรับบันทึกข้อมูลใหม่
    public function store(Request $request)
    {
        // ตรวจสอบและกำหนดข้อมูลตามที่ผู้ใช้กรอกในฟอร์ม
        $validatedData = $request->validate([
            'date' => 'required',
            'dateN_id' => 'required',
            'checkRest' => 'required',
            'detail' => 'required',
        ]);

        // สร้างรายการใหม่ในฐานข้อมูลด้วยข้อมูลที่ผู้ใช้กรอก
        Calendar::create($validatedData);

        // ส่งกลับไปยังหน้า index หลังจากบันทึกข้อมูลเสร็จสมบูรณ์
        return redirect()->route('calendar.index');
    }
    public function edit($id)
    {
        $event = Calendar::findOrFail($id);
        $dateNames = DateName::all();
        return view('calendar.edit', ['event' => $event, 'dateNames' => $dateNames]);
    }
    public function update(Request $request, $id)
    {
        $event = Calendar::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'required',
            'dateN_id' => 'required',
            'checkRest' => 'required',
            'detail' => 'required',
        ]);

        $event->update($validatedData);

        return redirect()->route('calendar.index')->with('success', 'Event updated successfully');
    }
    public function detail($id)
    {
        $event = Calendar::findOrFail($id); // สมมติว่า model ของคุณชื่อว่า Calendar

        return view('calendar.detail', compact('event'));
    }

}
