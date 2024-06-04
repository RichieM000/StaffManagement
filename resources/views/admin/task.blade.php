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
                        <h1 class="text-2xl font-semibold mb-4">Task Management</h1>
                        <a href="{{ route('add-task') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a>
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
                            <table class="responsive border-x-2" id="taskTable">
                                <!-- Table headers -->
                                <thead class="bg-gray-800 text-white">
                                    <tr class="uppercase text-sm font-medium leading-normal">
                                        <!-- Existing headers -->
                                        <th class="px-4 py-2 whitespace-nowrap">#</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Name</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Position</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Task Title</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Description</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Deadline</th>
                                        
                                        <th class="px-4 py-2 whitespace-nowrap">File Uploads</th>
                                        {{-- <th class="px-4 py-2 whitespace-nowrap">Kagawad Committee</th> --}}
                                        <th class="px-4 py-2 whitespace-nowrap">Status</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Reject Reason</th>
                                        {{-- <th class="px-4 py-2 whitespace-nowrap">Completed</th> --}}




                                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}}
                                        
                                        
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Action</th>
                                        <!-- New header for Assign Task button -->
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-semibold">
                                   @php $counter = 1 @endphp
                                    @foreach ($tasks as $task)
                                    <tr class="border-b border-gray-200 transition duration-300 ease-in-out text-center hover:bg-gray-100">
                                        <td style="text-align: center" class="px-4 py-2">{{ $counter++ }}.</td>
                                        <td class="px-4 py-2 whitespace-nowrap capitalize">{{ $task->assignedTo->fname }}</td>
                                        <td class="px-4 py-2 whitespace-wrap max-w-60">
                                            {{-- <div class="flex flex-nowrap"> --}}
                                            @foreach($task->jobRoles() as $jobRole)
                                                {{ $jobRole }}
                                                @if (!$loop->last) <!-- Add comma if not the last job role -->
                                                    -
                                                @endif
                                            @endforeach
                                        {{-- </div> --}}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap capitalize">{{ $task->title }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->description }}</td>
                                        <?php
                                       

                                        // Assuming $attendance->date is already a valid date string or Carbon instance
                                        $attendanceDate = \Carbon\Carbon::parse($task->date);

                                        // Format the date as "Month-Day-Year"
                                        $formattedDate = $attendanceDate->format('M d, Y');

                                        // Now you can use $formattedDate in your view:
                                        echo '<td class="px-4 py-2 whitespace-nowrap">' . $formattedDate . '</td>';
                                        ?>
                                       
                                        <td>
                                            @if ($task->file_path)
                                            @if (Storage::disk('public')->exists($task->file_path))
                                                <a href="{{ Storage::url($task->file_path) }}" class="underline text-blue-500" target="_blank">Open File</a>
                                            @else
                                                File not found
                                            @endif
                                        @else
                                            No files
                                        @endif

                                        </td>
                                        {{-- <td class="px-4 py-2 whitespace-nowrap">{{ $task->kagawad_committee_on }}</td> --}}

                                        @if($task->status === 'exceeded deadline')
                                            <td class="px-4 text-red-500 py-2 whitespace-nowrap capitalize">{{ $task->status }}</td>
                                        @elseif($task->status === 'completed')
                                             <td class="px-4 text-green-500 py-2 whitespace-nowrap capitalize">{{ $task->status }}</td>
                                        @else
                                        <td class="px-4 py-2 whitespace-nowrap capitalize">{{ $task->status }}</td>
                                        @endif
                                        <td class="px-4 py-2 whitespace-nowrap">
                                           
                                            {{ $task->rejected_reason }}
                                      
                                        </td>
                                        
                                        {{-- <td class="px-4 py-2 whitespace-nowrap">{{ $task->completed ? 'Yes' : 'No' }}</td> --}}
                                        <td class="py-3 px-6 text-center whitespace-nowrap flex justify-center gap-2">
                                            <div>
                                                <a class="text-xl text-button hover:text-hover" href="{{ route('tasks-edit', $task->id) }}"><i class="ri-edit-fill"></i></a>
                                            </div>
                                            <form action="{{ route('tasks-destroy', ['task' => $task->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task assignment?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                            </form>

                                        </td>
                                       
                                        {{-- Add more columns as needed --}}
                                    </tr>
                                @endforeach
                                 
                                </tbody>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                            <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
                            {{-- <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script> --}}
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> --}}
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
                            <script>
                                new DataTable('#taskTable', {
                                    responsive: true,
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
                        {{ $tasks->appends(['order_by' => $orderBy])->links() }}

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>