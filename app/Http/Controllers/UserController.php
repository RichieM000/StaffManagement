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
    
        // Fetch task counts by status
        $taskCounts = Task::where('assigned_to', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
    
        // Fetch leave request counts by status
        $leaveCounts = LeaveRequest::where('user_id', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
    
        return view('dashboard', compact('taskCounts','leaveCounts'));
    }
    

}
