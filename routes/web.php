<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('admin/add/staff', [StaffController::class, 'create'])->name('admin.add-staff');
Route::post('/add-staff', [StaffController::class, 'store'])->name('addstaff');
Route::get('admin/edit/staff/{id}', [StaffController::class, 'edit'])->name('admin.edit-staff');
Route::put('/update/staff/{id}', [StaffController::class, 'update'])->name('editstaff');
Route::delete('/delete/staff/{id}', [StaffController::class, 'destroy'])->name('admin.delete-staff');
Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');
Route::get('admin/user', [AdminController::class, 'user'])->middleware(['auth', 'admin'])->name('user');

Route::get('admin/staff', [StaffController::class, 'index'])->name('admin.staff');
// Route::get('/teams-and-departments', [StaffController::class, 'teamsAndDepartments'])
//     ->name('admin.teams');

Route::get('admin/teams', [TeamController::class, 'index'])->name('admin.teams');

// handling task
Route::get('admin/task', [TaskController::class, 'index'])->name('admin.task');
Route::get('admin/add-task', [TaskController::class, 'create'])->name('add-task');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks-store');









