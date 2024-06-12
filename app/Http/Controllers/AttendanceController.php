<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){

        $attendances = Attendance::latest()->get();
        return view('admin/attendance', compact('attendances'));
    }

    public function destroyattendance($id){

        $attendance = Attendance::findOrFail($id);
        $attendance ->delete();
    
        return redirect()->route('admin-attendance')->with('delete', 'Attendance Details Deleted');
    
       }
       public function deleteMultipleRows(Request $request)
       {
           $ids = $request->input('ids');
           Attendance::whereIn('id', explode(",",$ids))->delete();
           return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
       }
     

    public function index2(Request $request)
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

        $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->latest()->get();
    
        // Get distinct staffs for table rows
        $staffs = $attendances->map(function ($attendance) {
            return $attendance->user_id;

        })->unique();
      
        // Pass the attendance data and other variables to the Blade view
        return view('admin.attendance2', compact('dates', 'staffs', 'staff', 'attendanceData', 'selectedMonth', 'selectedYear'));
    }
    
    
    
    

    public function clockIn(Request $request)
    {
        $now = Carbon::now('Asia/Manila');
        $attendance = Attendance::create([
            'user_id' => auth()->user()->id,
            'date' => $now->toDateString(),
            'clock_in' => $now->toTimeString(),
        ]);

        $workSchedule = auth()->user()->workSchedules->first();

        if($workSchedule){
            $startTime = $workSchedule->start_time;

            if($now->gt($startTime)){
                $attendance->update(['status' => 'late']);
            }else{
                $attendance->update(['status' => 'on-time']);
            }
        }

        // Assuming you want to return a JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json(['message' => 'Clocked in successfully'], 200);
        }

        return redirect()->back()->with('success', 'Clocked in successfully.');
    }

    public function clockOut(Request $request)
{
    $now = Carbon::now('Asia/Manila');
    $attendance = auth()->user()->attendances()->where('date', Carbon::today())->first();
    
    if ($attendance) {
        $startTime = Carbon::parse($attendance->clock_in);
        $duration = $startTime->diff($now)->format('%H:%I:%S');

        $attendance->update([
            'clock_out' => $now->toTimeString(),
            'duration' => $duration, // Update the duration column
        ]);


    // Assuming you want to return a JSON response for AJAX requests
    if ($request->ajax()) {
        return response()->json(['error' => 'No attendance record found for today'], 404);
    }

        return redirect()->back()->with('error', 'No attendance record found for today.');
    }
}

    
    
    
    // User SIDE!

    public function clockrecord(){
        $attendances = auth()->user()->attendances()->latest()->get();

        return view('attendance', compact('attendances'));    
    }

    public function destroyrecord($id){
        $attendances = Attendance::findOrFail($id);
        $attendances->delete();

        return redirect()->route('index.clock')->with('delete', 'Attendance Details Deleted');

    }





}
