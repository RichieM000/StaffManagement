<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Staff;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
{
    $orderBy = $request->input('order_by', 'default'); // Default order is ascending
    $searchQuery = $request->input('search');

    // Perform the search query
    $query = User::query()->where('usertype', '!=', 'admin');

    if ($searchQuery) {
        $query->where(function ($q) use ($searchQuery) {
            $q->where('fname', 'like', "%{$searchQuery}%")
                ->orWhere('lname', 'like', "%{$searchQuery}%");
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

    return view('admin.staff', compact('user', 'orderBy', 'noItemsMessage', 'searchQuery'));
}







    public function create(){
        return view('admin.add-staff');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:11|min:11',
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8', // Add validation for end_time (adjust as needed)
        ]);
    
        $userData = $request->all();
        $userData['password'] = 'None';
        $user = User::create($userData);

        if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
            $user->kagawad_committee_on = implode(',', $request->committee_roles);
            $user->save();
        }
    
        // Create work schedule entry for the newly created staff member
        WorkSchedule::create([
            'user_id' => $user->id,
            'day_of_week' => $request->day_of_week, // Use input value for day_of_week
            'start_time' => $request->start_time, // Use input value for start_time
            'end_time' => $request->end_time, // Use input value for end_time
        ]);
    
        return redirect()->route('admin.staff')->with('success', 'Staff member and work schedule created successfully.');
    }



    public function edit($id)
{
    $user = User::with('workSchedules')->findOrFail($id);
    return view('admin.edit-staff', compact('user'));
}

// public function update(Request $request, User $user)
// {
//     $validatedData = $request->validate([
//         'fname' => 'required|string|max:255',
//         'lname' => 'required|string|max:255',
//         'age' => 'required|string|max:3',
//         'gender' => 'required|string|max:255',
//         'address' => 'required|string|max:255',
//         'jobrole' => 'required|string|max:255',
        
//         'email' => 'required|email|unique:staff,email,' . $user->id,
//         'phone' => 'nullable|string|max:11|min:11',
//         'day_of_week' => 'required|string|max:255',
//         'start_time' => 'required|string|max:8',
//         'end_time' => 'required|string|max:8',
//     ]);

//    $userData = $request->fill($request->except('password'));
//    $userData->password = '';
//    $user->update($userData);

//    if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
//     $user->kagawad_committee_on = implode(',', $request->committee_roles);
//     $user->save();
//    }

//     // Update work schedule entry if needed
//     $user->workSchedule->update([
//         'day_of_week' => $request->day_of_week,
//         'start_time' => $request->start_time,
//         'end_time' => $request->end_time,

//     ]);
//     // WorkSchedule::where('user_id', $id)->update(['day_of_week' => $request->day_of_week, 'start_time' => $request->start_time, 'end_time' => $request->end_time]);

//     return redirect()->route('admin.staff')->with('success', 'Staff member updated successfully.');
// }

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'age' => 'required|string|max:3',
        'gender' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'jobrole' => 'required|string|max:255',
        'email' => 'required|email|unique:staff,email,' . $user->id,
        'phone' => 'nullable|string|max:11|min:11',
        'day_of_week' => 'required|string|max:255',
        'start_time' => 'required|string|max:8',
        'end_time' => 'required|string|max:8',
        'committee_roles' => 'nullable|array',
    ]);

    // Fill the user data except for the password
    // $userData = $request->except(['password', '_token', '_method']);


    
    $user->update($request->except('password'));

    
    // Check if the job role is being updated to "Kagawad" and there are committee roles
    // if ($user->jobrole !== 'Kagawad' && $validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')) {
    //     $user->kagawad_committee_on = implode(',', $validatedData['committee_roles']);
    // } elseif ($user->jobrole === 'Kagawad' && $validatedData['jobrole'] !== 'Kagawad') {
    //     // Erase kagawad_committee_on if the job role is changing from "Kagawad"
    //     $user->kagawad_committee_on = null;
    // }
    
    // $user->save();
    if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
        $user->kagawad_committee_on = implode(',', $request->committee_roles);
       
    }else{
        $user->kagawad_committee_on = 'none';
        
    }

    $user->save();

    // Update work schedule entry if needed
    WorkSchedule::where('user_id', $user->id)->update(['day_of_week' => $request->day_of_week, 'start_time' => $request->start_time, 'end_time' => $request->end_time]);

    return redirect()->route('admin.staff')->with('success', 'Staff member updated successfully.');
}






public function destroy(User $user)
{
   
    $user->delete();

    // Delete associated work schedule entry if needed
    // WorkSchedule::where('user_id', $id)->delete();

    return redirect()->route('admin.staff')->with('delete', 'Staff member deleted successfully.');
}

// public function teamsAndDepartments()
// {
//     $kapitan = Staff::where('jobrole', 'kapitan')->get();
//     $vicekap = Staff::where('jobrole', 'vicekap')->get();
//     $secretary = Staff::where('jobrole', 'secretary')->get();
//     $chairman = Staff::where('jobrole', 'chairman')->get();
//     $treasurer = Staff::where('jobrole', 'treasurer')->get();
//     $kagawad = Staff::where('jobrole', 'kagawad')->get();
//     $tanod = Staff::where('jobrole', 'tanod')->get();
//     $sk = Staff::where('jobrole', 'sk')->get();

//     return view('admin.teams', compact('kapitan', 'vicekap', 'secretary', 'chairman', 'treasurer', 'tanod', 'sk'));
// }



}
