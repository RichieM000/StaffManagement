<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Staff;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index(){

    $tasks = Task::with('assignedTo.jobRoles')->get();
    return view('admin.task', compact('tasks'));
   }

   public function create()
   {
       // Assuming you have a way to retrieve staff members with their job roles
       $staffWithRoles = Staff::all();
   
       // Filter staff members based on job roles (e.g., 'Kapitan', 'Secretary', etc.)
       $kapitans = $staffWithRoles->where('jobrole', 'Chairman');
       $secretaries = $staffWithRoles->where('jobrole', 'Secretary');
       $treasurers = $staffWithRoles->where('jobrole', 'Treasurer');
       $kagawads = $staffWithRoles->where('jobrole', 'Kagawad');
       $tanods = $staffWithRoles->where('jobrole', 'Tanod');
       $skchairmans = $staffWithRoles->where('jobrole', 'SK Chairman');
       $sk = $staffWithRoles->where('jobrole', 'SK');
       $bhw = $staffWithRoles->where('jobrole', 'BHW');
       
       // Add more job roles as needed
   
       // Pass the filtered staff members to the view
       return view('admin.add-task', compact('kapitans', 'secretaries' ,'treasurers',
        'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));
   }

   public function store(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'deadline' => 'required|date',
        'job_roles' => 'array', // Ensure job_roles is an array
    ]);

    // Concatenate job roles into a comma-separated string
    $jobRolesString = implode(',', $validatedData['job_roles']);

    // Create a new task
    $task = Task::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'deadline' => $validatedData['deadline'],
        'jobrole' => $jobRolesString, // Assign the determined job roles to the task
        'completed' => false,
    ]);

    // Assign task to staff members based on selected job roles
    foreach ($validatedData['job_roles'] as $role) {
        $staff = Staff::where('jobrole', $role)->first();
        if ($staff) {
            $staff->tasks()->attach($task->id);
        }
    }

    // Return success response
    return redirect()->route('admin.task')->with('success', 'Task created successfully.');
}


}


