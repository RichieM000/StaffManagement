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
                        <h1 class="text-2xl font-semibold mb-4">Leave Management</h1>
                        {{-- <a href="{{ route('add-task') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a> --}}
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
                    <form action="{{ route('admin-leave') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Search Leave..." value="{{ request()->input('search') }}" class="px-3 py-1 border border-gray-300 rounded-md">
                        <button type="submit" class="bg-blue-500 text-white px-4 ml-2 py-1 rounded-md hover:bg-hover">Search</button>
                    </form>

                    {{-- <form action="{{ route('admin-leave') }}" method="GET" class="flex items-center">
                        <label for="order_by" class="mr-2">Sort by:</label>
                        <select name="order_by" id="order_by" onchange="this.form.submit()" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-16 focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="default" {{ $orderBy == 'default' ? 'selected' : '' }}>---</option>
                            <option value="asc" {{ $orderBy == 'asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="desc" {{ $orderBy == 'desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </form> --}}
                    
                </div>
                    
                    {{-- <script>
                        function sortTask() {
                            const orderBy = document.getElementById('order_by').value;
                            const sortForm = document.getElementById('sortForm');
                            sortForm.action = "{{ route('admin.task') }}?order_by=" + orderBy;
                            sortForm.submit();
                        }
                    </script>
 --}}

        
                    <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                       

                        <div class="overflow-x-auto w-full p-4">
                            <table class="responsive border-x-2" id="staffTable">
                                <!-- Table headers -->
                                <thead class="bg-gray-800 text-white">
                                    <tr class="uppercase text-sm font-medium leading-normal">
                                        <!-- Existing headers -->
                                        {{-- <th class="px-4 py-2 whitespace-nowrap">No.</th> --}}
                                        <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Leave Type</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Name</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Position</th>
                                        
                                        <th class="px-4 py-2 whitespace-nowrap">Reason</th>
                                        <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">Start Date</th>
                                        <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">End Date</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Status</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Action</th>

                                      

                                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}}
                                        
                                        
                                      
                                        <!-- New header for Assign Task button -->
                                       
                                    </tr>
                                </thead>
                               
                             
                                 <tbody class="text-gray-600 text-sm font-semibold">
                                   
                                    @php $counter = 1 @endphp
                                    @foreach($leaveRequests as $leaveRequest)
                                   
                                        <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                            <td style="text-align: left" class="px-4 py-2">{{ $counter++ }}.</td>
                                        <td class="px-4 py-2 whitespace-wrap">{{ $leaveRequest->leave_type }}</td>
                                        <td class="px-4 py-2 whitespace-wrap capitalize">{{ $leaveRequest->user->fname }}</td>
                                        <td class="px-4 py-2 whitespace-wrap">{{ $leaveRequest->user->jobrole }}</td>
                                        
                                        <td class="px-4 py-2 whitespace-wrap">{{ $leaveRequest->reason }}</td>
                                        <td style="text-align: left" class="px-4 py-2 whitespace-wrap">{{ $leaveRequest->start_date }}</td>
                                        <td style="text-align: left" class="px-4 py-2 whitespace-wrap">{{ $leaveRequest->end_date }}</td>
                                        <td class="px-4 py-2 whitespace-wrap capitalize">{{ $leaveRequest->status }}</td>


                                        <td class="py-3 px-6 text-center whitespace-nowrap flex justify-center gap-2">

                                            @if ($leaveRequest->status === 'pending')
                                            <form action="{{ route('admin-approve', ['id' => $leaveRequest->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="approve">
                                                <button class="text-button text-2xl hover:text-hover"><i class="ri-checkbox-circle-fill"></i></button>
                                            </form>
                                    
                                            <form action="{{ route('admin-reject', ['id' => $leaveRequest->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="rejected">
                                                <button type="submit" onclick="return confirm('Are you sure you want to reject this leave request?')" class="text-red-500 text-2xl hover:text-red-700"><i class="ri-close-circle-fill"></i></button>
                                            </form>
                                        @elseif ($leaveRequest->status === 'approved' || $leaveRequest->status === 'rejected')
                                            <form action="{{ route('admin-delete', ['id' => $leaveRequest->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this leave request?')" class="text-red-500 text-2xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                            </form>
                                        @endif
                                        

                                        </td>
                                        
                                        
                                        <!-- Other columns and data -->
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
                        {{ $leaveRequests->appends(['order_by' => $orderBy])->links() }}

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>