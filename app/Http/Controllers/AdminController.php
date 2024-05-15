<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\LeaveRequest;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function show(){
        return view('admin.adminlogin');
    }

    public function index()
    {
        // Count overall users excluding users with 'admin' usertype
        $overallUsersCount = User::where('usertype', '!=', 'admin')->count();
    
        // Count users in each jobrole excluding 'admin'
        $usersByJobrole = User::where('usertype', '!=', 'admin')
        ->selectRaw('jobrole as jobrole') // Use selectRaw to alias the column as 'jobrole'
        ->selectRaw('count(*) as count')
        ->groupBy('jobrole')
        ->get();
    
        // Count overall tasks
        $overallTasksCount = Task::count();
    
         // Count rejected tasks
         $pendingTasksCount = Task::where('status', 'pending')->count();
         $acceptedTasksCount = Task::where('status', 'accepted')->count();
         $completedTasksCount = Task::where('status', 'completed')->count();
         $rejectedTasksCount = Task::where('status', 'rejected')->count();
        // Check if the success message exists in the session
        $successMessage = session('successMessage');
        
        //count leave requests 
        $overallLeaveCount = LeaveRequest::count();
        $pendingLeave = LeaveRequest::where('status', 'pending')->count();
        $rejectedLeave = LeaveRequest::where('status', 'rejected')->count();
        $approveLeave = LeaveRequest::where('status', 'approved')->count();
        
          // Fetch login history for admins and users
    $adminLoginHistory = LoginHistory::with('user')->whereHas('user', function ($query) {
        $query->where('usertype', 'admin');
    })->latest()->paginate(10);

    $userLoginHistory = LoginHistory::with('user')->whereHas('user', function ($query) {
        $query->where('usertype', 'user');
    })->latest()->paginate(10);
    
        return view('admin.dashboard', compact('adminLoginHistory', 'userLoginHistory','overallUsersCount', 'pendingTasksCount', 'acceptedTasksCount', 'completedTasksCount', 'approveLeave', 'pendingLeave', 'rejectedLeave', 'overallLeaveCount', 'usersByJobrole', 'overallTasksCount', 'successMessage', 'rejectedTasksCount'));
    }

    public function user(){
        return view('admin.user');
    }

    
}
