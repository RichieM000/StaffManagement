{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('System Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-systemsidebar /> <!-- Include the sidebar component -->

        <div class="flex-1 p-4">

            
            
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div id="successMessage" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        
                        <div class="p-6 text-gray-900 font-bold text-xl dark:text-gray-100">
                            Welcome <span class="text-button capitalize">{{ Auth::user()->fname }}</span> 
                        </div>
                    </div>
                </div>



                {{-- <div class="bg-white overflow-hidden max-w-7xl shadow-sm sm:rounded-lg mx-auto p-4">
                    <!-- Display Admin Login History -->
                    <h2 class="text-lg font-semibold mb-4">Admin Log History</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border border-gray-300">User</th>
                                <th class="py-2 px-4 border border-gray-300">Login Time</th>
                                <th class="py-2 px-4 border border-gray-300">Logout Time</th>
                                <th class="py-2 px-4 border border-gray-300">Date</th>
                                <!-- Other relevant columns -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminLoginHistory as $history)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border border-gray-300">{{ $history->user->fname }}</td>
                                <td class="py-2 px-4 border border-gray-300">{{ \Carbon\Carbon::parse($history->login_time)->format('h:i A') }}</td>
                                <td class="py-2 px-4 border border-gray-300">@if($history->logout_time)
                                    {{ \Carbon\Carbon::parse($history->logout_time)->format('h:i A') }}
                                @endif</td>
                                <?php
                                                           
                    
                                                            // Assuming $attendance->date is already a valid date string or Carbon instance
                                                            $attendanceDate = \Carbon\Carbon::parse($history->date);
                    
                                                            // Format the date as "Month-Day-Year"
                                                            $formattedDate = $attendanceDate->format('M d, Y');
                    
                                                            // Now you can use $formattedDate in your view:
                                                            echo '<td class="px-4 py-2 whitespace-nowrap">' . $formattedDate . '</td>';
                                                            ?>
                                <!-- Other relevant data -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Display User Login History -->
                    <h2 class="text-lg font-semibold mt-8 mb-4">Staff Log History</h2>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border border-gray-300">User</th>
                                <th class="py-2 px-4 border border-gray-300">Login Time</th>
                                <th class="py-2 px-4 border border-gray-300">Logout Time</th>
                                <th class="py-2 px-4 border border-gray-300">Date</th>
                                <!-- Other relevant columns -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userLoginHistory as $history)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border border-gray-300">{{ $history->user->fname }}</td>
                                <td class="py-2 px-4 border border-gray-300">{{ \Carbon\Carbon::parse($history->login_time)->format('h:i A') }}</td>
                                <td class="py-2 px-4 border border-gray-300">@if($history->logout_time)
                                    {{ \Carbon\Carbon::parse($history->logout_time)->format('h:i A') }}
                                @endif</td>
                                <?php
                                                           
                    
                                                            // Assuming $attendance->date is already a valid date string or Carbon instance
                                                            $attendanceDate = \Carbon\Carbon::parse($history->date);
                    
                                                            // Format the date as "Month-Day-Year"
                                                            $formattedDate = $attendanceDate->format('M d, Y');
                    
                                                            // Now you can use $formattedDate in your view:
                                                            echo '<td class="px-4 py-2 whitespace-nowrap">' . $formattedDate . '</td>';
                                                            ?>
                                <!-- Other relevant data -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                </div> --}}
    

        
       



     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-2 mt-12">

        <!-- Users By Jobrole -->
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
    <div class="flex items-center">
        <div class="h-12 w-12 bg-blue-500 text-white rounded-full flex items-center justify-center">
            <i class="ri-user-line text-2xl"></i>
        </div>
        <div class="ml-4">
            <div class="text-lg font-medium text-gray-900">Overall Users</div>
            <div class="text-3xl font-semibold text-gray-800">{{ $overallUsersCount }}</div>
        </div>
    </div>
    <div class="text-lg font-medium text-gray-900 mb-2">Job Positions</div>
    <div class="grid grid-cols-2 gap-4">
        @foreach($usersByJobrole as $jobrole)
            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-blue-900">{{ $jobrole->jobrole }}</div>
                <div class="text-3xl font-semibold text-blue-800">{{ $jobrole->count }}</div>
            </div>
        @endforeach
    </div>
</div>


        
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
                <div class="text-lg font-semibold mb-2">Attendance & Time Tracking</div>
                <div class="mb-4">
                    <div class="text-gray-600 mb-2">Current Date:</div>
                    <div id="currentDate"></div>
                </div>
                <div class="mb-4">
                    <div class="text-gray-600 mb-2">Current Time:</div>
                    <div id="currentTime"></div>
                </div>
                <div class="flex justify-between">
                    <form id="attendanceForm" action="{{route('clock.in')}}" method="POST">
                        @csrf
                        <input type="hidden" name="attendance_time" id="attendanceTime">
                        <input type="hidden" name="attendance_date" id="attendanceDate">
                        <button type="submit"  class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none">
                            Time In
                        </button>
                    </form>
                    <form id="attendanceForm" action="{{route('clock.out')}}" method="POST">
                        @csrf
                        <input type="hidden" name="attendance_time" id="attendanceTime">
                        <input type="hidden" name="attendance_date" id="attendanceDate">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none">
                            Time Out
                        </button>
                    </form>
                </div>
            </div>
         --}}
        
           
   

    <!-- Overall Tasks -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
        <div class="text-lg font-medium text-gray-900 mb-2">Task Statistics</div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-blue-900">Overall Tasks</div>
                <div class="text-3xl font-semibold text-blue-800">{{ $overallTasksCount }}</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-gray-900">Pending Tasks</div>
                <div class="text-3xl font-semibold text-gray-800">{{ $pendingTasksCount }}</div>
            </div>
            <div class="bg-red-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-red-900">Rejected Tasks</div>
                <div class="text-3xl font-semibold text-red-800">{{ $rejectedTasksCount }}</div>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-blue-500">Accepted Tasks</div>
                <div class="text-3xl font-semibold text-blue-400">{{ $acceptedTasksCount }}</div>
            </div>
            <div class="bg-green-50 col-span-2 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-green-500">Completed Tasks</div>
                <div class="text-3xl font-semibold text-green-400">{{ $completedTasksCount }}</div>
            </div>
            <!-- Add more task statistics as needed -->
        </div>
    </div>



              

 

 <!-- Leave Statistics -->
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
    <div class="text-lg font-medium text-gray-900 mb-2">Leave Statistics</div>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-blue-50 p-4 rounded-lg shadow-md">
            <div class="text-xl font-semibold text-blue-900">Overall Leave Requests</div>
            <div class="text-3xl font-semibold text-blue-800">{{ $overallLeaveCount }}</div>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
            <div class="text-xl font-semibold text-gray-900">Pending Leave</div>
            <div class="text-3xl font-semibold text-gray-800">{{  $pendingLeave }}</div>
        </div>
        <div class="bg-red-50 p-4 rounded-lg shadow-md">
            <div class="text-xl font-semibold text-red-900">Rejected Leave</div>
            <div class="text-3xl font-semibold text-red-800">{{  $rejectedLeave }}</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg shadow-md">
            <div class="text-xl font-semibold text-green-900">Approved Leave</div>
            <div class="text-3xl font-semibold text-green-800">{{  $approveLeave }}</div>
        </div>
        <!-- Add more task statistics as needed -->
    </div>
</div>

</div>





        </div>
    </div>
</x-app-layout>
