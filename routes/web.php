<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SadminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth', 'verified', 'user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('userdashboard');
    Route::get('/task', [TaskController::class, 'userTask'])->name('user.task');
    Route::post('/task/{id}/accept', [TaskController::class, 'accept'])->name('task.accept');
    Route::post('/task/reject/{id}', [TaskController::class, 'reject'])->name('task.reject');
    Route::post('/task/complete/{id}', [TaskController::class, 'complete'])->name('task.complete');


    Route::get('/leave', [LeaveController::class, 'userleave'])->name('user.leave');
    Route::post('/leave/{leaveRequest}/fileleave', [LeaveController::class, 'store'])->name('user.fileleave');
    Route::get('/leave/{leaveRequest}/edit', [LeaveController::class, 'edit'])->name('user.leaveedit');
    Route::put('/leave/{leaveRequest}/update', [LeaveController::class, 'update'])->name('user.leaveupdate');
    Route::delete('/leave/{leaveRequest}', [LeaveController::class, 'delete'])->name('user.leavedestroy');

    Route::get('/timesheet', [AttendanceController::class, 'clockrecord'])->name('index.clock');
    Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('clock.in');
    Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('clock.out');
    Route::delete('/timesheet/delete{id}', [AttendanceController::class, 'destroyrecord'])->name('delete.timesheet');

    // evaluation
    Route::get('/view/evaluation/{id}', [EvaluationController::class, 'viewEvaluationData'])->name('view-evaluation-data');

    Route::get('/evaluation', [EvaluationController::class, 'userevaluation'])->name('user.evaluation');
    


    });
    



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



require __DIR__.'/auth.php';

Route::middleware('auth:admin', 'admin')->group(function (){




    Route::get('admin/registerstaff', [RegisteredUserController::class, 'create'])
                ->name('admin.register');

    Route::post('admin/register/store', [RegisteredUserController::class, 'store'])->name('adminregister');

    Route::get('admin/loghistory', [AdminController::class, 'showlogs'])->name('admin.logs');

    Route::post('/logs/clear', [AdminController::class, 'clear'])->name('logs.clear');


    // Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');



    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('admin/user', [AdminController::class, 'user'])->name('user');
    Route::get('admin/staff', [StaffController::class, 'index'])->name('admin.staff');


    Route::get('/add/staff', [StaffController::class, 'create'])->name('admin.add-staff');
    Route::post('/add-staff', [StaffController::class, 'store'])->name('addstaff');
    Route::get('/edit/staff/{user}', [StaffController::class, 'edit'])->name('admin.edit-staff');
    Route::put('/update/staff/{user}', [StaffController::class, 'update'])->name('editstaff');
    Route::delete('/delete/staff/{user}', [StaffController::class, 'destroy'])->name('admin.delete-staff');
    Route::delete('delete-multiple-rows', [StaffController::class, 'deleteMultipleRowsstaff'])->name('admin-deleterows-staff');


    Route::get('admin/teams', [TeamController::class, 'index'])->name('admin.teams');
// handling task
Route::get('admin/task', [TaskController::class, 'index'])->name('admin.task');
Route::get('admin/add-task', [TaskController::class, 'create'])->name('add-task');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks-store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks-edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks-update');
Route::delete('/tasks/{task}/delete', [TaskController::class, 'destroy'])->name('tasks-destroy');
Route::delete('admin-delete-task', [TaskController::class, 'deleteMultipleRowstask']);

Route::get('admin/tasks/pending', [TaskController::class, 'pendingTasks'])->name('admin.tasks.pending');

// leave
Route::get('admin/leave', [LeaveController::class, 'adminIndex'])->name('admin-leave');
Route::put('admin/leave/approve/{id}', [LeaveController::class, 'approveLeaveRequest'])->name('admin-approve');
Route::put('admin/leave/reject/{id}', [LeaveController::class, 'rejectLeaveRequest'])->name('admin-reject');
Route::delete('admin/leave/delete/{id}', [LeaveController::class, 'destroy'])->name('admin-delete');
Route::delete('delete-multiple-rows', [LeaveController::class, 'deleteMultipleRowsleave'])->name('admin-deleterows-leave');

// attendance
Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('admin-attendance');
Route::delete('/admin/attendancedelete/{id}', [AttendanceController::class, 'destroyattendance'])->name('admin-deleteattendance');
Route::delete('delete-multiple-rows', [AttendanceController::class, 'deleteMultipleRows'])->name('deleterows');
Route::get('admin/attendance2', [AttendanceController::class, 'index2'])->name('admin-attendance2');

// performance evaluation
Route::get('/admin/evaluation/{id}', [EvaluationController::class, 'getEvaluationData'])->name('get-evaluation');

Route::get('/get-tasks/{userId}', [EvaluationController::class, 'fetchTasks'])->name('get-tasks');
Route::get('admin/evaluation', [EvaluationController::class, 'index'])->name('admin-evaluation');
Route::get('/evaluation/admin/add', [EvaluationController::class, 'addevaluation'])->name('admin-addevaluation');
Route::post('/evaluation/store', [EvaluationController::class, 'store'])->name('admin-storeevaluation');
Route::get('/admin/edit/{evaluation}', [EvaluationController::class, 'editevaluation'])->name('admin-editevaluation');
Route::put('/admin/update{evaluation}', [EvaluationController::class, 'updateevaluation'])->name('admin-updateevaluation');
Route::delete('/admin/destroy{evaluation}', [EvaluationController::class, 'destroyevaluation'])->name('admin-deleteevaluation');
Route::delete('delete-multiple-rows', [EvaluationController::class, 'deleteMultipleRowseval'])->name('admin-deleterows-staff');



});
// Route::get('admin/login', [AdminController::class, 'show'])->name('admin-login');




