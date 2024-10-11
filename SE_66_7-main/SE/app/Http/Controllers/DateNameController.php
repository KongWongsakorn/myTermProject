<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DateName;

class DateNameController extends Controller
{
    public function dateNames()
    {
        $dateNames = DateName::all(); // ดึงข้อมูลทั้งหมดจากตาราง date_names
        return view('calendar.DateNames', ['dateNames' => $dateNames]);
    }
    public function index()
    {
        $dateNames = DateName::all(); // ดึงข้อมูลทั้งหมดจากตาราง date_names
        return view('date_names.index', ['dateNames' => $dateNames]); // ส่งข้อมูลไปยัง View ชื่อ date_names.index
    }
    public function create()
    {
        return view('date_names.create');
    }

        public function store(Request $request)
    {
        // ตรวจสอบและกำหนดข้อมูลที่ผู้ใช้ป้อนจากแบบฟอร์ม
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // สร้างรายการใหม่ในฐานข้อมูลด้วยข้อมูลที่ผู้ใช้ป้อน
        DateName::create($validatedData);

        // Redirect ไปยังหน้าที่เหมาะสมหลังจากบันทึกข้อมูล
        return redirect()->route('date_names.index');
    }
    public function destroy($id)
    {
        $dateName = DateName::findOrFail($id);
        $dateName->delete();

        return redirect()->route('date_names.index')->with('success', 'DateName deleted successfully');
    }
    public function edit($id)
    {
        // ค้นหาข้อมูล DateName ด้วย ID
        $dateName = DateName::findOrFail($id);
        
        // ส่งข้อมูล DateName ไปยังหน้าแก้ไขข้อมูล
        return view('date_names.edit', compact('dateName'));
    }
    public function update(Request $request, $id)
    {
        // ตรวจสอบและกำหนดข้อมูลที่ผู้ใช้ป้อนจากแบบฟอร์ม
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // ค้นหาข้อมูล DateName ด้วย ID
        $dateName = DateName::findOrFail($id);

        // อัปเดตข้อมูลในฐานข้อมูลด้วยข้อมูลที่ผู้ใช้ป้อน
        $dateName->update($validatedData);

        // Redirect ไปยังหน้าที่เหมาะสมหลังจากอัปเดตข้อมูล
        return redirect()->route('date_names.index')->with('success', 'DateName updated successfully');
    }

    
}
