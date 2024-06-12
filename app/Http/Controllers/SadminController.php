<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Rules\Password;
use App\Models\Task;
use App\Models\User;
use App\Models\Admin;
use Illuminate\View\View;
use App\Models\Attendance;
use App\Models\Evaluation;
use App\Models\TaskStatus;
use App\Models\LeaveRequest;
use App\Models\LoginHistory;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class SadminController extends Controller
{
    public function mainindex(){

         // Count overall users excluding users with 'admin' usertype
         $overallUsersCount = User::all()->count();
         $adminsCount = User::where('usertype', 'admin')->count();
    
         // Count users in each jobrole excluding 'admin'
         $usersByJobrole = User::where('usertype', '!=', 'admin')
         ->selectRaw('jobrole as jobrole') // Use selectRaw to alias the column as 'jobrole'
         ->selectRaw('count(*) as count')
         ->groupBy('jobrole')
         ->get();
     
         // Count overall tasks
         $overallTasksCount = Task::count();

         $performancecount = Evaluation::count();
     
          // Count tasks status
          $pendingTasksCount = Task::where('status', 'pending')->count();
          $acceptedTasksCount = Task::where('status', 'accepted')->count();
          $completedTasksCount = Task::where('status', 'completed')->count();
          $rejectedTasksCount = Task::where('status', 'rejected')->count();
          $deadline = Task::where('status', 'exceeded deadline')->count();
         // Check if the success message exists in the session
         $successMessage = session('successMessage');
         
         //count leave requests 
         $overallLeaveCount = LeaveRequest::count();
         $pendingLeave = LeaveRequest::where('status', 'pending')->count();
         $rejectedLeave = LeaveRequest::where('status', 'rejected')->count();
         $approveLeave = LeaveRequest::where('status', 'approved')->count();
        
        //  
        $timeins = Attendance::whereNotNull('clock_in')->count();
        $timeouts = Attendance::whereNotNull('clock_out')->count();
        $ontime = Attendance::where('status', 'late')->count();
        $late = Attendance::where('status', 'on-time')->count();
         
    

       

    return view('sadmin/dashboard', compact('overallUsersCount', 'ontime', 'late', 'timeins', 'timeouts', 'performancecount', 'deadline', 'adminsCount', 'pendingTasksCount',
     'acceptedTasksCount', 'completedTasksCount', 'approveLeave', 'pendingLeave', 'rejectedLeave',
      'overallLeaveCount', 'usersByJobrole', 'overallTasksCount', 'successMessage', 'rejectedTasksCount'));
    }

    public function showlogs(){

         // Fetch login history for admins and users
    $adminLoginHistory = LoginHistory::with('admin')->whereHas('admin', function ($query) {
        $query->where('usertype', 'admin');
    })->latest()->paginate(10);

    $userLoginHistory = LoginHistory::with('user')->whereHas('user', function ($query) {
        $query->where('usertype', 'user');
    })->latest()->paginate(10);

    return view('sadmin/log', compact('adminLoginHistory', 'userLoginHistory'));

    }

    public function clear(){
        // Clear all logs
        LoginHistory::query()->truncate();


        // Return a JSON response
        return response()->json(['success' => true]);
    }

    public function showstaffs(Request $request){
        $orderBy = $request->input('order_by', 'default'); // Default order is ascending
        $searchQuery = $request->input('search');
    
        // Perform the search query
        $query = User::query()->whereNotIn('usertype', ['systemadmin', 'admin']);
    
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('fname', 'like', "%{$searchQuery}%")
                    ->orWhere('lname', 'like', "%{$searchQuery}%")
                    ->orWhere('email', 'like', "%{$searchQuery}%")
                    ->orWhere('jobrole', 'like', "%{$searchQuery}%")
                    ->orWhere('address', 'like', "%{$searchQuery}%");
            });
        }
    
        // Check if the orderBy value is default and apply the default order
        if ($orderBy === 'default') {
            $user = $query->latest()->paginate(10)->withQueryString();
        } else {
            $user = $query->orderBy('fname', $orderBy)->paginate(10)->withQueryString();
        }
    
        if ($searchQuery && $user->isEmpty()) {
            $noItemsMessage = 'No items found!!';
        } else {
            $noItemsMessage = null;
        }
        return view('sadmin/staff', compact('user', 'orderBy', 'noItemsMessage', 'searchQuery'));
    }

   public function showusers(Request $request)
   {
       $orderBy = $request->input('order_by', 'default'); // Default order is ascending
       $searchQuery = $request->input('search');
   
       // Perform the search query
       $query = User::query()->whereNotIn('usertype', ['systemadmin', 'admin']);
   
       if ($searchQuery) {
           $query->where(function ($q) use ($searchQuery) {
               $q->where('fname', 'like', "%{$searchQuery}%")
                   ->orWhere('lname', 'like', "%{$searchQuery}%")
                   ->orWhere('email', 'like', "%{$searchQuery}%")
                   ->orWhere('jobrole', 'like', "%{$searchQuery}%")
                   ->orWhere('address', 'like', "%{$searchQuery}%");
           });
       }
   
       // Check if the orderBy value is default and apply the default order
       if ($orderBy === 'default') {
           $user = $query->latest()->paginate(10)->withQueryString();
       } else {
           $user = $query->orderBy('fname', $orderBy)->paginate(10)->withQueryString();
       }
   
       if ($searchQuery && $user->isEmpty()) {
           $noItemsMessage = 'No items found!!';
       } else {
           $noItemsMessage = null;
       }
   
   
   
       return view('sadmin/users', compact('user', 'orderBy', 'noItemsMessage', 'searchQuery'));
   }


   public function createusers()
   {
       
       return view('sadmin/create-users');
   }


   public function storeusers(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            'committee_roles' => 'array',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => 'nullable|string|max:11|min:11',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        
   // check if the selected job role is kagawad
   if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
    $user->kagawad_committee_on = implode(',', $request->committee_roles);
    
    $user->save();
}

