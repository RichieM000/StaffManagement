<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4 overflow-y-auto">

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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
          const calendarEl = document.getElementById('calendar')
          const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
            @foreach($userTasks as $task)
            {
                title: '{{ $task->status === "exceeded deadline" ? "task exceeded" : $task->title }}',
                start: '{{ $task->deadline }}', // Assuming deadline is a valid date format
                color: '{{ $task->status === "exceeded deadline" ? "red" : "#3788d8" }}', // Set color based on task status
                url: '{{ route('user.task', $task->id) }}' // Optional: link to task detail // Optional: link to task detail
            },
            @endforeach
        ]
          });
          calendar.render()
        });
      
                </script>

        <div class="container m-auto px-4 py-8">
             <div class="bg-white rounded-lg max-w-xl mx-auto shadow-md mb-4 p-4">
                <h1>Task Deadline</h1>
                    <div class="" id='calendar'></div>
                </div>
                
            <h1 class="text-2xl font-bold mb-4">My Tasks</h1>
            
            <div class="bg-white shadow-sm sm:rounded-lg mb-4 p-4">
                @if($tasks->isEmpty())
    <p>Empty Task</p>
@else
                @foreach($tasks as $task)
                <div class="bg-blue-50 flex justify-between p-4 rounded-lg shadow-md mb-4 transition duration-300 ease-in-out hover:bg-blue-200">
                    <div>
                        <div class="text-xl font-semibold text-blue-900">{{ $task->title }}</div>
                        <div class="text-gray-700">{{ $task->description }}</div>
                        <div class="text-sm text-gray-600">Job Role: {{ $task->jobrole }}</div>
                        <div class="text-sm text-gray-600">Committee On: {{ $task->assignedTo->kagawad_committee_on }}</div>
                        <div class="text-sm text-gray-600">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('F j, Y') }}</div>
                    </div>
                    <div class="mt-4 flex justify-end flex-col items-center">
                       
                        
                            @if ($task->status === 'in_progress')
                           
                                <span class="text-green-500 mr-2.5">In Progress</span>
                                <form action="{{ route('task.complete', ['id' => $task->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="flex flex-col text-sm items-center mt-4">
                                    <div>
                                        <label for="file">Upload Files If Needed:</label>
                                        <input type="file" id="file" name="file" class="border w-56 rounded-md px-2 py-1">
                                    </div>
                                        <button type="submit" class="bg-green-500 mt-2 hover:bg-green-600 text-white px-3 py-1 rounded-md">Complete</button>
                                
                                </div>
                                </form>
                            
                            @elseif ($task->status === 'pending')
                            <div class="grid grid-cols-1">
                                <form action="{{ route('task.accept', $task->id) }}" class="m-0 p-0" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 mb-4 text-white px-4 py-2 rounded-md hover:bg-green-600">Accept</button>
                                </form>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="openRejectModal('{{ $task->id }}')">Reject</button>
                            </div>
                                @elseif ($task->status === 'rejected')
                                    <span class="text-red-500 mr-3">Task Rejected</span>

                                @elseif($task->status === 'exceeded deadline')
                                <div class="text-sm text-red-500">
                                    <p>Status: Exceeded Deadline</p>
                                    <button disabled>Task is no longer available</button>
                                </div>    
                            @else
                                <span class="text-green-500">Task Completed</span>
                               
                            @endif
                        
                        
                    </div>
                </div>
                @endforeach
            </div>
           
    </div>
   
      <!-- Reject Modal -->
      @foreach($tasks as $task)
      <div id="rejectModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-10 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Reject Task</h2>
            <form action="/task/reject/{{$task->id}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="rejectTaskId">
                <label for="rejected_reason" class="block mb-2">Reason for rejection:</label>
                <textarea name="rejected_reason" id="reason" class="w-full h-32 border border-gray-300 rounded-md px-3 py-2"></textarea>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Reject</button>
                    <button type="button" class="ml-4 text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100" onclick="closeRejectModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
            
    @endif

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