<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

      

        <div class="flex-1 p-4">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto py-6">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mb-4">Staff Information</h1>
                        <a href="{{ route('admin.add-staff') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a>
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
                    <form action="{{ route('admin.staff') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Search Staff..." value="{{ request()->input('search') }}" class="px-3 py-1 border border-gray-300 rounded-md">
                        <button type="submit" class="bg-blue-500 text-white px-4 ml-2 py-1 rounded-md hover:bg-hover">Search</button>
                    </form>

                    <form action="{{ route('admin.staff') }}" method="GET" class="flex items-center">
                        <label for="order_by" class="mr-2">Sort by:</label>
                        <select name="order_by" id="order_by" onchange="this.form.submit()" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-16 focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="asc" {{ $orderBy == 'asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="desc" {{ $orderBy == 'desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </form>
                    
                </div>
                    
                    <script>
                        function sortStaff() {
                            const orderBy = document.getElementById('order_by').value;
                            const sortForm = document.getElementById('sortForm');
                            sortForm.action = "{{ route('admin.staff') }}?order_by=" + orderBy;
                            sortForm.submit();
                        }
                    </script>
<!-- Assign Task Modal -->
<div id="assignTaskModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('assign-task') }}" method="POST">
                @csrf
                <!-- Staff ID -->
                <input type="hidden" name="staff_id" id="staffId">
                <!-- Task Title -->
                <div class="bg-gray-50 px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium text-gray-900">Assign Task</h3>
                </div>
                <div class="bg-white px-4 pb-4 sm:px-6">
                    <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title</label>
                    <input type="text" name="title" id="task_title" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                    <!-- Additional Task Fields (e.g., description, deadline) -->
                    <!-- Task Description -->
                    <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
                    <textarea name="description" id="task_description" rows="3" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full"></textarea>
                    
                    
                    
                    <label for="jobrole_selection" class="block text-sm font-medium text-gray-700">Include Other Departments:</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="kapitan" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Kapitan</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="vice kap" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Vice Kap</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="secretary" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Secretary</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="treasurer" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Treasurer</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="chairman" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Chairman</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="kagawad" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Kagawad</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="tanod" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Tanod</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="sk" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">SK</span>
                        </label>
                        <!-- Add more job roles as needed -->
                    </div>
                    
                    
                    <!-- Task Deadline -->
                    <label for="task_deadline" class="block text-sm font-medium text-gray-700">Task Deadline</label>
                    <input type="date" name="deadline" id="task_deadline" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <!-- Task Submission Button -->
                <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Assign Task</button>
                    <button type="button" onclick="closeAssignTaskModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Function to open the modal and set staff ID
    function openAssignTaskModal(staffId) {
        // Show the modal
        document.getElementById('assignTaskModal').classList.remove('hidden');
        // You can perform additional logic here, such as fetching staff details based on staffId
        
        // Example: Set staff ID in a hidden input field
        document.getElementById('staffId').value = staffId;
    }

    // Function to close the modal
    function closeAssignTaskModal() {
        // Hide the modal
        document.getElementById('assignTaskModal').classList.add('hidden');
    }

    // Handle form submission when modal form is submitted
    document.getElementById('assignTaskForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission
        
        // Get form data
        const formData = new FormData(document.getElementById('assignTaskForm'));
        
        // Send AJAX request to assign the task
        fetch(document.getElementById('assignTaskForm').action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle response (e.g., show success message, update UI)
            console.log(data);
            // Close modal if task is successfully assigned
            if (data.success) {
                closeAssignTaskModal();
                // Reload or update task list on the page if needed
                // Example: window.location.reload();
            }
        })
        .catch(error => {
            // Handle error (e.g., show error message)
            console.error('Error:', error);
        });
    });
</script>


        
                    <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto" id="staffTable">
                                <!-- Table headers -->
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm font-medium leading-normal">
                                        <!-- Existing headers -->
                                        <th class="px-4 py-2 whitespace-nowrap">Firstname</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Lastname</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Gender</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Age</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Address</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Email</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Phone</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Job Role</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Work Schedule</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Assign Task</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Edit</th>
                                        <!-- New header for Assign Task button -->
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @if($noItemsMessage)
                                    <p>{{ $noItemsMessage }}</p>
                                    @else
                                    @foreach($staff as $staffMember)
                                    <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->firstname }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->lastname }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->gender }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->age }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->address }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->email }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->phone }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $staffMember->jobrole }}</td>
                                        <td>
                                            @foreach($staffMember->workSchedules as $workSchedule)
                                            {{ $workSchedule->day_of_week }}: {{ \Carbon\Carbon::parse($workSchedule->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($workSchedule->end_time)->format('h:i A') }}<br>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <!-- New button for Assign Task -->
                                            <button type="button" onclick="openAssignTaskModal('{{ $staffMember->id }}')" class="bg-blue-500 text-white px-4 py-2 rounded-md {{ $staffMember->assignedTask ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $staffMember->assignedTask ? 'disabled' : '' }}>Assign Task</button>

                                        </td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap flex justify-center gap-2">
                                            <div>
                                                <a class="text-xl text-button hover:text-hover" href="{{ route('admin.edit-staff', $staffMember->id) }}"><i class="ri-edit-fill"></i></a>
                                            </div>
                                            <form action="{{ route('admin.delete-staff', $staffMember->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this staff member?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $staff->appends(['order_by' => $orderBy])->links() }}

                    </div>
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
