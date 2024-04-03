<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div id="addTaskModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm" class="p-4 space-y-4">
                        @csrf
                        <!-- Task Title -->
                        <div>
                            <label for="task_title" class="block">Task Title:</label>
                            <input type="text" name="title" id="task_title" class="form-input mt-1 block w-full" required>
                        </div>
                        
                        <!-- Task Description -->
                        <div>
                            <label for="task_description" class="block">Task Description:</label>
                            <textarea name="description" id="task_description" rows="3" class="form-textarea mt-1 block w-full" required></textarea>
                        </div>
                        
                        <!-- Job Role Selection -->
                        <div>
                            <label class="block">Select Job Roles to Include:</label>
                            <div class="mt-1 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="job_roles[]" value="kapitan" class="form-checkbox">
                                    <span class="ml-2">Kapitan</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="job_roles[]" value="secretary" class="form-checkbox">
                                    <span class="ml-2">Secretary</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="job_roles[]" value="treasurer" class="form-checkbox">
                                    <span class="ml-2">Treasurer</span>
                                </label>
                                <!-- Add more job roles as needed -->
                            </div>
                        </div>
                        
                        <!-- Task Deadline -->
                        <div>
                            <label for="task_deadline" class="block">Task Deadline:</label>
                            <input type="date" name="deadline" id="task_deadline" class="form-input mt-1 block w-full" required>
                        </div>
                        
                        <!-- Task Submission Button -->
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>

        <script>
            // Function to open the add task modal
            function openAddTaskModal() {
                // Show the modal
                document.getElementById('addTaskModal').classList.remove('hidden');
            }
        
            // Function to close the add task modal
            function closeAddTaskModal() {
                // Hide the modal
                document.getElementById('addTaskModal').classList.add('hidden');
            }
        
            // Function to handle form submission
            function submitAddTaskForm(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form data
        const form = document.getElementById('addTaskForm');
        const formData = new FormData(form);

        // Send an AJAX request to submit the form data
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the response (e.g., show success message, close modal, etc.)
            console.log(data); // You can customize this based on your application's logic
            alert('Task created successfully!');
            // Optionally, you can redirect to another page or perform other actions here
        })
        .catch(error => {
            console.error('Error:', error); // Handle any errors here
            alert('An error occurred while creating the task.');
        });
    }

    // Add event listener to the form for form submission
    document.getElementById('addTaskForm').addEventListener('submit', submitAddTaskForm);
        </script>
        
        




        <div class="flex-1 p-4">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto py-6">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mb-4">Task Management</h1>
                        <button onclick="openAddTaskModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Task</button>
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
                    {{-- <div class="flex justify-between mt-4">
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
                     --}}
                    <script>
                        function sortStaff() {
                            const orderBy = document.getElementById('order_by').value;
                            const sortForm = document.getElementById('sortForm');
                            sortForm.action = "{{ route('admin.staff') }}?order_by=" + orderBy;
                            sortForm.submit();
                        }
                    </script>


        
                    <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto" id="staffTable">
                                <!-- Table headers -->
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700 uppercase text-left text-sm font-medium leading-normal">
                                        <!-- Existing headers -->
                                        <th class="px-4 py-2 whitespace-nowrap">Task Title</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Description</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Created At</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Deadline</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Assigned To</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Position</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Completed</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Action</th>
                                       
                                        {{-- <th class="px-4 py-2 whitespace-nowrap">Job Role</th>
                                        <th class="px-4 py-2 whitespace-nowrap">Work Schedule</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Assign Task</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Edit</th> --}}
                                        <!-- New header for Assign Task button -->
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($tasks as $task)
                                    
                                    <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->title }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->description }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->deadline }}</td>
                                         <td class="px-4 py-2 whitespace-nowrap">{{ $task->assignedTo->firstname }} {{ $task->assignedTo->lastname }}</td>
                                         <td class="px-4 py-2 whitespace-nowrap">{{ $task->assignedTo->jobrole }}</td>
                                         <td class="px-4 py-2 whitespace-nowrap">{{ $task->completed }}</td>
                                         <td class="py-2 px-4 whitespace-nowrap flex gap-2">
                                            <div>
                                                <button type="button" onclick="openEditTaskModal('{{ $task->id }}', '{{ $task->title }}', '{{ $task->description }}', '{{ $task->deadline }}')" class="bg-blue-500 text-white px-4 py-2 rounded-md"><i class="ri-edit-fill"></i></button>



                                            </div>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <!-- Pagination links -->
                    {{-- <div class="mt-4">
                        {{ $staff->appends(['order_by' => $orderBy])->links() }}

                    </div> --}}
                   
                </div>
            </div>
        </div>

        <div id="editTaskModal" class="hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="modal-container bg-white w-96 mx-auto rounded shadow-lg p-6">
                <form action="{{ route('tasks.edit', $task->id) }}" method="POST" id="editTaskForm" class="bg-white px-4 pb-4 sm:px-6">

                    @csrf
                    @method('PUT')
                    <input type="hidden" name="taskId" id="taskId" value="{{ $task->id }}">
                    <!-- Task Title -->
                    <div class="mt-4">
                        <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title</label>
                        <input type="text" name="title" id="task_title" value="" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
            
                    <!-- Task Description -->
                    <div class="mt-4">
                        <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
                        <textarea name="description" id="task_description" rows="3" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                    </div>

                                       
            
                    <!-- Task Deadline -->
                    <div class="mt-4">
                        <label for="task_deadline" class="block text-sm font-medium text-gray-700">Task Deadline</label>
                        <input type="date" name="deadline" id="task_deadline" value="" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                
                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Task</button>
                        <button type="button" onclick="closeEditTaskModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </form>
                
            </div>
        </div>
     
        {{-- <div id="assignTaskModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('tasks.edit', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Staff ID -->
                        <input type="hidden" name="staff_id" id="staffId">
                        <!-- Task Title -->
                        <div class="bg-gray-50 px-4 py-5 sm:px-6">
                            <h3 class="text-lg font-medium text-gray-900">Assign Task</h3>
                        </div>
                        <div class="bg-white px-4 pb-4 sm:px-6">
                            <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title</label>
                            <input type="text" name="title" id="task_title" value="{{ $task->title }}" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                            <!-- Additional Task Fields (e.g., description, deadline) -->
                            <!-- Task Description -->
                            <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
                            <textarea name="description" id="task_description" rows="3" required class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">{{ $task->description }}</textarea>
                            <!-- Task Deadline -->
                            <label for="task_deadline" class="block text-sm font-medium text-gray-700">Task Deadline</label>
                            <input type="date" name="deadline" id="task_deadline" value="{{ $task->deadline }}" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                        </div>
                        <!-- Task Submission Button -->
                        <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Assign Task</button>
                            <button type="button" onclick="closeEditTaskModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <script>
            function openEditTaskModal(taskId, taskTitle, taskDescription, taskDeadline) {
                // Show the modal
                document.getElementById('editTaskModal').classList.remove('hidden');
        
                // Populate form fields with task data
                document.getElementById('taskId').value = taskId;
                document.getElementById('task_title').value = taskTitle;
                document.getElementById('task_description').value = taskDescription;
                document.getElementById('task_deadline').value = taskDeadline;
        
                // Generate the route URL with the task ID
                const editUrl = "{{ route('tasks.edit', ':taskId') }}".replace(':taskId', taskId);
                // Set the form action attribute to the generated URL
                document.getElementById('editTaskForm').action = editUrl;
            }
        
            // Function to close the modal
            function closeEditTaskModal() {
                // Hide the modal
                document.getElementById('editTaskModal').classList.add('hidden');
            }
        </script>
        
        
</div>
</x-app-layout>