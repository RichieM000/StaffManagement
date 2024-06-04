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
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mb-4">Log History</h1>
                        <button id="clear-logs-btn" class="bg-red-500 px-1.5 py-1.5 rounded text-white hover:bg-red-800">Clear All Logs</button>
                        {{-- <a href="{{ route('sadmin_createtasks') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a> --}}
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
                  


                    <div class="bg-white flex flex-col max-w-6xl mt-8 mx-auto shadow-sm sm:rounded-lg p-4">
                        <!-- Display Admin Login History -->
                        {{-- <div>
                            <div class="flex justify-between">
                        <h2 class="text-lg font-semibold mb-4">Admin Log History</h2>
                        
                    </div>
                        
                        <table class="responsive border-collapse border border-gray-300" id="logTable">
                            <thead class="">
                                <tr class="bg-gray-800 text-white">
                                    <th class="py-2 px-4 border border-gray-300">User</th>
                                    <th class="py-2 px-4 border border-gray-300">Login Time</th>
                                    <th class="py-2 px-4 border border-gray-300">Logout Time</th>
                                    <th class="py-2 px-4 border border-gray-300">Date</th>
                                    <!-- Other relevant columns -->
                                </tr>
                            </thead>
                            
                            <tbody class="">
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
                    
                        </div> --}}
                    
                        <div class="mt-8">
                        <!-- Display User Login History -->
                        <h2 class="text-lg font-semibold mb-4">Staff Log History</h2>
                        
                        <table class="responsive border-collapse border border-gray-300" id="logTable2">
                            <thead>
                                <tr class="bg-gray-800 text-white">
                                    <th class="py-2 px-4 border border-gray-300">User</th>
                                    <th class="py-2 px-4 border border-gray-300">Login Time</th>
                                    <th class="py-2 px-4 border border-gray-300">Logout Time</th>
                                    <th class="py-2 px-4 border border-gray-300">Date</th>
                                    <!-- Other relevant columns -->
                                </tr>
                            </thead>
                            <div class="max-h-40 overflow-y-auto">
                            <tbody class="">
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
                        </div>
                        </table>



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
            $(document).ready(function() {
    $('#clear-logs-btn').click(function() {
        

        if (confirm('Are you sure you want to clear all logs?')) {
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: '{{ route('logs.clear') }}',
    type: 'POST',
}).done(function(response) {
    if (response.success) {
        // Reload the page
        location.reload();
    }
});
        }
    });
});
        </script>
        
        <script>
            new DataTable('#logTable', {
                scrollCollapse: true,
                scrollY: '400px',
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'print']
                    }
                }
            });
        </script>
         <script>
            
            new DataTable('#logTable2', {
                scrollCollapse: true,
                scrollY: '400px',
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'print']
                    }
                }
            });
            </script>
                        
                    </div>
                    
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>