if($user->kagawad_committee_on === null){

    $user->kagawad_committee_on = "None";

    $user->save();
}



        WorkSchedule::create([
            'user_id' => $user->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

     


        return redirect()->route('sadmin_showusers')->with('success', 'User Created Successfully');
    }



    public function createadmin()
    {
        $admins = Admin::all();
        
        return view('sadmin/create-admin', compact('admins'));
    }

    public function storeadmin(Request $request): RedirectResponse
{
    try{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'usertype' => 'required|string|in:admin',
    ]);

    $userData = [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'usertype' => $validatedData['usertype'],
    ];
    
   Admin::create($userData);


    // Redirect with success message
    return redirect()->route('sadmin_showusers')->with('success', 'Admin Created Successfully');
}catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating the staff member and work schedule.');
    }
}

public function updateadmin(Request $request, $id)
{
    $updateadmin = Admin::findOrFail($id); // Assuming you want to update an Admin model, not Evaluation

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:admins,email,' . $updateadmin->id,
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        'usertype' => 'required|string|in:admin',
    ]);

    $updateadmin->name = $request->input('name');
    $updateadmin->email = $request->input('email');

    if ($request->filled('password')) {
        $updateadmin->password = bcrypt($request->input('password'));
    }

    if ($updateadmin->save()) {
        return redirect()->route('sadmin_createadmin')->with('success', 'Admin Updated Successfully');
    } else {
        return response()->json(['message' => 'Failed to update admin!'], 422);
    }
}


public function edituser($id)
{
    $user = User::with('workSchedules')->findOrFail($id);
    
    return view('sadmin.edit-users', compact('user'));
}


public function updateuser(Request $request, User $user): RedirectResponse
{
    try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            'committee_roles' => 'array',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id], // Assuming the User model is named 'User'
            'phone' => 'nullable|string|max:11|min:11',
            'password' => ['nullable','confirmed', Rules\Password::defaults()], // Allow password update if provided
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8',
        ]);

        // Update user data from the request
        $userData = $request->only(['fname', 'lname', 'age', 'gender', 'address', 'jobrole', 'committee_roles', 'email', 'phone']);
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Check if the selected job role is 'Kagawad' and process committee roles
        if ($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')) {
            $user->kagawad_committee_on = implode(',', $request->committee_roles);
        }

        // Set default value if kagawad_committee_on is still null
        if ($user->kagawad_committee_on === null) {
            $user->kagawad_committee_on = 'None';
        }

        // Update the user with the validated data
        $user->update($userData);

        // Update or create the work schedule
        WorkSchedule::updateOrCreate(
            ['user_id' => $user->id],
            ['day_of_week' => $request->day_of_week, 'start_time' => $request->start_time, 'end_time' => $request->end_time]
        );

        // Redirect to a success page or wherever you need
        return redirect()->route('sadmin_showusers')->with('success', 'User updated successfully!');
    } catch (\Exception $e) {
        // Handle any exceptions (e.g., validation errors, database errors)
        return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
    }
}

public function deleteMultipleRowsstaff(Request $request)
    {
        $ids = $request->input('ids');
        User::whereIn('id', explode(",",$ids))->delete();
        return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
    }



