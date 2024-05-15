<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
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

    // Filter tasks that have a status of 'pending'
    $pendingTasks = $userTasks->where('status', 'pending');

    // Count the number of pending tasks
    $pendingTasksCount = $pendingTasks->count();
            
           
    
        // Fetch leave request counts by status
        $leaveCounts = LeaveRequest::where('user_id', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
    
            $user = auth()->user();

            $attendanceToday = $user->attendances()->whereDate('date', now()->toDateString())->first();

            // Check if the user has clocked in today
            $showTimeIn = !$attendanceToday;
        
            // Check if the user has clocked out today
            $showTimeOut = $attendanceToday && !$attendanceToday->clock_out;
            
        
            $attendances = $user->attendances()->get();



        return view('dashboard', compact( 'tasks', 'user','leaveCounts','attendances', 'showTimeIn', 'showTimeOut','pendingTasksCount'));
    }
    

}
