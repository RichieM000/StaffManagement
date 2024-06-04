<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- Main content with sidebar -->
    
  
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

       
       

        <div class="flex-1 p-4">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto py-6">
                    {{-- <h2 class="font-bold text-2xl mb-8 text-center text-gray-800 leading-tight">
                        {{ __('Admin Dashboard') }}
                    </h2> --}}
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mb-4">Time In/Time Out Monitoring</h1>
                        {{-- <a href="{{ route('admin.add-staff') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a> --}}
                    </div>
                    @if(session('success'))
                    <div id="successMessage" class="bg-green-100 transition duration-300 ease-in-out border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                
                    <script>
                        // Automatically hide the success message after 5 seconds (5000 milliseconds)
                        setTimeout(function() {
                            document.getElementById('successMessage').style.display = 'none';
                        }, 3000); // Adjust the timeout value as needed (in milliseconds)
                    </script>
                    @endif
        
                    @if(session('delete'))
                    <div id="deleteMessage" class="bg-red-100 transition duration-300 ease-in-out border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Delete Success!</strong>
                        <span class="block sm:inline">{{ session('delete') }}</span>
                    </div>
                
                    <script>
                        // Automatically hide the success message after 5 seconds (5000 milliseconds)
                        setTimeout(function() {
                            document.getElementById('deleteMessage').style.display = 'none';
                        }, 3000); // Adjust the timeout value as needed (in milliseconds)
                    </script>
                    @endif
                    <div class="flex justify-between mt-4">
                  

                    {{-- <form action="{{ route('admin.staff') }}" method="GET" class="flex items-center">
                        <label for="order_by" class="mr-2">Sort by:</label>
                        <select name="order_by" id="order_by" onchange="this.form.submit()" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-16 focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="default" {{ $orderBy == 'default' ? 'selected' : '' }}>---</option>
                            <option value="asc" {{ $orderBy == 'asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="desc" {{ $orderBy == 'desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </form> --}}
                    
                </div>
                    
                        {{-- <script>
                            function sortStaff() {
                                const orderBy = document.getElementById('order_by').value;
                                const sortForm = document.getElementById('sortForm');
                                sortForm.action = "{{ route('admin.staff') }}?order_by=" + orderBy;
                                sortForm.submit();
                            }
                        </script> --}}


        
                        @php
                        // Get the current year and month
                        $currentYear = date('Y');
                        $currentMonth = date('n');
                        $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
                        
                        // Get the number of days in the current month
                        $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                        
                        // Sample attendance data (replace with actual data retrieval from your database)
                        // $attendanceData = [
                        //     'staff1' => [
                        //         '2024-04-01' => 'present',
                        //         '2024-04-03' => 'absent',
                        //         '2024-04-05' => 'present',
                        //         // More attendance data...
                        //     ],
                        //     'staff2' => [
                        //         '2024-04-01' => 'present',
                        //         '2024-04-03' => 'present',
                        //         '2024-04-05' => 'absent',
                        //         // More attendance data...
                        //     ],
                        //     // Add more staff data as needed
                        // ];
                        // Array of months and years for the dropdown menu
                            $months = [
                                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                                7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December',
                            ];
                            $years = range(date('Y'), 2020); // Change 2020 to the earliest year you want to include
    
                            $selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;
                            $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
    
                            $selectedMonthName = $months[$selectedMonth];
                            $numDaysInSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
                        @endphp
                        <form method="GET" action="{{ route('sadmin_showattendancesheet') }}" class="mt-6">
                            <label for="month">Select Month:</label>
                            <select class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" name="month" id="month">
                                @foreach ($months as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $selectedMonth ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        
                            <label for="year">Select Year:</label>
                            <select class="px-3 py-2 pr-8 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" name="year" id="year">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        
                            <button class="ml-4 rounded-md bg-button px-3 py-1.5 text-white" type="submit">Filter</button>
                        </form>
                        
                    </div>
                        
                            {{-- <script>
                                function sortStaff() {
                                    const orderBy = document.getElementById('order_by').value;
                                    const sortForm = document.getElementById('sortForm');
                                    sortForm.action = "{{ route('admin.staff') }}?order_by=" + orderBy;
                                    sortForm.submit();
                                }
                            </script> --}}
                        
    
                           
    
            
                        <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                            <div class="overflow-x-auto">
                            
                                
                                
                                <div class="overflow-x-auto w-full p-4">
                                    <table class="responsive border-x-2" id="staffTable">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th style="text-align: left" scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Staff</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Position</th>
                                            <!-- Display dates as table headers -->
                                            @foreach ($dates as $date)
                                            <?php
                                           
    
                                            // Assuming $attendance->date is already a valid date string or Carbon instance
                                            $attendanceDate = \Carbon\Carbon::parse($date);
    
                                            // Format the date as "Month-Day-Year"
                                            $formattedDate = $attendanceDate->format('M d Y');
    
                                            // Now you can use $formattedDate in your view:
                                            echo '<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">' . '<div>'. $formattedDate .'</div>' . '<p class="pl-2">am pm</p>' . '</th>';
                                            ?>
                                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ $date }}</th> --}}
                                            @endforeach
                                        </tr>
                                    </thead>
                                    @php
                                    $today = today();
                                    $counter = 1;
                                    @endphp
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($staff as $employee)
                                        
                                        <tr>
                                            <td style="text-align: left" class="px-6 py-4 whitespace-nowrap capitalize">{{ $counter++ }}.</td>
                                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $employee->fname }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $employee->jobrole }}</td>
    
                                            @foreach ($dates as $date)
                                            @php
                                                $attendance = $attendanceData[$employee->id][$date] ?? null;
                                            @endphp
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex text-xl font-bold items-center space-x-1">
                                                
                                                    <div class="h-4 w-4 pl-3 flex items-center justify-center">
                                                       
                                                        @if ($attendance && $attendance['clock_in'])
                                                        @php
                                                        $clockInTime = Carbon\Carbon::parse($attendance['clock_in']);
                                                        $isAM = $clockInTime->format('a') === 'am';
                                                       
                                                    @endphp
                                                    
                                                    @if ($isAM)
                                                        <p class="text-green-500">&#10004;</p>
                                                    @else
                                                        <p class="text-red-500">&#10006;</p>
                                                    @endif
                                                @else
                                                    <p class="text-red-500">&#10006;</p>
                                                @endif
                                                    </div>
                                                    <div class="h-4 w-4 pl-6 flex items-center justify-center">
                                                        @if ($attendance && $attendance['clock_in'])
                                                        @php
                                                        $clockInTime = Carbon\Carbon::parse($attendance['clock_in']);
                                                        
                                                        $isPM = $clockInTime->format('a') === 'pm';
                                                    @endphp
                                                    @if ($isPM)
                                                        <p class="text-green-500">&#10004;</p>
                                                    @else
                                                        <p class="text-red-500">&#10006;</p>
                                                    @endif
                                                @else
                                                    <p class="text-red-500">&#10006;</p>
                                                @endif
                                                    </div>
                                                    {{-- <div class="h-4 w-4 pl-6 flex items-center justify-center">
                                                        @if ($attendance && $attendance['clock_out'])
                                                            @php
                                                                $clockOutTime = Carbon\Carbon::parse($attendance['clock_out']);
                                                            @endphp
                                                            @if ($clockOutTime->lt(Carbon\Carbon::parse('01:00:00')))
                                                                
                                                            <p class="text-red-500">&#10006;</p>
                                                            @else
                                                               
                                                            <p class="text-green-500">&#10004;</p>
                                                            @endif
                                                        @else
                                                           
                                                        <p class="text-red-500">&#10006;</p>
                                                        @endif
                                                    </div> --}}
                                                </div>
                                            </td>
                                        @endforeach
                                            {{-- @foreach ($dates as $date)
                                            @php
                                                $check_attd = $attendanceData[$employee->id][$date]['clock_in'] ?? null;
                                                $check_leave = $attendanceData[$employee->id][$date]['clock_out'] ?? null;
                                            @endphp
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-1">
                                                    <div class="h-4 w-4 flex items-center justify-center">
                                                        @if ($check_attd)
                                                            <i class="ri-checkbox-circle-fill text-green-500"></i>
                                                        @else
                                                            <i class="ri-close-circle-fill text-red-500"></i>
                                                        @endif
                                                    </div>
                                                    <div class="h-4 w-4 flex items-center justify-center">
                                                        @if ($check_leave)
                                                            <i class="ri-checkbox-circle-fill text-green-500"></i>
                                                        @else
                                                            <i class="ri-close-circle-fill text-red-500"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <style media="print">
                                /* Set the display property of the <i> tag to inline-block */
                                i {
                                  display: inline-block;
                                }
                              
                                /* Override any existing styles for the <i> tag in the table cells */
                                #attendanceTable i {
                                  display: inline-block;
                                }
                              
                                /* Set the font-family property to use a different icon font */
                                #attendanceTable i {
                                  font-family: "Font Awesome 5 Free";
                                }
                              
                                /* Set the font-weight property to use the solid style */
                                #attendanceTable i {
                                  font-weight: 900;
                                }
                              </style>  
                                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                                <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
                                <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
                                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
                                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
                                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
                                <script>
                                    new DataTable('#staffTable', {
                                        responsive: true ,
                                                layout: {
                                                    topStart: {
                                                        buttons: ['copy', 'csv', 'excel', 'print']
                                                    }
                                                }
                                            });
                                </script>
                                
                                
                            </div>
                        </div>
                    <!-- Pagination links -->
                    {{-- <div class="mt-4">
                        {{ $user->appends(['order_by' => $orderBy])->links() }}

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
















<!-- List of staff members -->
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Staff Information</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $staffMember)
                    <tr>
                        <td>{{ $staffMember->name }}</td>
                        <td>{{ $staffMember->email }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}
