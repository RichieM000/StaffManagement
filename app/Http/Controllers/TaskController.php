<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Staff;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('assignedTo')->latest()->paginate(10);
        return view('admin.task', compact('tasks'));
    }



    public function assignTask(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ]);
    
        // Create a new task
        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deadline' => $validatedData['deadline'],
           
            'completed' => false,
        ]);
    
        // Find the staff member by ID and update assigned_task_id
        $staff = Staff::findOrFail($validatedData['staff_id']);
        $staff->assigned_task_id = $task->id;
        $staff->save();
    
        // Redirect or return response as needed
        return redirect()->back()->with('success', 'Task assigned successfully.');
    }
    

    public function editTask(Request $request, $taskId)
    {
        // Validate form data including taskId
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ]);
    
        // Update the task with the validated data
        $task = Task::findOrFail($taskId);
        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deadline' => $validatedData['deadline'],
        ]);
    
        // Redirect or return response as needed
        return redirect()->back()->with('success', 'Task updated successfully.')->withInput();
    }



    public function destroy($taskId)
{
    // Find the task by ID and delete it
    $task = Task::findOrFail($taskId);
    $task->delete();

    // Redirect or return response as needed
    return redirect()->back()->with('success', 'Task deleted successfully.');
}

// public function showTaskPage()
// {
//     // Define job roles array
//     $jobRoles = [
//         ['id' => 1, 'name' => 'Kapitan'],
//         ['id' => 2, 'name' => 'Vice Kap'],
//         ['id' => 3, 'name' => 'Secretary'],
//         // Add more job roles as needed
//     ];

//     // Pass jobRoles variable to the view
//     return view('admin.task')->with('jobRoles', $jobRoles);
// }

public function store(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'deadline' => 'required|date',
        'job_roles' => 'array', // Ensure job_roles is an array
    ]);

    // Create a new task
    $task = Task::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'deadline' => $validatedData['deadline'],
        'assigned_to' => $validatedData['staff_id'],
        'completed' => false,
    ]);

    // Assign task to staff members based on selected job roles
    if (isset($validatedData['job_roles']) && is_array($validatedData['job_roles'])) {
        foreach ($validatedData['job_roles'] as $role) {
            // Assuming jobrole field in Staff model
            $staffMembers = Staff::where('jobrole', $role)->get();
            $task->assignedTo()->attach($staffMembers);
        }
    }

    // Return success response
    return response()->json(['success' => true]);
}
    
}
