<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
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
         $rejectedTasksCount = TaskStatus::where('status', 'rejected')->count();
        // Check if the success message exists in the session
        $successMessage = session('successMessage');

        
    
        return view('admin.dashboard', compact('overallUsersCount', 'usersByJobrole', 'overallTasksCount', 'successMessage', 'rejectedTasksCount'));
    }

    public function user(){
        return view('admin.user');
    }
}