public function destroyuser(User $user)
{
   
    $user->delete();

    // Delete associated work schedule entry if needed
    // WorkSchedule::where('user_id', $id)->delete();

    return redirect()->route('sadmin_showusers')->with('delete', 'Staff member deleted successfully.');
}


   public function showtasks(Request $request){

    $orderBy = $request->input('order_by', 'default'); // Default order is ascending
        $searchQuery = $request->input('search');
        

       

        $now = Carbon::now('Asia/Manila')->startOfDay(); // Get the start of today
        $tasks = Task::all(); // Retrieve all tasks
        
        foreach ($tasks as $task) {
            $deadline = Carbon::parse($task->deadline, 'Asia/Manila')->startOfDay(); // Get the start of the deadline day
            
            // Check if the deadline is in the past but not today
            if ($deadline->isPast() && !$deadline->isToday()) {
                $task->update(['status' => 'exceeded deadline']);
            }
        }




     
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
        $tasks = Task::with('assignedTo')->join('users', 'tasks.assigned_to', '=', 'users.id')->orderBy('users.fname', $orderBy)->paginate(10)->withQueryString();

    }
    
        if ($searchQuery && $tasks->isEmpty()) {
            $noItemsMessage = 'No items found!!';
        } else {
            $noItemsMessage = null;
        }

    return view('sadmin/task', compact('tasks', 'orderBy', 'noItemsMessage', 'searchQuery' ));
   }



   public function createtasks()
   {
     
       // Assuming you have a way to retrieve staff members with their job roles
       $staffWithRoles = User::whereNotIn('usertype', ['admin', 'systemadmin'])
       ->whereDoesntHave('leaveRequest', function ($query) {
           $query->where('status', 'approved');
       })
       ->get();

   
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
       return view('sadmin/create-task', compact('kapitans','staffWithRoles', 'secretaries' ,'treasurers',
        'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));
   }

   public function storetasks(Request $request)
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

return redirect()->route('sadmin_showtasks')->with('success', 'Task created successfully.');
 
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating the Task Assignment.');
    } 
   
}

public function edittasks(Task $task){

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
  
      // Pass the filtered staff members to the view
      return view('sadmin/edit-tasks', compact('task','kapitans','staffWithRoles', 'secretaries' ,'treasurers',
       'kagawads', 'tanods', 'skchairmans', 'sk', 'bhw'));

}

public function updatetasks(Request $request, $id)
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
    
        return redirect()->route('sadmin_showtasks')->with('success', 'Task updated successfully.');
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

public function destroytasks($task)
{
    // Detach the task from all associated staff members
    $task = Task::findOrFail($task);
        $task->delete();

    // Return success response
    return redirect()->route('sadmin_showtasks')->with('delete', 'Task deleted successfully.');
}

// foreach ($tasks as $task) {
//     if (Carbon::parse($task->deadline)->isPast() && $task->status != 'exceeded deadline') {
//         $task->status = 'exceeded deadline';
//         $task->save();
//     }
// }

   public function showattendance(){
    $attendances = Attendance::latest()->get();

   
    
      
    

        // if ($workSchedule) {
        //     $start_time = $workSchedule->start_time;
        //     $clock_in_time = $attendance->clock_in_time;

        //     // Assuming start_time and clock_in_time are stored as time strings
        //     // and converting them to DateTime objects for comparison
        //     $startDateTime = new DateTime($start_time);
        //     $clockInDateTime = new DateTime($clock_in_time);

        //     if ($clockInDateTime > $startDateTime) {
        //         $attendance->status = 'late';
        //     } else {
        //         $attendance->status = 'on-time';
        //     }
        // } 
    


    return view('sadmin/attendance', compact('attendances'));

   }

   public function destroyattendance($id){

    $attendance = Attendance::findOrFail($id);
    $attendance ->delete();

    return redirect()->route('sadmin_showattendance')->with('delete', 'Attendance Details Deleted');

   }

   public function deleteMultipleRows(Request $request)
   {
       $ids = $request->input('ids');
       Attendance::whereIn('id', explode(",",$ids))->delete();
       return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
   }

   public function showattendancesheet(Request $request)
   {
       // Get the selected month and year from the request
       $selectedMonth = $request->input('month', date('n')); // Default to current month if not provided
       $selectedYear = $request->input('year', date('Y')); // Default to current year if not provided
   
       // Fetch attendance data from the database for the selected month and year
       $attendances = Attendance::whereYear('date', $selectedYear)
           ->whereMonth('date', $selectedMonth)
           ->get();
   
       // Group attendance data by user ID and date
       // Initialize the $attendanceData array
   $attendanceData = [];

   // Organize attendance data into $attendanceData structure
   foreach ($attendances as $attendance) {
       $staffId = $attendance->user_id;
       $date = Carbon::parse($attendance->date)->format('Y-m-d');

       // Check if the staff ID is already in the array
       if (!isset($attendanceData[$staffId])) {
           $attendanceData[$staffId] = [];
       }

       // Add clock-in and clock-out times to the $attendanceData array
       $attendanceData[$staffId][$date] = [
           'clock_in' => $attendance->clock_in,
           'clock_out' => $attendance->clock_out,
       ];
   }
       // Get distinct dates in the selected month for table headers
       $dates = $attendances->map(function ($attendance) {
           return Carbon::parse($attendance->date)->format('Y-m-d');
       })->unique();

       $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->get();
   
       // Get distinct staffs for table rows
       $staffs = $attendances->map(function ($attendance) {
           return $attendance->user_id;

       })->unique();
     
       // Pass the attendance data and other variables to the Blade view
       return view('sadmin/attendance-sheet', compact('dates', 'staffs', 'staff', 'attendanceData', 'selectedMonth', 'selectedYear'));
   }





