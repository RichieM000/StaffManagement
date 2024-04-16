<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4">

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

        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">My Tasks</h1>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
                @if($tasks->isEmpty())
    <p>Empty Task</p>
@else
                @foreach($tasks as $task)
                <div class="bg-blue-50 flex justify-between p-4 rounded-lg shadow-md mb-4 transition duration-300 ease-in-out hover:bg-blue-200">
                    <div>
                        <div class="text-xl font-semibold text-blue-900">{{ $task->title }}</div>
                        <div class="text-gray-700">{{ $task->description }}</div>
                        <div class="text-sm text-gray-600">Job Role: {{ $task->jobrole }}</div>
                        <div class="text-sm text-gray-600">Committee On: {{ $task->kagawad_committee_on }}</div>
                        <div class="text-sm text-gray-600">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</div>
                    </div>
                    <div class="mt-4 flex justify-end flex-col items-center">
                       
                        
                            @if ($task->status === 'in_progress')
                           
                                <span class="text-green-500 mr-2.5">In Progress</span>
                                <form action="{{ route('task.complete', ['id' => $task->id]) }}" method="POST">
                                    @csrf
                                    <div class="flex flex-col text-sm items-center mt-4">
                                        <div>
                                            <label for="file">File:</label>
                                        <input type="file" id="file" name="file" class="border w-56 rounded-md px-2 py-1">
                                    </div>
                                        <button type="submit" class="bg-green-500 mt-2 hover:bg-green-600 text-white px-3 py-1 rounded-md">Complete</button>
                                
                                </div>
                                </form>
                            
                            @elseif ($task->status === 'pending')
                                <form action="{{ route('task.accept', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Accept</button>
                                </form>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-red-600" onclick="openRejectModal('{{ $task->id }}')">Reject</button>
                                @elseif ($task->status === 'rejected')
                                    <span class="text-red-500 mr-3">Task Rejected</span>
                            @else
                                <span class="text-green-500">Task Completed</span>
                               
                            @endif
                        
                        
                    </div>
                </div>
            @endforeach
            
            @endif
            </div>

    </div>
   
      <!-- Reject Modal -->
      <div id="rejectModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Reject Task</h2>
            <form action="{{ route('task.reject') }}" method="POST">
                @csrf
                <input type="hidden" name="task_id" id="rejectTaskId">
                <label for="reason" class="block mb-2">Reason for rejection:</label>
                <textarea name="reason" id="reason" class="w-full h-32 border border-gray-300 rounded-md px-3 py-2"></textarea>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Reject</button>
                    <button type="button" class="ml-4 text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100" onclick="closeRejectModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    

    <script>
        function openRejectModal(taskId) {
            document.getElementById('rejectTaskId').value = taskId;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
    
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</div>
    </div>
</x-app-layout>