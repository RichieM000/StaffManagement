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
                        <h1 class="text-2xl font-semibold mb-4">Attendance & Time Tracking</h1>
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
                    {{-- <form action="{{ route('admin.staff') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Search..." value="{{ request()->input('search') }}" class="px-3 py-1 border border-gray-300 rounded-md">
                        <button type="submit" class="bg-blue-500 text-white px-4 ml-2 py-1 rounded-md hover:bg-hover">Search</button>
                    </form> --}}

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


        
                    <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                       
                        <div class="overflow-x-auto w-full p-4">
                            <table class="responsive border-x-2" id="staffTable">
                                <!-- Table headers -->
                                <thead class="bg-gray-800 text-white">
                                    <tr class="uppercase text-sm font-medium leading-normal">
                                        <!-- Existing headers -->
                                        <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Date</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Firstname</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Lastname</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Time In</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Time Out</th>
                                        <th style="text-align: center" class="px-4 py-2 whitespace-nowrap">Action</th>

                                        
                                        {{-- <th class="px-4 py-2 whitespace-nowrap">Duration</th> --}}

                                        {{-- <th class="py-3 px-6 text-center whitespace-nowrap">Edit</th> --}}
                                        <!-- New header for Assign Task button -->
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-semibold">
                                    @php $counter = 1 @endphp <!-- Initialize counter -->
                                    @foreach ($attendances as $attendance)
                                    @php
                                    $duration = \Carbon\CarbonInterval::seconds($attendance->duration);
                                    $formattedDuration = $duration->cascade()->forHumans(['parts' => 3]); // Format as hours:minutes:seconds
                                @endphp
                                    <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                        <td style="text-align: left" class="px-4 py-2">{{ $counter++ }}.</td>
                                        <?php
                                       

                                        // Assuming $attendance->date is already a valid date string or Carbon instance
                                        $attendanceDate = \Carbon\Carbon::parse($attendance->date);

                                        // Format the date as "Month-Day-Year"
                                        $formattedDate = $attendanceDate->format('M d, Y');

                                        // Now you can use $formattedDate in your view:
                                        echo '<td class="px-4 py-2 whitespace-nowrap">' . $formattedDate . '</td>';
                                        ?>
                                        <td class="px-4 py-2 whitespace-nowrap capitalize">{{ $attendance->user->fname }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap capitalize">{{ $attendance->user->lname }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A') }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap"> @if($attendance->clock_out)
                                            {{ \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A') }}
                                        @endif</td>
                                        <td style="text-align:center">
                                            <div class="pr-3">
                                                <a class="text-base text-white bg-green-400 px-3 rounded hover:bg-green-600" href="">View</a>
                                            </div>
                                        </td>
                                        {{-- <td class="px-4 py-2 whitespace-nowrap">{{ $formattedDuration }}</td> --}}
                                       
                                    </tr>
                                @endforeach
                                 </tbody>
                                
                              
                                
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
