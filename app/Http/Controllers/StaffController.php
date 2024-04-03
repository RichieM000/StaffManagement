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
    $orderBy = $request->input('order_by', 'asc'); // Default order is ascending
    $searchQuery = $request->input('search');

    // Perform the search query
    $staff = Staff::query()
        ->when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('firstname', 'like', "%{$searchQuery}%")
                ->orWhere('lastname', 'like', "%{$searchQuery}%");
        })
        ->orderBy('firstname', $orderBy)
        ->paginate(10)
        ->withQueryString();

    if ($searchQuery && $staff->isEmpty()) {
        $noItemsMessage = 'No items found!!';
    } else {
        $noItemsMessage = null;
    }

    return view('admin.staff', compact('staff', 'orderBy', 'noItemsMessage', 'searchQuery'));
}







    public function create(){
        return view('admin.add-staff');
    }



    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:11|min:11',
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8', // Add validation for end_time (adjust as needed)
        ]);
    
        $staff = Staff::create($request->all());
    
        // Create work schedule entry for the newly created staff member
        WorkSchedule::create([
            'staff_id' => $staff->id,
            'day_of_week' => $request->day_of_week, // Use input value for day_of_week
            'start_time' => $request->start_time, // Use input value for start_time
            'end_time' => $request->end_time, // Use input value for end_time
        ]);
    
        return redirect()->route('admin.staff')->with('success', 'Staff member and work schedule created successfully.');
    }



    public function edit($id)
{
    $staff = Staff::with('workSchedules')->findOrFail($id);
    return view('admin.edit-staff', compact('staff'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'age' => 'required|string|max:3',
        'gender' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'jobrole' => 'required|string|max:255',
        'email' => 'required|email|unique:staff,email,' . $id,
        'phone' => 'nullable|string|max:11|min:11',
        'day_of_week' => 'required|string|max:255',
        'start_time' => 'required|string|max:8',
        'end_time' => 'required|string|max:8',
    ]);

    $staff = Staff::findOrFail($id);
    $staff->fill($request->all());
    $staff->save();

    // Update work schedule entry if needed
    WorkSchedule::where('staff_id', $id)->update(['day_of_week' => $request->day_of_week, 'start_time' => $request->start_time, 'end_time' => $request->end_time]);

    return redirect()->route('admin.staff')->with('success', 'Staff member updated successfully.');
}
public function destroy($id)
{
    $staff = Staff::findOrFail($id);
    $staff->delete();

    // Delete associated work schedule entry if needed
    WorkSchedule::where('staff_id', $id)->delete();

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
