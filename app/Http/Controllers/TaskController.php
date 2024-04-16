<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Staff;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $orderBy = $request->input('order_by', 'default'); // Default order is ascending
        $searchQuery = $request->input('search');
        

      

        $tasks = Task::with('taskStatus')->get();
        // Perform the search query
      // Perform the search query
    $query = Task::query();

    if ($searchQuery) {
        $query->where(function ($q) use ($searchQuery) {
            $q->where('fname', 'like', "%{$searchQuery}%")
                ->orWhere('lname', 'like', "%{$searchQuery}%");
        });
    }

    // Check if the orderBy value is default and apply the default order
    if ($orderBy === 'default') {
        $tasks = $query->latest()->paginate(10)->withQueryString();
    } else {
        $tasks = $query->orderBy('title', $orderBy)->paginate(10)->withQueryString();
    }
    
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
       $staffWithRoles = User::where('usertype', '!=', 'admin')->get();

   
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
       return view('admin.add-task', compact('kapitans','staffWithRoles', 'secretaries' ,'treasurers',
        'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));
   }

   public function store(Request $request)
{
   // Validate form data
$validatedData = $request->validate([
    'staffs' => 'array',
    'jobrole' => 'string|required',
    'title' => 'required',
    'description' => 'required',
    'deadline' => 'required|date',
]);

// Concatenate selected staffs into a comma-separated string

// Create a new task
Task::create([
    'assigned_to' =>implode(',', $validatedData['staffs']),
    'title' => $validatedData['title'],
    'jobrole' => $validatedData['jobrole'],
    'description' => $validatedData['description'],
    'deadline' => $validatedData['deadline'],
 
   
]);
    
// Assign task to selected staffs based on last name priority

$selectedStaffs = User::whereIn('lname', $validatedData['staffs'])
    ->where('usertype', '!=', 'admin')
    ->get();

foreach ($selectedStaffs as $selectedStaff) {
    Task::create([
        'user_id' => $selectedStaff->id, // Assign the user ID based on last names directly
        'status' => 'pending',
    ]);
}


// foreach ($selectedStaffs as $selectedStaff) {
//     TaskStatus::create([
//         'task_id' => $task->id,
//         'user_id' => $selectedStaff->id, // Assign the user ID based on last names directly
//         'status' => 'pending',
//     ]);
// }

return redirect()->route('admin.task')->with('success', 'Task created successfully.');
 
   
   
}
   
   


//    public function store(Request $request)
//    {
//        // Validate form data
//        $validatedData = $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//            'deadline' => 'required|date',
//            'job_roles' => 'array', // Ensure job_roles is an array
//        ]);
   
//        // Concatenate job roles into a comma-separated string
//        $jobRolesString = implode(',', $validatedData['job_roles']);
   
//        // Create a new task
//        $task = Task::create([
//            'title' => $validatedData['title'],
//            'description' => $validatedData['description'],
//            'deadline' => $validatedData['deadline'],
//            'jobrole' => $jobRolesString, // Assign the determined job roles to the task
//            'completed' => false,
//        ]);
   
//        // Assign task to staff members based on selected job roles
//        foreach ($validatedData['job_roles'] as $role) {
//            $users = User::where('jobrole', $role)->get();
   
//            foreach ($users as $user) {
//                $user->tasks()->save($task);
//            }
//        }
   
//        // Return success response
//        return redirect()->route('admin.task')->with('success', 'Task created successfully.');
//    }
   

public function edit(Task $task)
{

    
    // Assuming you have a way to retrieve staff members with their job roles
    $staffWithRoles = User::where('usertype', '!=', 'admin')->get();
   
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
    return view('admin.edit-task', compact('task', 'kapitans', 'staffWithRoles', 'secretaries', 'treasurers',
        'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));
}

public function update(Request $request, $id)
{
    // Validate form data
   $validatedData = $request->validate([
        'staffs' => 'array',
        'jobrole' => 'string|required',
        'title' => 'required',
        'description' => 'required',
        'deadline' => 'required|date',
    ]);

    // Concatenate selected staffs into a comma-separated string
    $staffsString = implode(',', $validatedData['staffs']);
    
    // Find the task to update
   
   
 // Find and update the task
 $task = Task::findOrFail($id);
 $task->assigned_to = $staffsString;
 $task->title = $validatedData['title'];
 $task->jobrole = $validatedData['jobrole'];
 $task->description = $validatedData['description'];
 $task->deadline = $validatedData['deadline'];
 $task->save();

    // Assign task to selected staffs based on last name priority
    $selectedStaffs = User::whereIn('lname', $validatedData['staffs'])
        ->where('usertype', '!=', 'admin')
        ->get();

        foreach ($selectedStaffs as $selectedStaff) {
            Task::create([
            
                'user_id' => $selectedStaff->id, // Assign the user ID based on last names directly
                'status' => 'pending',
            ]);
        }

    return redirect()->route('admin.task')->with('success', 'Task updated successfully.');
}


public function destroy(Task $task)
{
    // Detach the task from all associated staff members
    $task->user()->detach();

    // Delete the task
    $task->delete();

    // Return success response
    return redirect()->route('admin.task')->with('delete', 'Task deleted successfully.');
}



public function userTask()
{
    // Get the authenticated user
    $user = auth()->user();

    // Retrieve tasks assigned to the user's task statuses
    $tasks = $user->tasks()
        
         // Exclude completed tasks
        ->get(); // Extract the task from the task status collection

    return view('task', compact('user', 'tasks'));
}

  public function accept($id)
  {
     
    $task = Task::findOrFail($id);

    // Check if the task status is 'pending' for the current user
    $taskStatus = Task::where('id', $task->id)
        ->where('assigned_to', auth()->user()->id) // Assuming you are using authentication
        ->where('status', 'pending')
        ->firstOrFail();

    // Update the task status to 'accepted'
    $taskStatus->status = 'in_progress';
    $taskStatus->save();

    return redirect()->back()->with('success', 'Task accepted successfully.');
  }


  //   public function accept($id)
//   {
//       $task = Task::findOrFail($id);
//       // Update the task status to 'accepted'
//       $task->status = 'accepted';
//       $task->save();

//       return redirect()->back()->with('success', 'Task accepted successfully.');
//   }

public function reject(Request $request)
{
    $validatedData = $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'reason' => 'required|string|max:255',
    ]);

    $taskStatus = TaskStatus::where('task_id', $validatedData['task_id'])
        ->where('user_id', auth()->user()->id) // Assuming you are using user authentication
        ->firstOrFail();

    $taskStatus->status = 'rejected';
    $taskStatus->rejection_reason = $validatedData['reason'];
    $taskStatus->save();

    return redirect()->back()->with('success', 'Task rejected successfully.');
}

//   public function reject(Request $request)
//   {
//       $validatedData = $request->validate([
//           'task_id' => 'required|exists:tasks,id',
//           'reason' => 'required|string|max:255',
//       ]);

//       $task = Task::findOrFail($validatedData['task_id']);
//       // Update the task status to 'rejected' and save the rejection reason
//       $task->status = 'rejected';
//       $task->rejection_reason = $validatedData['reason'];
//       $task->save();

//       return redirect()->back()->with('success', 'Task rejected successfully.');
//   }

public function complete($id)
{
    $task = Task::findOrFail($id);

    // Find the latest status for the task
    $latestStatus = Task::where('id', $task->id)->latest()->first();

    if ($latestStatus) {
        // Update the latest status to 'completed'
        $latestStatus->status = 'completed';
        $latestStatus->save();

        return redirect()->back()->with('success', 'Task Completed Successfully!');

    
}

}

}