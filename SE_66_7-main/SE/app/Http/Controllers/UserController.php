<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Role;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    function index(){
        $users = User::orderBy('id', 'desc')->paginate(10);;
        return view('userMain',compact('users'));
    }

    public function userStore(Request $request)
{
    // ตรวจสอบและรับข้อมูลที่ส่งมาจากฟอร์ม
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:7',
        'subcategory' => 'required|exists:subcategories,id',
        'role' => 'required|array',
        'role.*' => 'exists:roles,id',
    ]);

    // สร้างผู้ใช้งาน
    $user = new User();
    $user->firstname = $validatedData['firstname'];
    $user->lastname = $validatedData['lastname'];
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']);
    $user->s_id = $validatedData['subcategory'];
    $user->save();

    // กำหนดตำแหน่ง (Role) ให้กับผู้ใช้งาน
    $user->roles()->attach($validatedData['role']);

    // ส่งกลับไปยังหน้าหลักหรือหน้าที่คุณต้องการ
    return redirect()->route('userMain')->with('success', 'User created successfully');
}
function indexCreate(){
    $subcategories = SubCategory::all();
    $roles = Role::all();
    return view('createUser',compact('roles','subcategories'));
}

function searchUser(Request $request)
{
    $search = $request->get('search');
    $users = User::where(function ($query) use ($search) {
        $query->where('firstname', 'like', '%' . $search . '%')
            ->orWhere('lastname', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    })->orWhereHas('roles', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    })->orWhereHas('subcategory', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    })
    ->orderBy('id', 'desc')
    ->paginate(10);

    return view('userMain', compact('users'));
}

public function userUpdate(Request $request, $id)
{
    // ตรวจสอบและรับข้อมูลที่ส่งมาจากฟอร์ม
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
        'password' => 'nullable|string|min:7',
        'subcategory' => 'required|exists:subcategories,id',
        'role' => 'required|array',
        'role.*' => 'exists:roles,id',
    ]);

    // หาผู้ใช้งานที่ต้องการแก้ไข
    $user = User::findOrFail($id);

    // อัปเดตข้อมูลผู้ใช้งาน
    $user->firstname = $validatedData['firstname'];
    $user->lastname = $validatedData['lastname'];
    $user->email = $validatedData['email'];

    // ถ้ามีการระบุรหัสผ่านใหม่ให้เข้ารหัสก่อนบันทึก
    if ($request->filled('password')) {
        $user->password = Hash::make($validatedData['password']);
    }

    $user->s_id = $validatedData['subcategory'];
    $user->save();

    // กำหนดตำแหน่ง (Role) ให้กับผู้ใช้งาน
    $user->roles()->sync($validatedData['role']);

    // ส่งกลับไปยังหน้าที่ต้องการหลังจากแก้ไขข้อมูลเสร็จสมบูรณ์
    return redirect()->route('userMain')->with('success', 'User updated successfully');
}

public function indexEdit($id)
{
    $user = User::findOrFail($id);
    $subcategories = SubCategory::all();
    $roles = Role::all();
    return view('editUser', compact('user', 'roles', 'subcategories'));
}

public function userDelete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('userMain')->with('success', 'User deleted successfully');
}
    

}