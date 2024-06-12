<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function userLeave(){


        $user = auth()->user();

        
        
        $leaveRequests = LeaveRequest::with('user:id,jobrole,fname')->get();
        $pendingRequests = LeaveRequest::where('status', 'pending')->get();
        $approvedRequests = LeaveRequest::where('status', 'approved')->get();
        $rejectedRequests = LeaveRequest::where('status', 'rejected')->get();

        return view('leave', compact('user','leaveRequests', 'pendingRequests', 'approvedRequests', 'rejectedRequests' ));
    }

    public function store(Request $request){
        try{
        $validatedData = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required',
        ]);
    
        // Assuming you have authenticated users, get the logged-in user
        $user = Auth::user();
    
        $leaveRequests = LeaveRequest::create([
            'user_id' => $user->id,
            'leave_type' => $validatedData['leave_type'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'reason' => $validatedData['reason'],
            'status' => 'pending', // Default status is pending
        ]);
    
        return redirect()->route('user.leave', compact('leaveRequests'))->with('success', 'Leave Submitted Successfully');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while creating the Leave Request.');
    } 

    }

    public function edit(LeaveRequest $leaveRequest)
{
    $user = auth()->user();
    // Assuming you want to retrieve only the leave request associated with the current user
    $leaveRequests = $user->leaveRequest()->get(); // Assuming there's a relationship between User and LeaveRequest models

    return view('edit-leave', compact('user', 'leaveRequest', 'leaveRequests'));
}

public function update(Request $request, LeaveRequest $leaveRequest)
{
    try {
        $validatedData = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required',
        ]);

        $leaveRequest->update([
            'leave_type' => $validatedData['leave_type'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'reason' => $validatedData['reason'],
        ]);

        return redirect()->route('user.leave', compact('leaveRequest'))->with('success', 'Leave Updated Successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the Leave Request.');
    }
}
public function delete($leaveRequest)
{
    
    $leaveRequest = LeaveRequest::findOrFail($leaveRequest);
    $leaveRequest ->delete();

    // Return success response
    return redirect()->route('user.leave')->with('delete', 'Task deleted successfully.');
}

    public function adminIndex(Request $request){

        $admin = auth()->user()->usertype === 'admin';

      

        $orderBy = $request->input('order_by', 'default'); // Default order is ascending

      
    
      

    // Perform the search query
    $leaveRequests = LeaveRequest::with('user')->get();
   
       
        // $leaveRequests = LeaveRequest::with('user:id,jobrole,fname')->get();
        $pendingRequests = LeaveRequest::where('status', 'pending')->get();
        $approvedRequests = LeaveRequest::where('status', 'approved')->get();
        $rejectedRequests = LeaveRequest::where('status', 'rejected')->get();

        return view('admin.leave', compact('admin', 'leaveRequests', 'pendingRequests','approvedRequests','rejectedRequests'));
    }

    public function approveLeaveRequest(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
    
        // Update the status based on admin action (approve or reject)
        $leaveRequest->status = $request->input('approved');
        $leaveRequest->status = 'approved'; 
        $leaveRequest->save();
        
        
        return redirect()->back()->with('success', 'Leave Approved');
    }


    public function rejectLeaveRequest(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
    
        // Update the status based on admin action (approve or reject)
        $leaveRequest->status = $request->input('rejected');
        $leaveRequest->status = 'rejected'; 
        $leaveRequest->save();
    
        return redirect()->route('admin-leave', compact('leaveRequest'))->with('success', 'Leave Rejected');
    }


    public function deleteMultipleRowsleave(Request $request)
    {
        $ids = $request->input('ids');
        LeaveRequest::whereIn('id', explode(",",$ids))->delete();
        return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
    }

    public function destroy($id){

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest ->delete();

        return redirect()->route('admin-leave')->with('delete', 'Leave deleted successfully.');
    }
    

}






