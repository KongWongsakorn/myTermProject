<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveOfAbsenseController;
use App\Http\Controllers\AcknowledgeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HisleaveController;
use App\Http\Controllers\TypeleaveController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DateNameController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

});

Route::get('/', function () {
    return view('login');
})->name('welcome');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');



Route::middleware(['auth'])->group(function () {


    Route::middleware(['role:ผู้ดูแลระบบ'])->group(function () {
        Route::get('/user/create', [UserController::class, 'indexCreate'])->name('createUser');
        Route::get('/user/edit/{id}', [UserController::class, 'indexEdit'])->name('userEdit');
        Route::post('/user/create', [UserController::class, 'userStore'])->name('userStore');
        Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('userUpdate');
        Route::get('/userMain', [UserController::class, 'index'])->name('userMain');
        Route::get('/userMain/search', [UserController::class, 'searchUser'])->name('searchUser');
        Route::delete('/user/delete/{id}', [UserController::class, 'userDelete'])->name('userDelete');

        Route::get('/calendar/create', [CalendarController::class, 'create'])->name('calendar.create');
        Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
        Route::get('calendar/{id}/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
        Route::put('/calendar/{id}', [CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/calendar/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

        Route::get('/display/subcategory', [SubcategoryController::class, 'showAllSubcategory'])->name('showAllSubcategory');
        Route::get('/add/subcategory', [SubcategoryController::class, 'addSubcategory'])->name('addSubcategory');
        Route::get('/edit/subcategory', [SubcategoryController::class, 'editSubcategory'])->name('editSubcategory');
        Route::get('delete/subcategory/{id}', [SubcategoryController::class, 'deleteSubcategory'])->name('deleteSubcategory');

        Route::get('/date_names/create', [DateNameController::class, 'create'])->name('date_names.create');
        Route::post('/date_names', [DateNameController::class, 'store'])->name('date_names.store');
        Route::delete('/date_names/{id}', [DateNameController::class, 'destroy'])->name('date_names.destroy');
        Route::get('date_names/{id}/edit', [DateNameController::class, 'edit'])->name('date_names.edit');
        Route::put('/date_names/{id}', [DateNameController::class, 'update'])->name('date_names.update');

        Route::get('/display/typeleave', [TypeleaveController::class, 'showAllTypeleave'])->name('showAllTypeleave');
        Route::get('/edit/typeleave', [TypeleaveController::class, 'editTypeleave'])->name('editTypeleave');

        Route::get('/leavehis', [HisleaveController::class, 'showleavehis']);
    });

    

    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/leaveMain', [LeaveOfAbsenseController::class, 'index'])->name('leaveMain');
    Route::get('/leaveMain/Create', [LeaveOfAbsenseController::class, 'create'])->name('leaveCreate');
    Route::post('/leaveMain/Create', [LeaveOfAbsenseController::class, 'store'])->name('leaveStore');
    Route::get('/leaveMain/search', [LeaveOfAbsenseController::class, 'search'])->name('searchLeave');
    Route::get('/leaveDetail/{id}', [LeaveOfAbsenseController::class, 'detail'])->name('leaveDetail');
    Route::get('/leaveDetail/{file}', [LeaveOfAbsenseController::class, 'download'])->name('leaveDownload');

    //การเข้างาน
    Route::get('/Attendance', [AttendanceController::class, 'showAllatten'])->name('display.attendance');
    Route::get('/Attendance/search', [AttendanceController::class, 'search'])->name('display.search');
    Route::post('/attendance/add', [AttendanceController::class, 'addAttendance'])->name('attendance.add');


    Route::middleware(['auth', 'role:หัวหน้าหมวด,ผู้อำนวยการ,รองผู้อำนวยการ'])->group(function () {
        Route::get('/display/leaveofabsences', [CrudController::class, 'showAllLeaveofabsences']);
        Route::get('/edit/leaveofabsences', [CrudController::class, 'editLeave'])->name('editLeave');
        Route::get('/leaveofabsences/search', [CrudController::class, 'search'])->name('searchLeaveHis');
        Route::get('/add/leaveofabsences', [CrudController::class, 'addLeave'])->name('addLeave');
        Route::get('/detailLeave/{id}', [CrudController::class, 'detail'])->name('detailLeave');
        Route::get('/searchapprover', [CrudController::class, 'search']);

        Route::get('/acknowledge', [AcknowledgeController::class, 'index'])->name('ackindex');
        Route::get('/search', [AcknowledgeController::class, 'search']);
        Route::get('/acknowledge/{id}', [AcknowledgeController::class, 'acknowledge'])->name('accept');
        Route::get('/acknowledge/detail/{id}', [AcknowledgeController::class, 'show'])->name('ackdetail');
        Route::get('/acknowledge/detail/{file}', [AcknowledgeController::class, 'download'])->name('ackdownload');

    });
    
    // Route::get('/leavetype', function () {
    //     return view('leavetype');
    // });

    // Route::get('/leavehis', function () {
    //     return view('leavehis');
    // });


    Route::get('/leavetype', [HisleaveController::class, 'showleavetype']);

    //หน้าจัดการชนิดการลาแก้ไขชื่อ-จำนวน


    //Calendar  
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/{id}', [CalendarController::class, 'detail'])->name('calendar.detail');

    //DateName
    Route::get('/date_names', [DateNameController::class, 'index'])->name('date_names.index');
});
