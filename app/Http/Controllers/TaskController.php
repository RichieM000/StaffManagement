<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $orderBy = $request->input('order_by', 'asc'); // Default order is ascending
        $searchQuery = $request->input('search');
    
        // Perform the search query
        $tasks = Task::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('title', 'like', "%{$searchQuery}%")
                    ->orWhere('jobrole', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%");
            })
            ->orderBy('title', $orderBy)
            ->paginate(8)
            ->withQueryString();
    
        if ($searchQuery && $tasks->isEmpty()) {
            $noItemsMessage = 'No items found!!';
        } else {
            $noItemsMessage = null;
        }

        return view('admin.task', compact('tasks', 'orderBy', 'noItemsMessage', 'searchQuery' ));
    }



    public function pendingTasks()
{
    $tasks = Task::where('status', 'pending')->latest()->get();

    return view('admin.tasks.pending', compact('tasks'));
}


    //    public function index(){

  


//     $tasks = Task::with('assignedTo.jobRoles')->paginate(8);
//     return view('admin.task', compact('tasks'));
//    }

   public function create()
   {
     
       // Assuming you have a way to retrieve staff members with their job roles
       $staffWithRoles = User::all();
   
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
           $users = User::where('jobrole', $role)->get();
   
           foreach ($users as $user) {
               $user->tasks()->save($task);
           }
       }
   
       // Return success response
       return redirect()->route('admin.task')->with('success', 'Task created successfully.');
   }
   

public function edit(Task $task)
{

    
    // Assuming you have a way to retrieve staff members with their job roles
    $staffWithRoles = User::all();
   
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

    // Pass the filtered staff members and the task to the view
    return view('admin.edit-task', compact('task', 'kapitans', 'secretaries', 'treasurers',
        'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));
}

public function update(Request $request, Task $task)
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

    // Update the task
    $task->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'deadline' => $validatedData['deadline'],
        'jobrole' => $jobRolesString, // Assign the determined job roles to the task
    ]);

    // Return success response
    return redirect()->route('admin.task')->with('success', 'Task updated successfully.');
}

public function destroy(Task $task)
{
    // Detach the task from all associated staff members
    $task->users()->detach();

    // Delete the task
    $task->delete();

    // Return success response
    return redirect()->route('admin.task')->with('delete', 'Task deleted successfully.');
}



public function userTask(){

    // Get the authenticated user
    $user = auth()->user();

    // Get all job roles assigned to the user
    $jobRoles = explode(',', $user->jobrole);

    // Retrieve tasks assigned to any of the user's job roles and also assigned to the user
    $tasks = Task::where(function ($query) use ($jobRoles, $user) {
        foreach ($jobRoles as $jobRole) {
            $query->orWhere('jobrole', 'like', '%' . $jobRole . '%');
        }
        $query->orWhere('assigned_to', $user->id);
    })->latest()->get();
    
  return view('task', compact('user', 'tasks'));
  }

  public function accept($id)
  {
      $task = Task::findOrFail($id);
      // Update the task status to 'accepted'
      $task->status = 'accepted';
      $task->save();

      return redirect()->back()->with('success', 'Task accepted successfully.');
  }

  public function reject(Request $request)
  {
      $validatedData = $request->validate([
          'task_id' => 'required|exists:tasks,id',
          'reason' => 'required|string|max:255',
      ]);

      $task = Task::findOrFail($validatedData['task_id']);
      // Update the task status to 'rejected' and save the rejection reason
      $task->status = 'rejected';
      $task->rejection_reason = $validatedData['reason'];
      $task->save();

      return redirect()->back()->with('success', 'Task rejected successfully.');
  }

  public function complete($id)
  {
      $task = Task::findOrFail($id);
      // Update the task status to 'completed'
      $task->status = 'completed';
      $task->save();

      return redirect()->route('user.task')->with('success', 'Task Complete!');
  }










}


