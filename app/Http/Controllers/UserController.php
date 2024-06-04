<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\TaskStatus;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    
    public function index()
    {
        $userId = auth()->user()->id;
        
        $user = auth()->user();
        $tasks = $user->tasks()->get();

// Get the user's tasks
$userTasks = Task::where('assigned_to', $userId)->get();

$overallTasks = Task::where('assigned_to', $userId)->count();

$performancecount = Evaluation::where('user_id', $userId)->count();

// Filter tasks that have a status of 'pending'
$pendingTasks = $userTasks->where('status', 'pending');
$progressTasks = $userTasks->where('status', 'in_progress');
$rejectedTasks = $userTasks->where('status', 'rejected');
$completeTasks = $userTasks->where('status', 'completed');
$deadline = $userTasks->where('status', 'exceeded deadline');

// Count the number of pending tasks
$pendingTasksCount = $pendingTasks->count();
$progressTasksCount = $progressTasks->count();
$rejectedTasksCount = $rejectedTasks->count();
$completeTasksCount = $completeTasks->count();
$deadlinecount = $deadline->count();
        
       

    // Fetch leave request counts by status
    $leaveCounts = LeaveRequest::where('user_id', $userId)->get();
    $overallLeave = LeaveRequest::where('user_id', $userId)->count();


    $pendingleave = $leaveCounts->where('status', 'pending');
    $approvedleave = $leaveCounts->where('status', 'approved');
    $rejectedleave = $leaveCounts->where('status', 'rejected');

    $pendingleaveCount = $pendingleave->count();
    $approvedleaveCount = $approvedleave->count();
    $rejectedleaveCount = $rejectedleave->count();
    
            $user = auth()->user();

            $attendanceToday = $user->attendances()->whereDate('date', now()->toDateString())->first();

            // Check if the user has clocked in today
            $showTimeIn = !$attendanceToday;
        
            // Check if the user has clocked out today
            $showTimeOut = $attendanceToday && !$attendanceToday->clock_out;
            
        
            $attendances = $user->attendances()->get();

            // Check current time
                    $currentHour = now('Asia/Manila')->format('H');
                    $currentMinute = now('Asia/Manila')->format('i');

// Enable "Time In" button after 1:00 PM
            $enableTimeInAfternoon = ($currentHour >= 13 && $currentMinute >= 0);
            $enableTimeInMorning = ($currentHour >= 4 && $currentHour < 12);



        return view('dashboard', compact( 'tasks', 'enableTimeInAfternoon', 'enableTimeInMorning', 'performancecount', 'deadlinecount', 'user','leaveCounts','attendances', 'showTimeIn', 'showTimeOut','pendingTasksCount','progressTasksCount',
        'rejectedTasksCount','completeTasksCount','overallTasks','pendingleaveCount','approvedleaveCount','rejectedleaveCount','overallLeave'));
    }
    

}
