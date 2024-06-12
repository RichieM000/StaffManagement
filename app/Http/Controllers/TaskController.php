<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        


        $tasks = Task::all();
        // Perform the search query
      // Perform the search query
     
    $query = Task::query();
    
    if ($searchQuery) {
        $query->where(function ($q) use ($searchQuery) {
            $q->whereHas('assignedTo', function ($subQ) use ($searchQuery) {
                $subQ->where('fname', 'like', "%{$searchQuery}%");
                   
            })->orWhere('title', 'like', "%{$searchQuery}%");
        });
    }

    // Check if the orderBy value is default and apply the default order
    if ($orderBy === 'default') {
        $tasks = $query->latest()->paginate(8)->withQueryString();
    } else {
        $tasks = Task::with('assignedTo')->join('users', 'tasks.assigned_to', '=', 'users.id')->orderBy('users.fname', $orderBy)->paginate(8)->withQueryString();

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
       $staffWithRoles = User::whereNotIn('usertype', ['admin','systemadmin'])->get();

   
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

    try{
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
    ->whereNotIn('usertype', ['admin', 'systemadmin'])
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
 
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating the Task Assignment.');
    } 
   
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
    $staffWithRoles = User::whereNotIn('usertype', ['admin', 'systemadmin'])->get();
   
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
    try{
    // Validate form data
   $validatedData = $request->validate([
        'staffs' => 'array|required',
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
}catch (\Exception $e) {
    return redirect()->back()->with('error', 'An error occurred while updating the Task Assignment.');
} 
}

public function deleteMultipleRowstask(Request $request)
{
    $ids = $request->input('ids');
    Task::whereIn('id', explode(",",$ids))->delete();
    return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
}

public function destroy($task)
{
    // Detach the task from all associated staff members
    $task = Task::findOrFail($task);
        $task->delete();

    // Return success response
    return redirect()->route('admin.task')->with('delete', 'Task deleted successfully.');
}



public function userTask()
{
    // Get the authenticated user
    $user = auth()->user();

    // Retrieve tasks assigned to the user's task statuses
    $tasks = $user->tasks()->get(); // Extract the task from the task status collection
    
    foreach ($tasks as $task) {
        if (Carbon::parse($task->deadline)->isPast() && $task->status != 'exceeded deadline') {
            $task->status = 'exceeded deadline';
            $task->save();
        }
    }

    $userTasks = auth()->user()->tasks;

    return view('task', compact('user', 'tasks', 'userTasks'));
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
        'id' => 'required|exists:tasks,id',
        'rejected_reason' => 'required|string|max:255',
    ]);

    $taskStatus = Task::where('id', $validatedData['id'])
        ->where('assigned_to', auth()->user()->id) // Assuming you are using user authentication
        ->firstOrFail();

    $taskStatus->status = 'rejected';
    $taskStatus->rejected_reason = $validatedData['rejected_reason'];
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

public function complete(Request $request, $id)
{
    $task = Task::findOrFail($id);

    // Find the latest status for the task
    $latestStatus = Task::where('id', $task->id)->latest()->first();

    if (!$latestStatus) {
        return redirect()->back()->with('error', 'Task not found!');
    }

    // Update the latest status to 'completed'
    $latestStatus->status = 'completed';
    $latestStatus->save();

    // Handle file upload if submitted
    if ($request->hasFile('file')) {
        // Store the uploaded file
        $uploadedFile = $request->file('file');
        $filePath = $uploadedFile->store('files', 'public'); // 'local' is the disk name (configured in filesystems.php)

        // Create a new file record in the database
        $task->file_path = $filePath;
        $task->save();

        return redirect()->back()->with('success', 'Task Completed Successfully with File Upload!');
    }

    return redirect()->back()->with('success', 'Task Completed Successfully!');

    
}

}

