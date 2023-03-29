<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskMetaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\CronController;
use App\Models\Attendance;
use App\Http\Livewire\LivewireToaster;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('livewire-toaster', LivewireToaster::class);
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
});
Route::get('/start-queue', function () {
    Artisan::call('queue:work');
});
Route::get('/start-schedule', function () {
    Artisan::call('schedule:run');
});

Route::get('/check-attendance', [CronController::class,'checkAttendance'])->name('check.attendance');
Route::get('/testing', [CronController::class,'testing']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    "checkUser",
])->group(function () {

    Route::get('/', [DashboardController::class,'dashboard'])->name('home');
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('/emp/add', [EmployeeController::class,'create'])->name('employee.add');
    Route::post('/update-emp-password', [EmployeeController::class,'updateEmpPassword'])->name('emp.updatePassword');

    

    Route::get('/attendance/history', [AttendanceController::class,'index'])->name('attendance.history');
    
    Route::group(['middleware'=>['role:EMPLOYEE']],function(){
        
        Route::post('/attendance/punch', [AttendanceController::class,'punch'])->name('attendance.punch');
        
    });
    
    Route::group(['middleware'=>['role:SUPER_ADMIN|ADMIN']],function(){
    });
    
    Route::resource('emp', EmployeeController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('task', TaskController::class);
    Route::resource('taskMeta', TaskMetaController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('holiday', HolidaysController::class);
    
    Route::post('/task-updates/{taskId}', [TaskController::class,'taskUpdates'])->name('task.updates');
    Route::get('/report/attendance', [ReportController::class,'attendanceReport'])->name('report.attendance');
    
});