Route::middleware('auth','systemadmin')->group(function () {
    // managing users

    Route::get('sadmin/registerstaff', [SadminController::class, 'create'])
                ->name('sadmin.register');

    Route::post('register', [SadminController::class, 'store'])->name('sadminregister');

    Route::get('systemadmin/loghistory', [SadminController::class, 'showlogs'])->name('sadmin.logs');
    Route::post('systemadmin/logs/clear', [SadminController::class, 'clear'])->name('logs.clear');


    Route::get('systemadmin/dashboard', [SadminController::class, 'mainindex'])->name('sadmin_dashboard');
    Route::get('systemadmin/users', [SadminController::class, 'showusers'])->name('sadmin_showusers');
    Route::get('systemadmin/create-users', [SadminController::class, 'createusers'])->name('sadmin_createusers');
    Route::post('systemadmin/store-users', [SadminController::class, 'storeusers'])->name('sadmin_storeusers');

    Route::get('systemadmin/create-admin', [SadminController::class, 'createadmin'])->name('sadmin_createadmin');
    Route::post('systemadmin/store-admin', [SadminController::class, 'storeadmin'])->name('sadmin_storeadmin');
    Route::put('systemadmin/update-admin/{id}', [SadminController::class, 'updateadmin'])->name('sadmin_updateadmin');


    Route::get('/edit-users/{user}', [SadminController::class, 'edituser'])->name('sadmin_editusers');
    Route::put('/update-users/{user}', [SadminController::class, 'updateuser'])->name('sadmin_updateusers');
    Route::delete('/delete-users/{user}', [SadminController::class, 'destroyuser'])->name('sadmin_deleteusers');
    Route::delete('delete-multiple-rows', [SadminController::class, 'deleteMultipleRowsstaff'])->name('deleterows-staff');

    Route::get('systemadmin/staffs', [SadminController::class, 'showstaffs'])->name('sadmin_showstaffs');
// manage tasks


    Route::get('systemadmin/tasks', [SadminController::class, 'showtasks'])->name('sadmin_showtasks');
    Route::get('systemadmin/createtasks', [SadminController::class, 'createtasks'])->name('sadmin_createtasks');
    Route::post('systemadmin/storetasks', [SadminController::class, 'storetasks'])->name('sadmin_storetasks');
    Route::get('/edit-tasks/{task}', [SadminController::class, 'edittasks'])->name('sadmin_edittasks');
    Route::put('/update-tasks/{id}', [SadminController::class, 'updatetasks'])->name('sadmin_updatetasks');
    Route::delete('/delete-tasks/{task}', [SadminController::class, 'destroytasks'])->name('sadmin_deletetasks');
    Route::delete('delete-task', [SadminController::class, 'deleteMultipleRowstask']);

// attendance
    Route::get('systemadmin/attendance-time', [SadminController::class, 'showattendance'])->name('sadmin_showattendance');
    Route::delete('/systemadmin/attendancedelete/{id}', [SadminController::class, 'destroyattendance'])->name('sadmin_deleteattendance');
    Route::delete('delete-multiple-rows', [SadminController::class, 'deleteMultipleRows'])->name('deleterows');

    Route::get('systemadmin/attendance-sheet', [SadminController::class, 'showattendancesheet'])->name('sadmin_showattendancesheet');
// leave
    Route::get('systemadmin/leave', [SadminController::class, 'showleave'])->name('sadmin_showleave');
    Route::put('systemadmin/leave/approve/{id}', [SadminController::class, 'approveleave'])->name('sadmin_approveleave');
    Route::put('systemadmin/leave/reject/{id}', [SadminController::class, 'rejectleave'])->name('sadmin_rejectleave');
    Route::delete('/systemadmin/leave/delete/{id}', [SadminController::class, 'destroyleave'])->name('sadmin_deleteleave');
    Route::delete('delete-multiple-rows', [SadminController::class, 'deleteMultipleRowsleave'])->name('deleterows-leave');

    // // evaluation
    Route::get('/systemadmin/evaluation/{id}', [SadminController::class, 'getEvaluationData'])->name('get-evaluation-data');

    Route::delete('delete-multiple-rows', [SadminController::class, 'deleteMultipleRowseval'])->name('deleterows-evaluation');
    Route::get('/systemadmin/get-tasks/{userId}', [SadminController::class, 'gettask'])->name('get-tasks');
    Route::get('systemadmin/evaluation', [SadminController::class, 'index'])->name('sadmin_evaluation');
    Route::get('/evaluation/systemadmin/add', [SadminController::class, 'addevaluation'])->name('sadmin_addevaluation');
    Route::post('/sysevaluation/store', [SadminController::class, 'storeevaluation'])->name('sadmin_storeevaluation');
    Route::get('/edit/{evaluation}', [SadminController::class, 'editevaluation'])->name('sadmin_editevaluation');
    Route::put('/update{evaluation}', [SadminController::class, 'updateevaluation'])->name('sadmin_updateevaluation');
    Route::delete('/destroy{evaluation}', [SadminController::class, 'destroyevaluation'])->name('sadmin_deleteevaluation');
    
   

});



// Route::get('/teams-and-departments', [StaffController::class, 'teamsAndDepartments'])
//     ->name('admin.teams');