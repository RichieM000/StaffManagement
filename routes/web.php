<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware('auth', 'verified', 'user')->group(function () {

    Route::get('/task', [TaskController::class, 'userTask'])->name('user.task');
    Route::post('/task/{id}/accept', [TaskController::class, 'accept'])->name('task.accept');
    Route::post('/task/reject/{id}', [TaskController::class, 'reject'])->name('task.reject');
    Route::post('/task/complete/{id}', [TaskController::class, 'complete'])->name('task.complete');


    Route::get('/leave', [LeaveController::class, 'userleave'])->name('user.leave');
    Route::post('/leave/{leaveRequest}/fileleave', [LeaveController::class, 'store'])->name('user.fileleave');
    Route::get('/leave/{leaveRequest}/edit', [LeaveController::class, 'edit'])->name('user.leaveedit');
    Route::put('/leave/{leaveRequest}/update', [LeaveController::class, 'update'])->name('user.leaveupdate');
    Route::delete('/leave/{leaveRequest}', [LeaveController::class, 'delete'])->name('user.leavedestroy');


    });
    



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});







require __DIR__.'/auth.php';

Route::middleware('auth','admin')->group(function (){
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('admin/user', [AdminController::class, 'user'])->name('user');
    Route::get('admin/staff', [StaffController::class, 'index'])->name('admin.staff');


    Route::get('/add/staff', [StaffController::class, 'create'])->name('admin.add-staff');
    Route::post('/add-staff', [StaffController::class, 'store'])->name('addstaff');
    Route::get('/edit/staff/{user}', [StaffController::class, 'edit'])->name('admin.edit-staff');
    Route::put('/update/staff/{user}', [StaffController::class, 'update'])->name('editstaff');
    Route::delete('/delete/staff/{user}', [StaffController::class, 'destroy'])->name('admin.delete-staff');


    Route::get('admin/teams', [TeamController::class, 'index'])->name('admin.teams');
// handling task
Route::get('admin/task', [TaskController::class, 'index'])->name('admin.task');
Route::get('admin/add-task', [TaskController::class, 'create'])->name('add-task');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks-store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks-edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks-update');
Route::delete('/tasks/{task}/delete', [TaskController::class, 'destroy'])->name('tasks-destroy');

Route::get('admin/tasks/pending', [TaskController::class, 'pendingTasks'])->name('admin.tasks.pending');


Route::get('admin/leave', [LeaveController::class, 'adminIndex'])->name('admin-leave');
Route::put('admin/leave/approve/{id}', [LeaveController::class, 'approveLeaveRequest'])->name('admin-approve');
Route::put('admin/leave/reject/{id}', [LeaveController::class, 'rejectLeaveRequest'])->name('admin-reject');
Route::delete('admin/leave/delete/{id}', [LeaveController::class, 'destroy'])->name('admin-delete');

});
Route::get('admin/login', [AdminController::class, 'show'])->name('admin-login');





// Route::get('/teams-and-departments', [StaffController::class, 'teamsAndDepartments'])
//     ->name('admin.teams');