public function showleave(Request $request){

    $admin = auth()->user()->usertype === 'systemadmin';

    // $orderBy = $request->input('order_by', 'default');
    //  // Default order is ascending
    // $searchQuery = $request->input('search');

// Perform the search query
$leaveRequests = LeaveRequest::with('user')->get();

   
    // $leaveRequests = LeaveRequest::with('user:id,jobrole,fname')->get();
    $pendingRequests = LeaveRequest::where('status', 'pending')->get();
    $approvedRequests = LeaveRequest::where('status', 'approved')->get();
    $rejectedRequests = LeaveRequest::where('status', 'rejected')->get();

    return view('sadmin/leave', compact('admin', 'leaveRequests', 'pendingRequests','approvedRequests','rejectedRequests'));
}

public function approveleave(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
    
        // Update the status based on admin action (approve or reject)
        $leaveRequest->status = $request->input('approved');
        $leaveRequest->status = 'approved'; 
        $leaveRequest->save();
        
        
        return redirect()->back()->with('success', 'Leave Approved');
    }

    public function rejectleave(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
    
        // Update the status based on admin action (approve or reject)
        $leaveRequest->status = $request->input('rejected');
        $leaveRequest->status = 'rejected'; 
        $leaveRequest->save();
    
        return redirect()->route('sadmin_showleave', compact('leaveRequest'))->with('success', 'Leave Rejected');
    }

    public function deleteMultipleRowsleave(Request $request)
    {
        $ids = $request->input('ids');
        LeaveRequest::whereIn('id', explode(",",$ids))->delete();
        return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
    }

    public function destroyleave($id){

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest ->delete();

        return redirect()->route('sadmin_showleave')->with('delete', 'Leave deleted.');
    }

    // evaluation

    public function index(){
        $evaluations = Evaluation::with(['user', 'task'])->latest()->get();
        
        return view('sadmin/evaluation', compact('evaluations'));
    }

    public function deleteMultipleRowseval(Request $request)
    {
        $ids = $request->input('ids');
        Evaluation::whereIn('id', explode(",",$ids))->delete();
        return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
    }

    public function addevaluation(Request $request){
        $user = User::find($request->fname);

        if ($user) {
            $tasks = $user->tasks;
        } else {
            $tasks = [];
        }
       
        $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->latest()->get();
        return view('sadmin/add-evaluation', compact('tasks','staff'));
    }


    public function storeevaluation(Request $request){

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'efficiency' => 'required|in:1,2,3,4,5',
            'quality' => 'required|in:1,2,3,4,5',
            'timeliness' => 'required|in:1,2,3,4,5',
            'accuracy' => 'required|in:1,2,3,4,5',
            'tardiness' => 'required|in:1,2,3,4,5',
            'feedback' => 'nullable|string|max:255',
        ]);

        $performanceEvaluation = Evaluation::create([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'efficiency' => $request->efficiency,
            'quality' => $request->quality,
            'timeliness' => $request->timeliness,
            'accuracy' => $request->accuracy,
            'tardiness' => $request->tardiness,
            'feedback' => $request->feedback,
            'total_average' => 0,
        ]);
    
        $totalRating = $performanceEvaluation->efficiency + $performanceEvaluation->quality + $performanceEvaluation->timeliness + $performanceEvaluation->accuracy + $performanceEvaluation->tardiness;
        $totalPercentage = ($totalRating / 25) * 100;
    
        if ($totalPercentage < 0 || $totalPercentage > 100) {
            throw new \Exception('Invalid total percentage value');
        }
    
        $performanceEvaluation->update([
            'total_average' => $totalPercentage,
        ]);
    
        return redirect()->route('sadmin_evaluation')->with('success', 'Rating submitted successfully!');

    }


    public function editevaluation($evaluation){

        $evaluation = Evaluation::with('user', 'task') // eager load user and task relationships
        ->findOrFail($evaluation);
        $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->latest()->get();
        $task = Task::all();

        return view('sadmin.edit-evaluation', compact('evaluation','staff','task'));
    }

    public function updateevaluation(Request $request, $evaluation){

        $evaluation = Evaluation::findOrFail($evaluation);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'efficiency' => 'required|in:1,2,3,4,5',
            'quality' => 'required|in:1,2,3,4,5',
            'timeliness' => 'required|in:1,2,3,4,5',
            'accuracy' => 'required|in:1,2,3,4,5',
            'tardiness' => 'required|in:1,2,3,4,5',
            'feedback' => 'nullable|string|max:255',
        ]);
    
        $evaluation->user_id = $request->user_id;
        $evaluation->task_id = $request->task_id;
        $evaluation->efficiency = $request->efficiency;
        $evaluation->quality = $request->quality;
        $evaluation->timeliness = $request->timeliness;
        $evaluation->accuracy = $request->accuracy;
        $evaluation->tardiness = $request->tardiness;
        $evaluation->feedback = $request->feedback;
    
        $totalRating = $evaluation->efficiency + $evaluation->quality + $evaluation->timeliness + $evaluation->accuracy + $evaluation->tardiness;
        $totalPercentage = ($totalRating / 25) * 100;
    
        if ($totalPercentage < 0 || $totalPercentage > 100) {
            throw new \Exception('Invalid total percentage value');
        }
    
        $evaluation->total_average = $totalPercentage;
        $evaluation->save();
    
        return redirect()->route('sadmin_evaluation')->with('success', 'Evaluation updated successfully!');

    }

    

    public function getEvaluationData($id) {
        $evaluation = Evaluation::with('user', 'task')->findOrFail($id);
        return response()->json([
            'staffName' => $evaluation->user->fname . ' ' . $evaluation->user->lname,
            'staffJobrole' => $evaluation->user->jobrole,
            'taskTitle' => $evaluation->task->title,
            'feedback' => $evaluation->feedback,
            'efficiency' => $evaluation->efficiency,
            'quality' => $evaluation->quality,
            'timeliness' => $evaluation->timeliness,
            'accuracy' => $evaluation->accuracy,
            'tardiness' => $evaluation->tardiness,
            'performanceAverage' => $evaluation->total_average,
            'date' => \Carbon\Carbon::parse($evaluation->created_at)->format('F j, Y')
        ]);
    }


   


    public function destroyevaluation($evaluation){
        $evaluations = Evaluation::findOrFail($evaluation);
        $evaluations ->delete();
    
        return redirect()->route('sadmin_evaluation')->with('delete', 'Attendance Details Deleted');
    }








    public function gettask($userId)
{
    // Fetch tasks assigned to the specified user
    $alltask = Task::where('assigned_to', $userId)->get();

    // Return tasks as JSON response
    return response()->json($alltask);
}

public function create(): View
{
    return view('sadmin.register');
}

public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            'committee_roles' => 'array',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => 'nullable|string|max:11|min:11',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        
   // check if the selected job role is kagawad
   if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
    $user->kagawad_committee_on = implode(',', $request->committee_roles);
    
    $user->save();
}

if($user->kagawad_committee_on === null){

    $user->kagawad_committee_on = "None";

    $user->save();
}

// Simplified Laravel code

// // Find tasks based on user's jobrole or committee roles
// $tasks = Task::where('jobrole', $user->jobrole)
//     ->orWhereIn('jobrole', explode(',', $user->kagawad_committee_on))
//     ->get();

// // Assign tasks to the user
// foreach ($tasks as $task) {
//     // Create TaskStatus if task committee role matches user's kagawad_committee_on
//     if ($task->kagawad_committee_on === $user->kagawad_committee_on) {
//         TaskStatus::create([
//             'task_id' => $task->id,
//             'user_id' => $user->id,
//             'status' => 'pending',
//         ]);
//     }
// }

        WorkSchedule::create([
            'user_id' => $user->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

     

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('sadmin_showusers')->with('success', 'Staff Registered Successfully');
    }



}
